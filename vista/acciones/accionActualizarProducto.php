<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmProducto = new AbmProducto();
$datos['files'] = $_FILES;
$exito = $abmProducto->modificacion($datos);

if ($exito) {
    header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode("Producto modificado"));
    exit;
} else {
    header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode("Error en la modificacion"));
    exit;
}

