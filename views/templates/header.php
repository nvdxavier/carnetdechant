<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Carnet de chants</title>
    <link rel="stylesheet" href="<?php echo ROOT_VIEWS; ?>css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo ROOT_VIEWS; ?>css/bootstrap-grid.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo ROOT_VIEWS; ?>css/bootstrap-reboot.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo ROOT_VIEWS; ?>css/style.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
<!--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>-->

<div class="container-fluid" id="lachoraleguiness">
    <div class="py-5 text-center">
        <img class="" src="<?php echo ROOT_VIEWS; ?>/img/8fbf4f683db76a1fdf1a9f65e80860c9.jpg" alt="" width="200" height="172">
        <h1 class="fontChorale">Carnet de chants</h1>
    </div>
    <div class="container listefichier">
    <div class="row" id="myrow">
        <div class="col-lg-12 col-md-12 col-sm-auto">
            <p></p>
            <nav class="navbar navbar-expand-lg navbar-light listbackground">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <p></p>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <button type="button" onclick="uploadFiles()" class="btn btn-outline-dark">Recharger la liste</button>
                            <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapseUploadFileForm" aria-expanded="false" aria-controls="collapseUploadFileForm">
                                Transmettre un nouveau fichier
                            </button>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input oninput="searchFile();" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="fieldsearch">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <div class="collapse" id="collapseUploadFileForm">
                <div class="form-inline my-2 my-lg-0">
                    <form method="POST" enctype=multipart/form-data id="myformupload">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Fichiers acceptés: doc | docx | xls | xlsx | odt | txt </label>
                            <input type="file" name="fileupload" value="fileupload" id="exampleFormControlFile1" class="form-control-file" accept=".odt, .docx, .doc, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </form>
                </div>
            </div>
            <p></p>
        </div>
<?php
