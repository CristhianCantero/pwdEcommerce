<?php
include_once "../../configuracion.php";

$sesion = new Session();
if (!$sesion->activa()) {
    $message = "No ha iniciado sesion";
    header('Location: ../login/login.php?Message=' . urlencode($message));
}

$datos = data_submitted();
$abmComprasIniciadas = new AbmCompraEstado();

$respuestaFinCompra = $abmComprasIniciadas->finCompra($datos);

if ($respuestaFinCompra) {
    $message = "Compra finalizada exitosamente";
    header('Location: ../managerDeposito/administrarCompras.php?Message=' . urlencode($message));
} else {
    $message = "No se pudo finalizar la compra";
    header('Location: ../managerDeposito/administrarCompras.php?Message=' . urlencode($message));
}