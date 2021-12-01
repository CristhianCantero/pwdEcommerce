<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$abmUsuarioRol = new AbmUsuarioRol();

$exitoModificacionUsuario = $abmUsuario->modificacion($datos);
$exitoModificacionUsuarioRol = $abmUsuarioRol->modificacion($datos);

if ($exitoModificacionUsuario || $exitoModificacionUsuarioRol) {
    header('Location: ../admin/administrarUsuarios.php?messageOk=' . urlencode("Usuario modificado correctamente"));
    exit;
} else {
    header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode("Error en la modificación"));
    exit;
}
