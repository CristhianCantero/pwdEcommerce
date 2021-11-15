<?php
include_once '../../configuracion.php';

$sesion = new Session();
$sesion->cerrarSession();
$message = "Sesión cerrada";
header('Location:../home/index.php?message=' . urlencode($message));
