<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $this->getStatic('bootstrap-material-design.min.css') ?>">
    <title><?php echo $this->title ?></title>
</head>
<body>
<div class="container">
    <div class="row justify-content-end pt-3">
        <div class="col-auto">
            <?php if($this->isLoggedIn()) { ?>
                <a href="<?php echo $this->getUrl('/perfil') ?>">
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
            <h1><a href="<?php echo $this->getUrl('/') ?>">Biblioteca</a></h1>
        </div>
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
    </div>
    <?php
    $this->render();
    ?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $this->getStatic('jquery-3.2.1.slim.min.js') ?>"></script>
<script src="<?php echo $this->getStatic('popper.js') ?>"></script>
<script src="<?php echo $this->getStatic('bootstrap-material-design.js') ?>"></script>
<script src="<?php echo $this->getStatic('app.js') ?>"></script>
</body>
</html>