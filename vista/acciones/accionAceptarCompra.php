<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmComprasIniciadas = new AbmCompraEstado();

$respuestaAceptarCompra = $abmComprasIniciadas->aceptarCompra($datos);

if ($respuestaAceptarCompra) {
    $message = "Compra aceptada exitosamente";
    header('Location: ../managerDeposito/administrarCompras.php?Message=' . urlencode($message));
    exit;
} else {
    $message = "No se pudo aceptar la compra";
    header('Location: ../managerDeposito/administrarCompras.php?Message=' . urlencode($message));
    exit;
}
