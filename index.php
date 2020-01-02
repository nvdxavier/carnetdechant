<?php
(isset($_GET['page'])) ? $root = $_GET['page'] : $root = 'home';

switch($root){
    case 'home':
        require_once("controllers/indexController.php");
        break;

    case 'upload':
        require_once("views/uploadView.php");
        break;

    case 'uploadcontroller':
        require_once("controllers/uploadController.php");
        break;

    default;

    break;
}

function globaltemplate($view)
{
    require_once "views/templates/header.php";
    require_once "views/templates/menu.php";
    require_once "$view";
    require_once "views/templates/footer.php";
}

?>

