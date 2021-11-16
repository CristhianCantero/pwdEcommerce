<?php
$titulo = 'Deshabilitación del usuario';
include_once "../../configuracion.php";

$datos = data_submitted();

$sesion = new Session();
if (!$sesion->activa()) {
    $message = "No ha iniciado sesion";
    header('Location: ../login/login.php?Message=' . urlencode($message));
}

$abmUsuario = new AbmUsuario();
$arrayBusqueda = ["idusuario" => $datos['idusuario']];

?>

<div class="container mt-5">

    <?php
    
    $idUsuarioSesion = $sesion->getIdUsuario();
    if (isset($datos)) {
        if ($datos['idusuario'] == $idUsuarioSesion) {
            $message = "No se puede deshabilitar a si mismo";
            header('Location: ../admin/administrarUsuarios.php?Message=' . urlencode($message));
            exit;
        }
        $respuestaDeshabilitado = $abmUsuario->deshabilitarUsuario($arrayBusqueda);
        if ($respuestaDeshabilitado) {
            $message = "Deshabilitacion exitosa";
            header('Location: ../admin/administrarUsuarios.php?Message=' . urlencode($message));
        } else {
            $message = "Deshabilitacion erronea";
            header('Location: ../admin/administrarUsuarios.php?Message=' . urlencode($message));
        }
    }
    ?>

</div>

<?php

include_once '../estructura/footer.php';

?>