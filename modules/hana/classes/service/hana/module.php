<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Spolecna servisa pro vsechny moduly v adminu zajistujici standardni CRUD operace.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Hana_Module
{
    private $orm;
    private $is_orm_tree=false;
    private $is_sequenceable=false;

    public function __construct($orm) {
        $this->orm = $orm;
        // automaticky zjistim, zda jde o orm_tree
        if(array_key_exists("parent_id",$this->orm->table_columns())) $this->is_orm_tree=true;
        if(array_key_exists("poradi",$this->orm->table_columns())) $this->is_sequenceable=true;

    }

    /**
     * Zmena viditelnosti.
     * @param <type> $item_id
     * @param <type> $state_value
     * @param <type> $specific_orm
     */
    public function change_visibility($item_id, $state_value, $specific_orm=false, $column="zobrazit")
    {
        $orm=$specific_orm?$specific_orm:$this->orm;
        if(!$orm->id) 
        {
            $item = $orm->find($item_id);
        }
        else
        {
            $item=$orm;
        }
        
        $item->$column = $state_value;
        $item->save();
    }

    /**
     * Smazani polozky v databazi.
     * @param <type> $item_id
     */
    public function delete($item_ids, $with_route=false, $resources=array())
    {
        // rozlisi, zda je mozna polozku smazat (pokud je orm tree, nesmi na ni byt navazan zadny dalsi zaznam)
        // automaticky rozlisuje zda pouze nastavit priznak "smazano" (existuje tento sloupec v db) nebo fyzicky smaze zaznam
        // pri fyzickem mazani odstrani i pripojene zdroje
        
        foreach($item_ids as $item_id=>$value)
        {
            $this->orm->clear();
            $item_orm = $this->orm->where($this->orm->table_name().".id","=",$item_id)->find();
            $error=false;

            if($this->is_orm_tree)
            {
                // zjisteni zda za polozku neni pripojen nejaky jiny zaznam
                $result=DB::select(array(DB::expr('count(*)'),"total_items"))->from($this->orm->table_name())->where("parent_id","=",$item_orm->id)->execute()->as_array();
                if($result[0]["total_items"]>0) $error=true;
            }

            if(!$error)
            {
                // pripadne smazani dalsich pripojenych zdroju

                // zaverecne smazani vlastniho objektu
                if(isset($item_orm->smazano))
                {
                    $item_orm->smazano=1;
                    $item_orm->save();
                }
                else
                {
                    $item_orm->delete();
                }
            }

        }

        return true;

    }

    /**
     * Servisni trida pro obsluhu vkladani obrazku, provede upload souboru, upravu fotky dle nastaveni a ulozeni do prislusneho adresare + zaznam do databaze. 
     * 
     * @param <type> $imagesrcname
     * @param <type> $images_dir
     * @param <type> $image_settings
     * @param <type> $image_name
     * @param <type> $delete_source
     * @param <type> $image_ext
     * @param <type> $col_name 
     */
     public function insert_image($imagesrcname, $images_dir, $image_settings, $image_name, $delete_source=true, $image_ext="jpg", $col_name="photo_src")
     {
        //die($orm_row_id."-".$images_dir."-".$image_settings."-".$image_name);
        // nejprve pridam zaznam do databaze :
        
        if(strpos($image_name, "/"))
        {        
            $value_array=explode("/",$image_name);
            if(is_array($value_array) && count($value_array)>1){
                array_shift($value_array);
                $image_name=implode("/", $value_array);  
            }
        }

         
        $this->orm->$col_name=$image_name;
//        if($image_ext===true)
//        {
//            // TODO - zjistit presnou priponu obrazku
//            //$image_ext=
//        }
//        else
//        {
//            $this->orm->ext=$image_ext;
//        }

        $this->orm->save();

        // provedu generovani obrazku :
        Service_Hana_File::create_images($this->orm->id, $imagesrcname, $images_dir, $image_settings, $image_name, $delete_source, $image_ext, $col_name);

    }

    /**
     * Metoda pro přidání videa
     * @param $videosrcname
     * @param $videos_dir
     * @param $video_name
     * @param bool $delete_source
     * @param string $col_name
     * @throws Kohana_Exception
     */
    public function insert_video($videosrcname, $videos_dir, $video_name, $col_name="video_src")
    {
        // nejprve pridam zaznam do databaze :

        if(strpos($video_name, "/"))
        {
            $value_array=explode("/",$video_name);
            if(is_array($value_array) && count($value_array)>1){
                array_shift($value_array);
                $video_name=implode("/", $value_array);
            }
        }


        $this->orm->$col_name=$video_name;
        $this->orm->save();

        // provedu generovani obrazku :
        Service_Hana_File::create_videos($this->orm->id, $videosrcname, $videos_dir, $video_name);

    }

    /**
     * Maze obrazky z jednotlivych modulu i z pripojenych galerii.
     *
     * @param <type> $item_id id obrazku
     * @param <type> $images_dir zakladni adresar obrazku
     * @param <type> $specific_orm specificke ormko (jinak se bere nastavene vychozi pro modulovou servisu)
     * @param <type> $photogallery_related_col - zapne mod mazani z galerie - nazev sloupce s cizim klicem na hlavni tabulku (product_id ...)
     * @param <type> $image_settings - jen pro galerie - pole s nastavenim obrazku
     * @param <type> $col_name - nazev sloupce se zaznamem fotky
     * @param <type> $col_ext_name - jen pro galerie - nazev sloupce s priponou
     */
    public function delete_image($item_id, $images_dir, $specific_orm=false, $photogallery_related_col=false, $image_settings=false, $col_name="photo_src", $col_ext_name="ext", $all = true)
    {
        $orm=$specific_orm?$specific_orm:$this->orm;
        $imgorm=orm::factory($orm->object_name(),$item_id);

        if(!$photogallery_related_col)
        {
            if ($all)
                Service_Hana_File::recursiveFolderDelete($images_dir."images-".$imgorm->id."/", true);
            else
                Service_Hana_File::delete_simple_photo($images_dir."images-".$imgorm->id."/", $imgorm->$col_name);
            // mazu pouze zaznam ze sloupce s udajem o obrazku
            $imgorm->$col_name="";
            $imgorm->save();
        }
        else
        {
            $folder_id=$imgorm->$photogallery_related_col;
            $image_name=$imgorm->$col_name;
            $image_ext=$imgorm->$col_ext_name;
            Service_Hana_File::delete_images($folder_id, $images_dir, $image_settings, $image_name, $image_ext);
            $imgorm->delete();
        }


    }

    public function delete_video($item_id, $videos_dir, $specific_orm = false, $col_name = "video_src")
    {
        $orm = $specific_orm ? $specific_orm : $this->orm;
        $video_orm = orm::factory($orm->object_name(),$item_id);
        Service_Hana_File::delete_videos($item_id, $videos_dir, $video_orm->$col_name);
        // mazu pouze zaznam ze sloupce s udajem o obrazku
        $video_orm->$col_name="";
        $video_orm->save();
    }

    public function delete_file($item_id, $files_dir, $specific_orm=false, $file_related_col=false )
    {
        $orm=$specific_orm?$specific_orm:$this->orm;
        $fileorm=orm::factory($orm->object_name(),$item_id);

        $file_name=$fileorm->file_src;
        $file_ext=$fileorm->ext;

        if(!$file_related_col)
        {
            Service_Hana_File::recursiveFolderDelete($files_dir."-".$fileorm->id."/", true);
            // mazu pouze zaznam ze sloupce s udajem o obrazku
            $fileorm->$col_name="";
            $fileorm->save();
        }
        else
        {
            $folder_id=$fileorm->$file_related_col;
            Service_Hana_File::delete_file($folder_id, $files_dir, $file_name, $file_ext);
            $fileorm->delete();
        }


    }



    public function insert_gallery_image($gallery_orm, $related_col_name, $related_id, $imagesrcname, $images_dir, $image_settings, $data, $delete_source=true, $image_ext="jpg")
    {
        // testovani pripony
        $filename="";

        if(isset($imagesrcname["file"]["name"])){
            $filename=$imagesrcname["file"]["name"];
            $imagesrcname=$imagesrcname["imagesrcname"];
        }elseif(isset($_FILES[$imagesrcname]))
        {
            $filename=$_FILES[$imagesrcname]["name"];
        }
        
        if($filename)
        {
            $ext=Service_Hana_File::extension_check($filename,array("jpg","jpeg","gif","png"));
            if(!$ext) return(array("src"=>"typ souboru musí být jpg, jpeg, png, <br />nebo gif!"));
        }

        if(!$gallery_orm->id)
        {
            // novy zaznam priradime potrebne parametry
            $gallery_orm->$related_col_name=$related_id;
            $gallery_orm->poradi=$this->get_new_order_position($gallery_orm,false,$related_col_name,$related_id); // ziskam nove poradi podle id subjektu
        }
        else
        {
            // pokud jde o editaci a vkladam novy soubor, musim fyzicky smazat ten puvodni (jine seo-nazvy souboru)
            if($filename)
            {
                Service_Hana_File::delete_images($related_id, $images_dir, $image_settings, $gallery_orm->photo_src, $gallery_orm->ext);
            }
        }

        // algoritmus vygenerovani a ulozeni fyzickeho unikatnihu nazvu obrazku - preskocime, pokud nebyl vlozen
        if($filename)
        {
            $photo_src=seo::uprav_fyzicky_nazev($data["nazev"]);
            $inital_photo_src=$photo_src;
            $counter=0;
            while(db::select(array('COUNT("*")', 'total_row_count'))->from($gallery_orm->table_name())->where("photo_src","=",$photo_src)->where($related_col_name,"=",$related_id)->execute()->get('total_row_count'))
            {
                $counter++;
                $photo_src=$inital_photo_src."_".$counter; // pridam poradovy cislo a testuju, zda je volny
            }
            $gallery_orm->photo_src=$photo_src;
        }

        // doplnim obecna data do ormka
        $gallery_orm->nazev=$data["nazev"];
        $gallery_orm->popis=$data["popis"];
        $gallery_orm->zobrazit=($data["zobrazit"])?1:0;
        if($image_ext===true)
        {
            // zapisu skutecnou priponu
            $image_ext=$ext;
        }
        $gallery_orm->ext=$image_ext;

        // provedu generovani a ulozeni vlastniho obrazku (pouze pokud byl vlozen)
        if($filename) Service_Hana_File::create_images($related_id, $imagesrcname, $images_dir, $image_settings, $gallery_orm->photo_src, $delete_source, $image_ext, "photo_src");

        // ormko naplneno, fyzicke ulozeni obrazku se povedlo - ulozim data
        $gallery_orm->save();

    }
    
    public function insert_gallery_image_zip($gallery_orm, $related_col_name, $related_id, $zipsrcname, $images_dir, $image_settings, $data, $delete_source=true, $image_ext="jpg"){
        // rozbaleni archivu do docasne slozky
        $temp_dir=str_replace('\\', '/',DOCROOT)."media/photos/temp-photos/";
        Service_Hana_File::recursiveFolderDeleteMain($temp_dir,true); // smazu vse, co je v temp adresari
        $post_array=Service_Hana_File::extractFilesFromArchive($zipsrcname,$temp_dir,$_POST,$data["extract_type"]); // extrahuji vsechny obrazky do temp-adresare
        // provedu iteraci pres soubory v archivu
        
        //die(print_r($post_array));
        
        $global_title=true;
        foreach($post_array as $item)
        {
           if(!$data["nazev"] || !$global_title)
           {
               $global_title=false;
               $fn_arrray = explode('.',$item["file"]["name"]);
               array_pop($fn_arrray);
               $filename=implode(" ", $fn_arrray);
               
               $data["nazev"]=$filename;
           }
           
           $gallery_orm->clear();
           $this->insert_gallery_image($gallery_orm, $related_col_name, $related_id, $item, $images_dir, $image_settings, $data);

        }    
        // zpracovani chyb
    }

    public function insert_file($file_orm, $related_col_name, $related_id, $filesrcname, $files_dir, $data)
    {
        // testovani pripony
        if($filename=$_FILES[$filesrcname]["name"])
        {
            $ext=Service_Hana_File::extension_check($filename);
            //if(!$ext) return(array("src"=>"typ souboru musí být jpg, jpeg, png, nebo gif!"));
        }
        else
        {
            $ext="";
        }

        if(!$file_orm->id)
        {
            // novy zaznam priradime potrebne parametry
            $file_orm->$related_col_name=$related_id;
            $file_orm->poradi=$this->get_new_order_position($file_orm,false,$related_col_name,$related_id); // ziskam nove poradi podle id subjektu
        }
        else
        {
            // pokud jde o editaci a vkladam novy soubor, musim fyzicky smazat ten puvodni (jine seo-nazvy souboru)
            if($_FILES[$filesrcname]["name"])
            {
                Service_Hana_File::delete_file($related_id, $files_dir, $file_orm->file_src, $file_orm->ext);
            }
        }

        // algoritmus vygenerovani a ulozeni fyzickeho unikatnihu nazvu obrazku - preskocime, pokud nebyl vlozen
        if($_FILES[$filesrcname]["name"])
        {
            //$file_src=seo::uprav_fyzicky_nazev($data["nazev"]);
            $file_src=Service_Hana_File::get_raw_file_name($_FILES['microedit_file_src']['name']);
            $inital_photo_src=$file_src;
            $counter=0;
            while(db::select(array('COUNT("*")', 'total_row_count'))->from($file_orm->table_name())->where("file_src","=",$file_src)->where($related_col_name,"=",$related_id)->execute()->get('total_row_count'))
            {
                $counter++;
                $file_src=$inital_photo_src."_".$counter; // pridam poradovy cislo a testuju, zda je volny
            }
            $file_orm->file_src=$file_src;
        }

        // doplnim obecna data do ormka
        $file_orm->nazev=$data["nazev"];
        //$file_orm->cz=$data["cz"];
        //$file_orm->en=$data["en"];
        $file_orm->popis=$data["popis"];
//        $file_orm->zobrazit=($data["zobrazit"])?1:0;
        $file_orm->zobrazit=1;       
        if($ext) $file_orm->ext=$ext;

        // provedu generovani a ulozeni vlastniho obrazku (pouze pokud byl vlozen)
        if($_FILES[$filesrcname]["name"]) Service_Hana_File::upload_file($related_id, $filesrcname, $files_dir, $file_src.".".$ext);

        // ormko naplneno, fyzicke ulozeni obrazku se povedlo - ulozim data
        $file_orm->save();

    }

    public function reorder_two_items($item_id, $reorder_direction, $specific_orm=false, $specific_parent_id_name_1=false, $specific_parent_id_name_2=false)
    {
        $orm=$specific_orm?$specific_orm:$this->orm;
        $orm->find($item_id);
        if(!$specific_parent_id_name_1) $specific_parent_id_name_1=($this->is_orm_tree)?"parent_id":false;

        if($reorder_direction=="up"){$literal="<"; $direct="desc";}else{$literal=">"; $direct="asc";}
        $actual_pos=$orm->poradi;
        if($specific_parent_id_name_1) $parent_id=$orm->$specific_parent_id_name_1;
        if($specific_parent_id_name_2) $parent_value=$orm->$specific_parent_id_name_2;
        
        $siblink=orm::factory($orm->class_name)->where(strtolower($orm->table_name()).".poradi",$literal,$actual_pos);
        if($specific_parent_id_name_1) $siblink->where($specific_parent_id_name_1,"=",$parent_id);
        if($specific_parent_id_name_2) $siblink->where($specific_parent_id_name_2,"=",$parent_value);
        $siblink = $siblink->order_by(strtolower($orm->table_name()).".poradi",$direct)->limit(1)->find();
        //die(print_r($siblink));
        $orm->poradi=$siblink->poradi;
        $orm->save();

        $siblink->poradi=$actual_pos;
        $siblink->save();
    }

    public function reorder_many_items($table_name,$items_sequence,$related_id=false)
    {
        $db=Database::instance();
        $vybrana_polozka=$items_sequence[0];
        $items_sequence[0]=0;
        $zamistovana_polozka=0; // za tuto polozku se vklada
        foreach($items_sequence as $key=>$item){
        if($item==$vybrana_polozka){
            //echo("vybraná položka: ".$vybrana_polozka.", předcházející položka: ".$zamistovana_polozka);
            $nasledujici_polozka=(isset($items_sequence[$key+1])?$items_sequence[$key+1]:0);
            break;
            }
        $zamistovana_polozka=($item)?$item:0;
        }

        $parentcat="";
        $parentcat_update="";
        $ormtree = false;

        if($related_id && !is_array($related_id)){
           $ormtree = true;
        }elseif(is_array($related_id)){
           $parentcat_update.=" AND ".$related_id[0]." = ".$related_id[1];
        }

        if($ormtree){$parentcat=", parent_id";}else{$parentcat="";}

        $result = DB::query(Database::SELECT, "SELECT id, poradi".$parentcat." FROM `".$table_name."` WHERE id = $vybrana_polozka")->as_object()->execute()->current();
        //die("SELECT id, poradi".$parentcat." FROM ".$table_name." WHERE id = $vybrana_polozka");

        $poradi_vybrane=$result->poradi;

        if($ormtree){
            $id_vybrane=$result->id;
            $parentcat_vybrane=$result->parent_id;
            $parentcat_update=" AND parent_id=".$parentcat_vybrane;
        }

        if($zamistovana_polozka){
            $result = DB::query(Database::SELECT, "SELECT id, poradi ".$parentcat." FROM `".$table_name."` WHERE id = $zamistovana_polozka")->as_object()->execute()->current();
            $poradi_zamistovane=$result->poradi;
            if($ormtree)$parentcat_zamistovane=$result->parent_id;
        }else{$poradi_zamistovane=0;$parentcat_zamistovane=0;}

        if($ormtree){ //pokud se presune polozka na prvnii pozici v dane podkategorii
            $result = DB::query(Database::SELECT, "SELECT id FROM `".$table_name."` WHERE parent_id = $parentcat_vybrane ORDER BY poradi LIMIT 1")->as_object()->execute()->current();
            if($result->id==$nasledujici_polozka){$poradi_zamistovane=0; $zamistovana_polozka=0; $parentcat_zamistovane=$parentcat_vybrane;}

        }

        //echo("vybrana id:".$vybrana_polozka.", kategorie vybrane:".$parentcat_vybrane." - zamistovana id:".$zamistovana_polozka.", kategorie zamistovane:".$parentcat_zamistovane.", id nasledujici:".$nasledujici_polozka);

        if(!$ormtree || $parentcat_vybrane==$parentcat_zamistovane){
        // presun ve stejne kategorii
            $ids=array();
            if($poradi_vybrane>$poradi_zamistovane){
                //posun nahoru, nejprve precislovani mezilehlych polozek
                $result = DB::query(Database::SELECT, "SELECT `id` FROM `".$table_name."` WHERE poradi > $poradi_zamistovane AND poradi < $poradi_vybrane".$parentcat_update." ORDER BY poradi")->execute();
                foreach($result as $row){
                  //$db->query("UPDATE `".$table_name."` SET `poradi`=".($row->poradi+1)." WHERE id=$row->id");
                  $ids[]=$row["id"];
                }
                
                if(!empty($ids))
                {    
                    DB::query(Database::UPDATE, "UPDATE `".$table_name."` SET `poradi`= poradi+1 WHERE id in(".implode(",", $ids).")")->execute();
                    DB::query(Database::UPDATE, "UPDATE `".$table_name."` SET `poradi`=".($poradi_zamistovane+1)." WHERE id=$vybrana_polozka")->execute();
                }

            }elseif($poradi_vybrane<$poradi_zamistovane){
                //posun dolu, nejprve precislovani mezilehlych polozek
                $result = DB::query(Database::SELECT,"SELECT `id` FROM `".$table_name."` WHERE poradi <= $poradi_zamistovane AND poradi > $poradi_vybrane".$parentcat_update." ORDER BY poradi")->execute();
                foreach($result as $row){
                  //$db->query("UPDATE `".$table_name."` SET `poradi`=".($row->poradi-1)." WHERE id=$row->id");
                  $ids[]=$row["id"];
                }
                
                if(!empty($ids))
                {    
                    DB::query(Database::UPDATE,"UPDATE `".$table_name."` SET `poradi`= poradi-1 WHERE id in(".implode(",", $ids).")")->execute();
                    DB::query(Database::UPDATE,"UPDATE `".$table_name."` SET `poradi`=".($poradi_zamistovane)." WHERE id=$vybrana_polozka")->execute();
                }
            }
        }else{
         // presun z kategorie do kategorie
         if(!$parentcat_zamistovane==$id_vybrane){ // nelze presunout polozku pod vlastni kategorii (id != parent_id)
          // zmena parent_id premistovane

          // precislovani ve stavajici kategorii o chybejici polozku

          // precislovani v nove kategorii o novou polozku


         }
       }
    }

    public function get_new_order_position($orm=false, $is_orm_tree=false, $parent_name=false, $parent_id=false)
    {

        if($is_orm_tree)
        {
            $parent_id=($orm->parent_id)?$orm->parent_id:0;
            $result=DB::select(array(DB::expr("max(".$orm->table_name().".poradi)"),"poradi"))->from($orm->table_name())->where("parent_id","=",$parent_id)->execute();
        }
        elseif($parent_name)
        {
            $result=DB::select(array(DB::expr("max(".$orm->table_name().".poradi)"),"poradi"))->from($orm->table_name())->where($parent_name,"=",$parent_id)->execute();
        }
        else
        {
            $result=DB::select(array(DB::expr("max(".$orm->table_name().".poradi)"),"poradi"))->from($orm->table_name())->execute();
        }
        //echo Kohana::debug($result); echo($result[0]["poradi"]); die();

        //die("nove_cislo ".$result[0]["poradi"]." id:".$this->orm->id." parent_id:".$this->orm->parent_id);
        return ($result[0]["poradi"]+1);

    }

    /**
     * Navaze zvolene kategorie k ormku. Pomocna metoda za chybejici funkcnost v ORMku.
     * @param array $categories pole kategorii
     */
    public function bind_categories($categories, $singular, $plural="", $bind_parent_categories=true)
    {
        if(!$plural) $plural=Inflector::plural($singular);
        $selected_numbers=array();
        $added_numbers=array();
        $deleted_numbers=array();

        foreach($this->orm->$plural->find_all() as $category)
        {
            $selected_numbers[]=$category->id;
        }

        // Get new numbers
        if(is_array($categories)) $added_numbers = array_diff($categories, $selected_numbers);

        // Get deleted numbers
        $deleted_numbers = array_diff($selected_numbers, (array) $categories);

        // Add new numbers
        foreach ($added_numbers as $number_id)
        {
            $number_id = (int) $number_id; // Extra type check
            if($bind_parent_categories)
            {
                $parent_ids=$this->_get_parent_categories_ids($plural,$number_id);
                
                foreach($parent_ids as $pid)
                {
                    $this->orm->add($plural, ORM::factory($singular, $pid));
                }
            }
            
            $this->orm->add($plural, ORM::factory($singular, $number_id));
        }

        // Remove numbers
        foreach ($deleted_numbers as $number_id)
        {
            $number_id = (int) $number_id; // Extra type check
            $this->orm->remove($plural, ORM::factory($singular, $number_id));
        }

    }
    
    public function list_table_to_csv(array $data)
    {
        $temp=array();
        foreach ($data["head_row"] as $name => $col) {
            $temp[]=isset($col["content"])?$col["content"]:"";
        }
        $data_array[]=$temp;
        
        foreach ($data["data_section"] as $key => $col) {
            $data_array[]=$col;
        }

        return self::_generate_csv_data($data_array);
    }
    
    
    

    public function insert_product_parameter($param_id,$param_value,$editparam_id=0)
    {
        if($editparam_id)
        {
            // akce na editaci parametru
            $editparam_orm=orm::factory("product_parameters_product")->where("product_id","=",$this->orm->id)->where("product_parameters_products.product_parameter_id","=",$editparam_id)->find();
            //->join("product_parameter_data")->on("product_parameters_products.product_parameter_id","=","product_parameter_data.product_parameter_id"
            $editparam_orm->product_parameter_id=$param_id;
            $editparam_orm->hodnota=$param_value;

            $editparam_orm->save();
        }
        else
        {
            // akce na pridani parametru
            $newparam_orm=orm::factory("product_parameters_product");
            $newparam_orm->product_id=$this->orm->id;
            $newparam_orm->product_parameter_id=$param_id;
            $newparam_orm->hodnota=$param_value;
            $newparam_orm->save();

        }

    }

    public function delete_product_parameter($param_id)
    {
        $editparam_orm=orm::factory("product_parameters_product")->where("product_id","=",$this->orm->id)->where("product_parameters_products.product_parameter_id","=",$param_id)->find();
        $editparam_orm->delete();
    }

     public function insert_price_category($price_category_id, $value)
    {
            $value = str_replace(",", ".", $value);
            if(!is_numeric($value)) return false;
            // akce na editaci parametru
            $editparam_orm=orm::factory("price_categories_product")->where("product_id","=",$this->orm->id)->where("price_category_id","=",$price_category_id)->find();
            $editparam_orm->product_id=$this->orm->id;
            $editparam_orm->price_category_id=$price_category_id;
            $editparam_orm->cena=$value;
            $editparam_orm->save();
            return true;
    }

    public function delete_price_category($param_id)
    {
        $editparam_orm=orm::factory("price_categories_product")->where("product_id","=",$this->orm->id)->where("price_categories_products.price_category_id","=",$param_id)->find();
        $editparam_orm->delete();
    }
    
    private function _get_parent_categories_ids($table,$id,$categories=array())
    {
        $parent_id=DB::select("parent_id")->from($table)->where("id","=",$id)->execute()->get("parent_id");
        if($parent_id)
        {
            $categories=$this->_get_parent_categories_ids($table,$parent_id);
            $categories[]=$parent_id;
        }
        return($categories);
    }
    
    private static function _generate_csv_data($rows = array(), $delimiter = ',', $enclosure = '"') {
       $str = '';
       $escape_char = '\\';
       foreach($rows as $fields){
           foreach ($fields as $key=>$value) {
             if (strpos($value, $delimiter) !== false ||
                 strpos($value, $enclosure) !== false ||
                 strpos($value, "\n") !== false ||
                 strpos($value, "\r") !== false ||
                 strpos($value, "\t") !== false ||
                 strpos($value, ' ') !== false) {
               $str2 = $enclosure;
               $escaped = 0;
               $len = strlen($value);
               for ($i=0;$i<$len;$i++) {
                 if ($value[$i] == $escape_char) {
                   $escaped = 1;
                 } else if (!$escaped && $value[$i] == $enclosure) {
                   $str2 .= $enclosure;
                 } else {
                   $escaped = 0;
                 }
                 $str2 .= $value[$i];
               }
               $str2 .= $enclosure;
               $str .= $str2.$delimiter;
             } else {
               $str .= $value.$delimiter;
             }
           }
           $str = strip_tags($str); // doplneno stripovani tagu
           $str = substr($str,0,-1);
           $str .= "\n";
       }
       return $str;
    }


}
?>
