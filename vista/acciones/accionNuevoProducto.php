<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmProducto = new AbmProducto();

$datos['provecescomprado'] = 0;
$datos['files'] = $_FILES;
$exito = $abmProducto->alta($datos);

if ($exito) {
    $message = "Producto cargado correctamente";
    header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode($message));
    exit;
} else {
    $message = "Error en la carga del producto";
    header('Location: ../managerDeposito/nuevoProducto.php?message=' . urlencode($message));
    exit;
}
