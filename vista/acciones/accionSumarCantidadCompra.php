<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmCompraItem = new AbmCompraItem();

$sumado = $abmCompraItem->sumarItem($datos);

if ($sumado) {
    $message = "Item modificado";
    header('Location: ../cliente/carrito.php?Message=' . urlencode($message));
} else {
    $message = "Error al modificar el item";
    header('Location: ../cliente/carrito.php?Message=' . urlencode($message));
}
