<?php
namespace controllers\indexController;

use core\service\Toolbox;
use models\FileManager;

require_once "./core/constants.php";
require_once("./models/FileManager.php");
require_once("./core/services/Toolbox.php");

class uploadController
{
    private $filemanager;

    public function __construct(FileManager $filemanager)
    {
        $this->filemanager = $filemanager;
    }

    /**
     * @return false|string
     */
    public function uploadfiles()
    {
        try {
            //chemin vers le conteneur des fichiers bruts
            $file = './'.FILESUPLOAD;

            //variable contenant le tableau qui liste le nom des fichiers que contient $file
            $folder = $this->filemanager->readDir($file);

            //convertion dee tout les fichiers lisibles en pdf et transfert ces pdf vers un autre dossier
            foreach ($folder as &$fileinfolder) {
                $this->filemanager->convertFilesToPdf($fileinfolder);
            }
            //crée(met à jour) un fichier où sera noté le manifest des noms des fichiers pdf.
            $this->filemanager->createManifest();
            echo json_encode("fichiers récupérés");

        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
        return http_response_code(200);
    }

    /**
     * @param $file|mixed
     */
    public function uploadfilesbyone($file)
    {

        try{
            $fileupload = './'.FILESUPLOAD;
            $filebasename = basename($file['name']);
            move_uploaded_file($file['tmp_name'], $fileupload .'/'. $filebasename);
            $this->filemanager->convertFilesToPdf($filebasename);
            $this->filemanager->createManifest();
            echo $filebasename." a bien été ajouté";

        }catch(\Exception $e){
            echo  json_encode('Exception reçue pour upload dun fichier: ',  $e->getMessage(), "\n");
        }
    }
}
$upload = new uploadController(new FileManager(new Toolbox()));


if(isset($_FILES["fileupload"]))
{
    $upload->uploadfilesbyone($_FILES["fileupload"]);
}else{
    $upload->uploadfiles();
}

