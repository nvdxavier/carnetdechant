<?php
namespace controllers\indexController;

use core\service\Toolbox;
use models\FileManager;

require_once './vendor/phpoffice/phpword/bootstrap.php';
require('./vendor/autoload.php');

require_once("./models/FileManager.php");
require_once("./core/services/Toolbox.php");
require_once("./core/init.php");

class indexController
{

    public function renderFilesReady()
    {
        $filesreadyfolder = './'.FILESREADY;
        $filemanager = new FileManager(new Toolbox());

        return $filemanager->readDir($filesreadyfolder);
    }

    public function renderManifest()
    {
        $manifest = './views/manifest/manifest.json';

        if(!is_file($manifest)){
            $getmanifest = null;
        }else{
            $getmanifest = json_decode(file_get_contents($manifest));
        }

       return $getmanifest;
    }
}

globaltemplate('./views/fileView.php');
