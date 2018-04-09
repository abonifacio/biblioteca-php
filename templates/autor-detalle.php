<h3>Libros de
    <?php echo $this->autor->getFullName() ?>
</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Portada</th>
        <th scope="col">Titulo</th>
        <th scope="col">Ejemplares</th>
        <th scope="col">Disponibles</th>
        <th scope="col">Prestados</th>
        <th scope="col">Reservados</th>
        <th class="pl-4" scope="col">Acción</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->libros->content as $libro){?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $libro->id ?></th>
            <td class="align-middle"><img height="50" src="<?php echo $libro->getPortada() ?>" /></td>
            <td class="align-middle"><a href="<?php echo $this->getUrl('/libros/'.$libro->id) ?>" class="text-info"><?php echo $libro->titulo ?></a></td>
            <td class="align-middle"><?php echo $libro->cantidad ?></td>
            <td class="align-middle"><?php echo $libro->getDisponibles() ?></td>
            <td class="align-middle"><?php echo $libro->prestados ?></td>
            <td class="align-middle"><?php echo $libro->reservados ?></td>
            <td class="align-middle"><button type="button" class="btn btn-success">Reservar</button></td>
        </tr>
    <?php } ?>
    <tr class="table-light">
        <td colspan="9" class="text-right text-primary">
            <?php echo $this->libros->count ?> resultado(s)
        </td>
    </tr>
    </tbody>
</table>
<?php $this->render('paginator'); ?>