<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

$modificado = $abmUsuario->modificacion($datos);

if ($modificado) {
    $message = "Modificacion exitosa";
    header('Location: ../admin/administrarUsuarios.php?Message=' . urlencode($message));
} else {
    $message = "Modificacion erronea";
    header('Location: ../admin/administrarUsuarios.php?Message=' . urlencode($message));
}
