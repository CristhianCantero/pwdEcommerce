<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmCompraItem = new AbmCompraItem();

$restado = $abmCompraItem->restarItem($datos);

if ($restado) {
    $message = "Item modificado";
    header('Location: ../cliente/carrito.php?Message=' . urlencode($message));
    exit;
} else {
    $message = "Error al modificar el item";
    header('Location: ../cliente/carrito.php?Message=' . urlencode($message));
    exit;
}
