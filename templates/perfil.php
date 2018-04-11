<div class="card">
    <div class="card-body">
        <div class="row pb-4">
            <div class="col">
                <h5 class="card-title"><?php echo $this->user->getFullName() ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $this->user->email ?></h6>
            </div>
            <div class="col-sm-auto">
                <img class="foto-perfil"src="<?php echo $this->user->getFoto() ?>" />
            </div>
        </div>
        <h3>Operaciones</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Portada</th>
                <th scope="col">Titulo</th>
                <th scope="col">Autor</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->operaciones->content as $operacion){?>
                <tr>
                    <td class="align-middle"><img height="50" src="<?php echo $operacion->getPortada() ?>"></td>
                    <td class="align-middle"><a href="<?php echo $this->getUrl('/libros/'.$operacion->libros_id) ?>" class="text-info"><?php echo $operacion->libroTitulo ?></a></td>
                    <td class="align-middle"><a href="<?php echo $this->getUrl('/autores/'.$operacion->autorId) ?>" class="text-info"><?php echo $operacion->getAutorFullName() ?></a></td>
                    <td class="align-middle"><?php echo $operacion->ultimo_estado ?></td>
                    <td class="align-middle"><?php echo $operacion->fecha_ultima_modificacion ?></td>
                </tr>
            <?php } ?>
            <tr class="table-light">
                <td colspan="9" class="text-right text-secondary">
                    <?php echo $this->operaciones->count ?> resultado(s)
                </td>
            </tr>
            </tbody>
        </table>

        <?php $this->render('paginator'); ?>
    </div>
</div>