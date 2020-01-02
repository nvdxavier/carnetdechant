<?php
namespace models;

require_once("./core/interfaces/ToolboxInterface.php");
require_once "./vendor/phpoffice/phpword/src/PhpWord/Settings.php";
require_once "./vendor/phpoffice/phpword/src/PhpWord/IOFactory.php";
require './vendor/phpoffice/phpword/bootstrap.php';

use PhpOffice\PhpWord\Settings;

class FileManager
{
    private $toolboxinterface;

    public function __construct(\ToolboxInterface $toolboxinterface)
    {
        $this->toolboxinterface = $toolboxinterface;
    }

    public function convertFiles()
    {
        return $this->toolboxinterface;
    }


    /**
     * crée un PDF à partir d'un fichier
     * @param $file
     * @return bool
     */
    public function convertFilesToPdf($file)
    {
        $message ='';
        $filesreadyfolder = './'.FILESREADY;
        $filetoconvert = './'.FILESUPLOAD.'/'.$file;
        $fileinfos = $this->checkfiletype($file);

        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        Settings::setPdfRendererPath($filesreadyfolder);

        switch ($fileinfos['extension']) {
            case 'docx':
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filetoconvert, "Word2007");
                $phpWord->save('./'.FILESREADY.'/'.$this->toolboxinterface->formatString($fileinfos['filename']).'.pdf', "PDF");
                break;
            case 'odt':
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filetoconvert, "ODText");
                $phpWord->save('./'.FILESREADY.'/'.$this->toolboxinterface->formatString($fileinfos['filename']).'.pdf', "PDF");
                break;
            case 'txt':
            $message = $fileinfos['filename']." c'est du txt";
                break;
            case 'doc':
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filetoconvert, "MsDoc");
                $phpWord->save('./'.FILESREADY.'/'.$this->toolboxinterface->formatString($fileinfos['filename']).'.pdf', "PDF");
                break;
        }
        //renvoyer une réponse sérialisé pour le retour de la requète ajax
        return true;

    }


    private function checkfiletype($file)
    {
        $filepath= './'.FILESUPLOAD.'/'.$file;
        $getextensionfile = pathinfo($filepath);

        return $getextensionfile;
    }

    /**
     * @param string $files
     * @return array|string
     */
    public function readDir($files)
    {
        if(is_dir($files)) {
            $filelistinfolder = [];

            $dh = opendir($files);
            while (false !== ($file = readdir($dh))) {

                if(($file != ".") && ($file != "..")) {
                    $filelistinfolder[] .= $file;
                }
            }
            closedir($dh);
            return $filelistinfolder;

        }else{
            return "dossier inexistant";
        }
    }


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


    public function createManifest()
    {
        $filesreadyfolder = './'.FILESREADY;
        $tabformanifest = [];
        $i = 0;
        $dh = opendir($filesreadyfolder);
        while (false !== ($file = readdir($dh))) {

            if(($file != ".") && ($file != "..")) {
                $pathinfofilename = pathinfo($file);
                $tabfileinfos = ['id' => $i++,'filename' => $pathinfofilename["filename"], 'file' => $file];
                array_push($tabformanifest, $tabfileinfos);
            }
        }
        closedir($dh);

        $manifestfile = './views//manifest/manifest.json';
        $fp = fopen($manifestfile, 'w');

        fwrite($fp, json_encode($tabformanifest,JSON_FORCE_OBJECT));
        fclose($fp);
    }

}
