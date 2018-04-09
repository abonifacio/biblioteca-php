<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title"><?php echo $this->libro->titulo ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">por <?php echo $this->autor->getFullName() ?></h6>
                <p class="card-text pt-3">
                    <h6>Descripcion</h6>
                    <?php echo $this->libro->descripcion ?>
                </p>
            </div>
            <div class="col-sm-auto">
                <img src="<?php echo $this->libro->getPortada() ?>" />
            </div>
        </div>
        <!--        <a href="#" class="card-link">Card link</a>-->
<!--        <a href="#" class="card-link">Another link</a>-->
    </div>
</div>
