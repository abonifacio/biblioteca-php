<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <style type="text/css">
        .foto-perfil{
            max-height: 150px;
            max-width: 300px;
        }
        .foto-portada-datalle{
            max-height: 300px;
            max-width: 500px;
        }
    </style>
    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $this->getStatic('bootstrap-material-design.min.css') ?>">
    <title><?php echo $this->title ?></title>
</head>
<body>
<?php if($this->isAlert()){ ?>
    <div class="alert alert-<?php echo $this->getAlertType() ?>" role="alert">
        <?php echo $this->getAlertMessage() ?>
    </div>
<?php } ?>
<div class="container">
    <div class="row justify-content-end pt-3">
        <div class="col-auto">
            <?php if($this->isLoggedIn()) { ?>
                <a href="<?php echo $this->isBibliotecario()? $this->getUrl('/admin') : $this->getUrl('/perfil')  ?>">
                    <?php echo $this->getCurrentEmail() ?>
                </a>
                |
                <a href="<?php echo $this->getUrl('/logout') ?>">
                    Cerrar sesión
                </a>
            <?php }else{ ?>
                <a href="<?php echo $this->getUrl('/registrarse') ?>">Registrarse</a>
                |
                <a href="<?php echo $this->getUrl('/login') ?>">Iniciar sesión</a>
            <?php } ?>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-sm-6">
            <a href="<?php echo $this->getUrl('/') ?>">
                <img src="<?php echo $this->getStatic('logo_informatica_large.png') ?>" alt="Biblioteca">
            </a>
        </div>
        <?php if($this->mustShowSearch()) { ?>
        <div class="col-sm-6">
            <form action="<?php echo $this->getUrl('/') ?>" method="GET">
                <div class="row align-items-end">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $this->getQueryParam('titulo') ?>">
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" class="form-control" id="autor" value="<?php echo $this->getQueryParam('autor') ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    <?php
    $this->render();
    ?>
</div>
<div id="common-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ups</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="common-modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $this->getStatic('jquery-3.2.1.slim.min.js') ?>"></script>
<script src="<?php echo $this->getStatic('popper.js') ?>"></script>
<script src="<?php echo $this->getStatic('bootstrap-material-design.js') ?>"></script>
<script src="<?php echo $this->getStatic('app.js') ?>"></script>
</body>
</html>