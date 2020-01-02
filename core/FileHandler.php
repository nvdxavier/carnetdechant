<?php
require_once("interfaces/FileHandlerInterface.php");
require_once("constants.php");


class FileHandler implements FileHandlerInterface
{

    public function readFile($rootfile)
    {
        if ($handle = opendir($rootfile)) {
            echo "Gestionnaire du dossier : $handle\n";
            echo "Entrées :\n";

            while(false !== ($entry = readdir($handle))) {
               return "$entry\n";
            }

        }else{
            return 'ok';
        }

        return null;
    }

    /**
     * @param string $files
     * @return array|string
     */
    public function readDir(string $files)
    {
        if(is_dir($files)) {
            $filelistinfolder = [];

            $dh = opendir($files);
            while (false !== ($file = readdir($dh))) {

              if(($file != ".") && ($file != "..")) {
                  $filelistinfolder[] .= $file;
              }
            }
            return $filelistinfolder;
            closedir($dh);

        }else{
            return "dossier inexistant";
        }
    }
}

?>
