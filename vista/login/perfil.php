<?php
include_once "../../configuracion.php";

$sesion = new Session();

if (!$sesion->activa()) {
    header('Location: ../login.php');
    exit;
}

$titulo = 'Actualizar Usuario';

$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$idUsuario = $sesion->getIdUsuario();

$arrayBusqueda = ["idusuario" => $idUsuario];

$listaUsuarios = $abmUsuario->buscar($arrayBusqueda);
$objUsuario = $listaUsuarios[0];

if (isset($listaUsuarios)) {
    $idUsuario = $listaUsuarios[0]->getIdUsuario();
    include_once '../estructura/header.php';
}

include_once "../estructura/header.php";

?>
<div class="container mt-3">
    <h1 class="text-center">Modificación de Usuario</h1>
    <div class="col-md-4"></div>
    <div class="offset-md-4">
        <form action="../acciones/accionActualizarUsuario.php" method="post" class="col-md-6 mt-3 " id="actualizarUsuario" name="actualizarUsuario">
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre de usuario" value="<?php echo $objUsuario->getUsnombre(); ?>">
                    <label for="usnombre">Nombre de usuario: </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="uspass" name="uspass" type="text" placeholder="Contraseña Nueva">
                    <label for="uspass">Contraseña Nueva: </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Correo Electronico" value="<?php echo $objUsuario->getUsmail(); ?>">
                    <label for="usmail">Correo Electronico: </label>
                </div>
            </div>

            <input class="form-control" id="idusuario" name="idusuario" type="text" value="<?php echo $objUsuario->getIdUsuario(); ?>" hidden>
            <div class=" mb-3">
                <div class="d-grid">
                    <button class="btn btn-primary mt-3" type="submit">Modificar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include_once("../estructura/footer.php");
?>