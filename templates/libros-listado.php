<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Portada</th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Ejemplares</th>
            <th scope="col">Disponibles</th>
            <th scope="col">Prestados</th>
            <th scope="col">Reservados</th>
            <?php if($this->isLector()) { ?>
            <th class="pl-4" scope="col">Acción</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($this->libros->content as $libro){?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $libro->id ?></th>
            <td class="align-middle"><img height="50" src="<?php echo $libro->getPortada() ?>"></td>
            <td class="align-middle"><a href="<?php echo $this->getUrl('/libros/'.$libro->id) ?>" class="text-info"><?php echo $libro->titulo ?></a></td>
            <td class="align-middle"><a href="<?php echo $this->getUrl('/autores/'.$libro->autores_id) ?>" class="text-info"><?php echo $libro->autorNombre." ".$libro->autorApellido ?></a></td>
            <td class="align-middle"><?php echo $libro->cantidad ?></td>
            <td class="align-middle"><?php echo $libro->getDisponibles() ?></td>
            <td class="align-middle"><?php echo $libro->prestados ?></td>
            <td class="align-middle"><?php echo $libro->reservados ?></td>
            <?php if($this->isLector()) { ?>
            <td class="align-middle">
                <form action="<?php echo $this->getUrl('/reservar') ?>" method="POST">
                    <input type="hidden" name="libro_id" value="<?php echo $libro->id ?>" />
                    <input type="hidden" name="current_url" value="<?php echo $this->getUrl() ?>" />
                    <button type="submit" class="btn btn-success" <?php echo ($libro->getDisponibles()<1 || $libro->currentUserHasIt) ? 'disabled="true"' : '' ?>>Reservar</button>
                </form>
            </td>
            <?php } ?>
        </tr>
    <?php } ?>
        <tr class="table-light">
            <td colspan="9" class="text-right text-secondary">
                <?php echo $this->libros->count ?> resultado(s)
            </td>
        </tr>
    </tbody>
</table>

<?php $this->render('paginator'); ?>