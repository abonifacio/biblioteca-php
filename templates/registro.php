<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Registrarse</h3>
                <form enctype="multipart/form-data" method="POST" action="<?php echo $this->getUrl('/registrarse') ?>" novalidate>
                    <?php foreach ($this->errors as $error) { ?>
                        <p class="text-danger"><?php echo $error ?></p>
                    <?php } ?>
                    <div class="form-group row">
                        <div class="col">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" value="<?php $this->usuario->nombre ?>"  required>
                        </div>
                        <div class="col">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="apellido" value="<?php $this->usuario->apellido ?>"  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="staticEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="staticEmail" value="<?php $this->usuario->email ?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="fotoPerfil">Adjuntar foto de perfil</label>
                        <input type="file" name="foto" class="form-control-file" id="fotoPerfil">
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword" required>
                        </div>
                        <div class="col">
                            <label for="inputConfirmPassword">Confirmar contraseña</label>
                            <input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

