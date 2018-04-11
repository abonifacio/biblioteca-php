<div class="card">

    <div class="card-body">
        <h3>Operaciones</h3>
        <form action="<?php echo $this->getUrl('/admin') ?>" method="GET">
            <div class="row align-items-end">
                <div class="col">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $this->getQueryParam('titulo') ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" name="autor" class="form-control" id="autor" value="<?php echo $this->getQueryParam('autor') ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="lector">Lector</label>
                        <input type="text" name="lector" class="form-control" id="lector" value="<?php echo $this->getQueryParam('lector') ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="desde">Desde</label>
                        <input type="date" name="desde" class="form-control" id="desde" value="<?php echo $this->getQueryParam('desde') ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="hasta">Hasta</label>
                        <input type="date" name="hasta" class="form-control" id="hasta" value="<?php echo $this->getQueryParam('hasta') ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Autor</th>
                <th scope="col">Lector</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acción</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->operaciones->content as $operacion){?>
                <tr>
                    <td class="align-middle"><a href="<?php echo $this->getUrl('/libros/'.$operacion->libros_id) ?>" class="text-info"><?php echo $operacion->libroTitulo ?></a></td>
                    <td class="align-middle"><a href="<?php echo $this->getUrl('/autores/'.$operacion->autorId) ?>" class="text-info"><?php echo $operacion->getAutorFullName() ?></a></td>
                    <td class="align-middle"><?php echo $operacion->getLectorFullName() ?></td>
                    <td class="align-middle"><?php echo $operacion->ultimo_estado ?></td>
                    <td class="align-middle"><?php echo $operacion->fecha_ultima_modificacion ?></td>
                    <td class="align-middle">
                        <?php if($this->showAccion($operacion)) { ?>
                        <form action="<?php echo $this->getFormAction($operacion) ?>" method="POST">
                            <input type="hidden" name="operacion_id" value="<?php echo $operacion->id ?>" />
                            <input type="hidden" name="current_url" value="<?php echo $this->getUrl() ?>" />
                            <button type="submit" class="btn btn-success"><?php echo $this->getButtonText($operacion) ?></button>
                        </form>
                        <?php } ?>
                    </td>
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