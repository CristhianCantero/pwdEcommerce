<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$sesion = new Session();

$name = $datos['usnombre'];
$pass = $datos['uspass'];
$passHasheado = md5($pass);
$sesion->iniciar($name, $passHasheado);
list($valido, $error) = $sesion->validar();

if ($valido) {
    header("Location:../home/index.php");
} else {
    $sesion->cerrarSession();
    header("Location:login.php?error=" . urlencode($error));
}
