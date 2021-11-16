<?php
include_once '../../configuracion.php';

$titulo = 'Actualizar Usuario';

$controlIngresoAdmin = new controlIngresoAdmin();
$controlIngresoAdmin->verificarIngreso("actualizarUsuario");

include_once '../estructura/header.php';

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

$arrayBusqueda = ["idusuario" => $datos['idusuario']];

$listaProductos = $abmUsuario->buscar($arrayBusqueda);
$objProducto = $listaProductos[0];

?>

<div class="container mt-3">
    <h1 class="text-center">Modificación de Usuario</h1>
    <div class="col-md-4"></div>
    <div class="offset-md-4">
        <form action="../acciones/accionActualizarUsuario.php" method="post" class="col-md-6 mt-3 " id="actualizarUsuario" name="actualizarUsuario">
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre de usuario" value="<?php echo $objProducto->getUsnombre(); ?>" required>
                    <label for="usnombre">Nombre de usuario: </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="uspass" name="uspass" type="text" placeholder="Contraseña Nueva" required>
                    <label for="uspass">Contraseña Nueva: </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Correo Electronico" value="<?php echo $objProducto->getUsmail(); ?>" required>
                    <label for="usmail">Correo Electronico: </label>
                </div>
            </div>
            <input class="form-control" id="idusuario" name="idusuario" type="text" value="<?php echo $objProducto->getIdusuario(); ?>" hidden>
            <div class=" mb-3">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once '../estructura/footer.php';

?>