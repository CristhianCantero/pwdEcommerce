<?php
// include_once "../estructura/header.php";
include_once "../../configuracion.php";

$datos = data_submitted();
$abmUsuario = new AbmUsuario();
?>

<div class="container mt-3">
    <?php
    $exito = false;
    $busquedaUsuario = ["usnombre" => $datos['usnombre']];
    $busquedaCorreo = ["usmail" => $datos['usmail']];
    $existeUsuario = $abmUsuario->buscar($busquedaUsuario);
    $existeCorreo = $abmUsuario->buscar($busquedaCorreo);
    if (($existeUsuario == null && $existeCorreo == null)) {
        $exito = $abmUsuario->alta($datos);
    }
    if ($exito) {
        $usuarioNuevo = $abmUsuario->buscar($busquedaUsuario);
        $idUsuario = $usuarioNuevo[0]->getIdusuario();

        $arrayRolUsuario = ["idrol" => 4, "idusuario" => $idUsuario];

        $abmUsuarioRol = new AbmUsuarioRol();
        $exitoUsuarioRol = $abmUsuarioRol->alta($arrayRolUsuario);
        if ($exitoUsuarioRol) {
            $message = 'Se cargo correctamente el usuario y el rol';
            header("Location: ../home/index.php?Message=" . urlencode($message));
        }
    } else {
        $message = 'Hubo un error al registrar el usuario';
        header("Location: ../login/registrar.php?Message=" . urlencode($message));
    }
    ?>
</div>