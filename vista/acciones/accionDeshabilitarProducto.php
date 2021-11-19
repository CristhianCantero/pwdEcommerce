<?php
include_once '../../configuracion.php';

$titulo = 'Deshabilitación de Productos';

$datos = data_submitted();

$abmProducto = new AbmProducto();
$arrayBusqueda = ["idproducto" => $datos['idproducto']];

$respuestaDeshabilitado = $abmProducto->deshabilitarProd($arrayBusqueda);

if ($respuestaDeshabilitado) {
    $message = "Deshabilitacion exitosa";
    header('Location: ../managerDeposito/administrarProductos.php?Message=' . urlencode($message));
} else {
    $message = "Deshabilitacion erronea";
    header('Location: ../managerDeposito/administrarProductos.php?Message=' . urlencode($message));
}
