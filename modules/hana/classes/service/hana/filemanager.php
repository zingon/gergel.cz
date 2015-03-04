<?php defined('SYSPATH') or die('No direct script access.');


class Service_Hana_Filemanager
{

    private static $filemanager_class = null;

    public static function process_get($value)
    {
        $response = "";
        self::init_class();
        switch ($value) {
            default:

                self::$filemanager_class->error(self::$filemanager_class->lang('MODE_ERROR'));
                break;

            case 'getinfo':

                if(self::$filemanager_class->getvar('path')) {
                    $response = self::$filemanager_class->getinfo();
                }
                break;

            case 'getfolder':

                if(self::$filemanager_class->getvar('path')) {
                    $response = self::$filemanager_class->getfolder();
                }
                break;

            case 'rename':

                if(self::$filemanager_class->getvar('old') && self::$filemanager_class->getvar('new')) {
                    $response = self::$filemanager_class->rename();
                }
                break;

            case 'move':
                // allow "../"
                if(self::$filemanager_class->getvar('old') && self::$filemanager_class->getvar('new', 'parent_dir') && self::$filemanager_class->getvar('root')) {
                    $response = self::$filemanager_class->move();
                }
                break;

            case 'editfile':

                if(self::$filemanager_class->getvar('path')) {
                    $response = self::$filemanager_class->editfile();
                }
                break;

            case 'delete':

                if(self::$filemanager_class->getvar('path')) {
                    $response = self::$filemanager_class->delete();
                }
                break;

            case 'addfolder':

                if(self::$filemanager_class->getvar('path') && self::$filemanager_class->getvar('name')) {
                    $response = self::$filemanager_class->addfolder();
                }
                break;

            case 'download':
                if(self::$filemanager_class->getvar('path')) {
                    self::$filemanager_class->download();
                }
                break;

            case 'preview':
                if(self::$filemanager_class->getvar('path')) {
                    if(isset($_GET['thumbnail'])) {
                        $thumbnail = true;
                    } else {
                        $thumbnail = false;
                    }
                    $response = self::$filemanager_class->preview($thumbnail);
                }
                break;

            case 'maxuploadfilesize':
                self::$filemanager_class->getMaxUploadFileSize();
                break;
        }

        return $response;
    }

    public static function process_post($value)
    {
        $response = "";
        self::init_class();
        switch ($value) {
            default:

                self::$filemanager_class->error(self::$filemanager_class->lang('MODE_ERROR'));
                break;

            case 'add':

                if(self::$filemanager_class->postvar('currentpath')) {
                    self::$filemanager_class->add();
                }
                break;

            case 'replace':

                if(self::$filemanager_class->postvar('newfilepath')) {
                    self::$filemanager_class->replace();
                }
                break;

            case 'savefile':

                if(self::$filemanager_class->postvar('content', false) && self::$filemanager_class->postvar('path')) {
                    $response = self::$filemanager_class->savefile();
                }
                break;
        }

        return $response;
    }

    public static function init_class() {
        if (is_null(self::$filemanager_class)) {
            self::$filemanager_class = new Filemanager();
        }
    }

}