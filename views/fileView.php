<?php
namespace fileView;

use controllers\indexController\indexController;

require_once("./controllers/indexController.php");

$fileController = new indexController();
$filesReady = $fileController->renderManifest();


?>

        <div id="filescontainer" class="col-lg-12 col-md-12 col-sm-auto" >
            <div id="myfiles">
<?php
                if(empty($filesReady))
                {
                echo "
                <div class=\"alert alert-danger\">
                <strong>Aucun fichiers veuillez recharger le container de fichier.</strong>
                </div>";

            } else {
                foreach ($filesReady as &$val) {
                    echo "
                    <div class=\"list-group\">
                            <button type=\"button\" class=\"list-group-item list-group-item-action\" data-toggle=\"modal\" data-target=\"#exampleModal".$val->id."\">
                                ".$val->filename."
                            </button>
                            
                            <div class=\"modal fade\" id=\"exampleModal".$val->id."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel".$val->id."\" aria-hidden=\"true\">
                                <div class=\"modal-dialog\" role=\"document\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h5 class=\"modal-title\" id=\"exampleModalLabel".$val->id."\">".$val->filename."</h5>
                                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                                <span aria-hidden=\"true\">&times;</span>
                                            </button>
                                        </div>
                                        <div class=\"modal-body\">
                                        <embed src=".FILESREADY.'/'.$val->file." frameborder=\"0\" width=\"100%\" height=\"400px\">
                                        </div>
                                        <div class=\"modal-footer\">
                                            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
              }
            }
            ?>
            </div>
        </div>


