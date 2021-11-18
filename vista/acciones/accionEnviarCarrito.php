<?php
// include_once "../estructura/header.php";
include_once "../../configuracion.php";

$datos = data_submitted();
$abmCompraEstado = new AbmCompraEstado();

$arrayCarrito = ['idcompra' => $datos['idcompraitem'], 'idcompraestadotipo' => 1];
$exito = $abmCompraEstado->alta($arrayCarrito);
if ($exito) {
    $message = 'Se envio el carrito correctamente';
    header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
} else {
    $message = 'Hubo un error al enviar su carrito';
    header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
}
