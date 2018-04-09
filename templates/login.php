<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Iniciar Sesión</h3>
                <form method="POST" action="<?php echo $this->getUrl('/login') ?>" novalidate>
                    <p class="text-danger"><?php echo $this->error ?></p>
                    <div class="form-group">
                        <label for="staticEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="staticEmail" value="<?php $this->email ?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

