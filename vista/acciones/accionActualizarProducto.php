<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();

// $arrayBusqueda = ["idproducto"=>$datos['idproducto']];
// $listaProducto = $abmProducto->buscar($arrayBusqueda);
// $objProducto = $listaProducto[0];
$modificado = $abmProducto->modificacion($datos);

if ($modificado) {
    $message = "Modificacion exitosa";
    header('Location: ../pages/administrarProductos.php?Message=' . urlencode($message));
} else {
    $message = "Modificacion erronea";
    header('Location: ../pages/administrarProductos.php?Message=' . urlencode($message));
}
