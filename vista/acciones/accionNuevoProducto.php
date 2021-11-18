<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();

$exito = $abmProducto->alta($datos);

if ($exito) {
    $message = 'Se cargo correctamente el articulo';
    header("Location: ../managerDeposito/administrarProductos.php?Message=" . urlencode($message));
} else {
    $message = 'Hubo un error al cargar el articulo';
    header("Location: ../managerDeposito/administrarProductos.php?Message=" . urlencode($message));
}
