<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Servisni trida obsluhujici pozadavky na praci se soubory
 *
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Hana_File {

    private static $photos_resource_dir="media/photos/";
    private static $videos_resource_dir="media/videos/";
    private static $files_resource_dir="media/files/";
    private static $default_photo_quality=90;
    private static $admin_photo_formats=array("at"=>array("resize"=>"160,160","ext"=>"jpg"), "ad"=>array("resize"=>"800,600","ext"=>"jpg"));
    /**
     * Mazani adresare vcetne podadresaru a souboru.
     * @param string $folderPath
     * @return boolean
     */
    public static function recursiveFolderDelete ( $folderPath, $no_self_delete=false )
    {
        $folderPath=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$folderPath;

        self::recursiveFolderDeleteMain($folderPath, $no_self_delete);
    }

    public static function recursiveFolderDeleteMain ( $folderPath, $no_self_delete=false )
    {
        if ( is_dir ( $folderPath ) )
        {
            foreach ( scandir ( $folderPath )  as $value )
            {
                if ( $value != "." && $value != ".." )
                {
                    $value = $folderPath . "/" . $value;
                    if ( is_dir ( $value ) )
                    {
                        self::recursiveFolderDeleteMain ( $value );
                    }
                    elseif ( is_file ( $value ) )
                    {
                        @unlink ( $value );
                    }
                }
            }
            if($no_self_delete)
            return;
            else
            return rmdir ( $folderPath );
        }
        else
        {
            return FALSE;
        }
    }


    public static function delete_simple_photo( $folderPath, $fileName )
    {
        $completeDir = $folderPath=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$folderPath;
        $pattern = "/^($fileName).*/i";
        $files = scandir($completeDir);
        foreach ($files as $file)
        {
            if (!is_dir($completeDir.$file) && $file != "." && $file != ".." && preg_match($pattern, $file))
            {
                @unlink($completeDir.$file);
            }
        }
    }


    public static function create_images($folder_id, $imagesrcname, $images_dir, $image_settings, $image_name, $delete_source=true, $image_ext="jpg", $col_name="photo_src")
    {
        //die($orm_row_id." ".$imagesrcname." ".$images_dir." ".$image_settings." ".$image_name);
        // vytvorim adresar
        $dirpath=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$images_dir."images-".$folder_id."/";
        if(!file_exists($dirpath)) mkdir($dirpath);
        
        $uploadfile = $dirpath.$image_name.".".$image_ext;

        if(strpos($imagesrcname, "/")!==false)
        {
            // vyjimka - pokud je nazev souboru cesta jde o obrazek jiz nahrany na disku (rozbaleny z archivu zip) - je nutne ho pouze zkopirovat do prislusneho adresare s prislusnym zmenenym nazvem
            if (!copy($imagesrcname, $uploadfile))
            {
               throw new Kohana_Exception("Chyba - nemohu přesunout obrázek!");
            }
        }
        else
        {
            if (!move_uploaded_file($_FILES[$imagesrcname]['tmp_name'], $uploadfile)) {
               throw new Kohana_Exception("Chyba - nemohu uložit obrázek!");// chybova hlaska
            }
        }

        $admin_formats = array();
        foreach (self::$admin_photo_formats as $key=>$format)
        {
            $admin_formats[$key] = $format;
            $admin_formats[$key]["ext"] = $image_ext;
        }
        //(print_r($image_settings));
        $image_settings=array_merge($admin_formats, $image_settings);
        //die(print_r($image_settings));
        // zmena velikosti a oriznuti nahraneho obrazku
            foreach($image_settings as $photo_suffix=>$settings){
            $image = Image::factory($uploadfile);
               foreach($settings as $setting=>$values){
                   $values=explode(",", $values);
                   switch($setting){
                       case "resize":
                           $image->$setting(isset($values[0])?$values[0]:NULL,isset($values[1])?$values[1]:NULL,isset($values[2])?(eval("return ".$values[2].";")):NULL);
                       break;
                       case "crop":
                           $image->$setting($values[0],$values[1],isset($values[2])?$values[2]:NULL, isset($values[3])?(eval("return ".$values[2].";")):NULL);
                       break;
                       case "rotate":
                       case "flip":
                       case "sharpen":
                       case "quality":
                          $image->$setting($values);
                       break;
                       case "watermark":
                         // pred kopirovanim vodoznaku se obrazek musi ulozit - jinak nefunguje
//                             $image->save(str_replace('\\', '/',DOCROOT).$resource_directory."/".$images_dir."-".$data["photo_category_id"]."/img-".$post["id"]."-$photo_name".".".(string)(isset($settings["ext"])?$settings["ext"]:$ext));
//                             $image = new Image(str_replace('\\', '/',DOCROOT).$resource_directory."/".$images_dir."-".$data["photo_category_id"]."/img-".$post["id"]."-$photo_name".".".(string)(isset($settings["ext"])?$settings["ext"]:$ext));
//                             $image->watermark(new Image(str_replace('\\', '/',DOCROOT).$resource_directory."/".$values),20);
                       break;
                       case "ext": // pripona v nastaveni bere prednost pred priponou uploadnuteho obrazku (jinak pripona uploadu=pripona transformovaneho a ulozeneho)
                       $image_ext=$values[0];
                       break;
                   }

               }

                // defaultni nastaveni kvality
                $quality=isset($settings["quality"])?$settings["quality"]:self::$default_photo_quality;

                $image->save($dirpath."/".$image_name."-".$photo_suffix.".".$image_ext, $quality);
            }


            // smazani zdrojoveho obrazku
            if($delete_source) @unlink($uploadfile);

            return true;
    }

    public static function create_videos($folder_id, $videosrcname, $videos_dir, $video_name)
    {
        // vytvorim adresar
        $dirpath=str_replace('\\', '/',DOCROOT).self::$videos_resource_dir.$videos_dir."videos-".$folder_id."/";
        if(!file_exists($dirpath)) mkdir($dirpath);

        $uploadfile = $dirpath.$video_name;

        if(strpos($videosrcname, "/")!==false)
        {
            // vyjimka - pokud je nazev souboru cesta jde o video jiz nahrany na disku (rozbaleny z archivu zip) - je nutne ho pouze zkopirovat do prislusneho adresare s prislusnym zmenenym nazvem
            if (!copy($videosrcname, $uploadfile))
            {
                throw new Kohana_Exception("Chyba - nemohu přesunout video!");
            }
        }
        else
        {
            if (!move_uploaded_file($_FILES[$videosrcname]['tmp_name'], $uploadfile)) {
                throw new Kohana_Exception("Chyba - nemohu uložit video!");// chybova hlaska
            }
        }
        //(print_r($image_settings));
        //die(print_r($image_settings));

        move_uploaded_file( $_FILES[$videosrcname]['tmp_name'], $uploadfile);



        return true;
    }

    public static function check_if_photo_exists($filename)
    {
        if(file_exists(str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$filename)) return true; else return false;
    }

    public static function check_if_video_exists($filename)
    {
        if(file_exists(str_replace('\\', '/',DOCROOT).self::$videos_resource_dir.$filename)) return true; else return false;
    }

    public static function delete_images($folder_id, $images_dir, $image_settings, $image_name, $image_ext, $delete_folder=false)
    {
        $dirpath=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$images_dir."images-".$folder_id."/";
        $image_settings=array_merge(self::$admin_photo_formats, $image_settings);
        //die(print_r($image_settings));
        // zmena velikosti a oriznuti nahraneho obrazku
        foreach($image_settings as $photo_suffix=>$settings)
        {
            @unlink($dirpath.$image_name."-".$photo_suffix.".".$image_ext);
        }

        if($delete_folder) @unlink($dirpath);

    }

    public static function delete_videos($folder_id, $videos_dir, $video_name, $delete_folder=false)
    {
        $dirpath = str_replace('\\', '/',DOCROOT).self::$videos_resource_dir.$videos_dir."videos-".$folder_id."/";
        @unlink($dirpath.$video_name);

        if($delete_folder) @unlink($dirpath);
    }

    public static function recurse_photo_copy($src,$dst)
    {
        $src=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$src;
        $dst=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$dst;
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
        return true;
    }

    public static function rename_images($folder_id, $images_dir, $image_settings, $image_name_old, $image_ext, $image_name_new)
    {
        $dirpath=str_replace('\\', '/',DOCROOT).self::$photos_resource_dir.$images_dir."images-".$folder_id."/";
        foreach($image_settings as $photo_suffix=>$settings)
        {
            $old=($dirpath.$image_name_old."-".$photo_suffix.".".$image_ext);
            $new=($dirpath.$image_name_new."-".$photo_suffix.".".$image_ext);
            rename($old, $new);
        }
    }

    public static function upload_file($folder_id, $filesrcname, $files_dir, $filename_full)
    {
        //die($orm_row_id." ".$imagesrcname." ".$images_dir." ".$image_settings." ".$image_name);
        // vytvorim adresar
        $dirpath=str_replace('\\', '/',DOCROOT).self::$files_resource_dir.$files_dir."/files-".$folder_id."/";
        if(!file_exists($dirpath)) mkdir($dirpath);

        $uploadfile = $dirpath.$filename_full;
        if (!move_uploaded_file($_FILES[$filesrcname]['tmp_name'], $uploadfile)) {
           throw new Kohana_Exception("Chyba - nemohu uložit obrázek!");// chybova hlaska
        } else {
          return $dirpath;
        }


    }

    public static function delete_file($folder_id, $subject_dir, $file_name, $file_ext)
    {
        $dirpath=str_replace('\\', '/',DOCROOT).self::$files_resource_dir.$subject_dir."files-".$folder_id."/";
        //die($dirpath.$file_name.".".$file_ext);
        @unlink($dirpath.$file_name.".".$file_ext);
    }

    public static function extension_check($file, array $extensions = array())
    {
        $ext = explode('.',$file);
        $ext = strtolower($ext[count($ext)-1]);

        $valid=false;
        if(!empty($extensions)){
        foreach($extensions as $extension){
            if($ext==$extension) $valid=true;
        }
        if($valid){return($ext);}else{return(false);}
        }else{
            return($ext);
        }
    }

    public static function get_raw_file_name($file)
    {
        $str = explode('.',$file);
        unset($str[count($str)-1]);
        return implode(".", $str);
    }
    
    public static function extractFilesFromArchive($name,$dir,$post=array(),$sort_by="name"){
          include_once(str_replace('\\', '/',DOCROOT)."modules/hana/external_libraries/PclZip/pclzip.lib.php");
          
          $post_array=array();

          // Remote file, path and local dir
          $fileName   = $_FILES[$name]['name'];
          $uploadfile = $dir.$_FILES[$name]['name'];
          if (!move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)) {
             throw new Kohana_Exception('Chyba při práci se souborem - Nemohu uložit soubor.');// chybova hlaska
          }

          $archive = new PclZip($uploadfile);
          $list = $archive->extract(PCLZIP_OPT_PATH, $dir);
          unlink($uploadfile);
          if ($list == 0) {
              throw new Kohana_Exception("ZIP ERROR : ".$archive->errorInfo(true));
          }else{


          // krome extrahovani souboru jeste vytvorim pole prislusnych hodnot, pro zpracovani a ulozeni do DB
          $handle = opendir($dir);
          $post["id"]=0;
          $post["poradi"]=0;
          $post["ext"]=0;
          $post["edit"]=0;
          $post["file-type-zip"]=1;
          while (false !== ($file = readdir($handle))) {
              if ($file != "." && $file != "..") {
                $post["file"]['name']=$file;
                $post["imagesrcname"]=$dir.$file; // vyjimka pro obrazky (funkce imagesCreate potrebuje parametr s cestou k obrazku)
                $post["file"]["time"]=filemtime ($dir.$file);
                if($sort_by=="time")
                {    
                   $x=$post["file"]['time']; 
                }
                else
                {
                   $x=$post["file"]['name']; 
                }
                $post_array[$x]=$post; // zakladni parametry pro archiv fotek prebiram z formulare
                
              }
            }
          }
          
          if($sort_by=="time")
                {    
                   ksort($post_array, SORT_NUMERIC);
                }
                else
                {
                   ksort($post_array, SORT_LOCALE_STRING); 
                }
          
          
          return($post_array);

    }

}
?>
