<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();

$modificado = $abmProducto->modificacion($datos);

if ($modificado) {
    $message = "Modificacion exitosa";
    header('Location: ../managerDeposito/administrarProductos.php?Message=' . urlencode($message));
} else {
    $message = "Modificacion erronea";
    header('Location: ../managerDeposito/administrarProductos.php?Message=' . urlencode($message));
}
