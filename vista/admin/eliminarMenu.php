<?php
// include_once '../../configuracion.php';

$titulo = 'Confirmación de Eliminación';

// $controlIngresoAdmin = new controlIngresoAdmin();
// $controlIngresoAdmin->verificarIngreso("eliminarMenu");

include_once '../estructura/header.php';

$datos = data_submitted();
$abmMenu = new AbmMenu();
$objMenu = $abmMenu->buscar(["idmenu" => $datos['idmenu']]);
$id = $datos['idmenu'];

?>

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header">
            Eliminación del menú
        </div>
        <div class="card-body">
            <h5 class="card-title">¿Desea eliminar de forma permanente al menú?</h5>
            <p class="card-text">Nombre del menú: <?php echo $objMenu[0]->getMeNombre() ?></p>
            <p class="card-text">Descripción: <?php echo $objMenu[0]->getMeDescripcion() ?></p>

            <form action='../acciones/accionEliminarMenu.php' method='post'>
                <input name='idmenu' id='idmenu' type='hidden' value='<?php echo $id ?>'>
                <button class='btn btn-danger btn-sm' type='submit' value='<?php echo $id ?>' name='idmenu' id='idmenu' role='button' formaction='../acciones/accionEliminarMenu.php'>Eliminar</button>
            </form>

        </div>
    </div>
</div>

<?php

include_once '../estructura/footer.php';

?>