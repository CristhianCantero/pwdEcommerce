<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$exito = false;
// Datos de sesion
$sesion = new Session();
$user = $sesion->getUsuario();
$idUser = $user->getIdUsuario();

$abmCompraItem = new AbmCompraItem();

$datos['iduser'] = $idUser;
$exito = $abmCompraItem->alta($datos);

if ($exito) {
    $message = 'Agregado correctamente al carrito';
    header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
    exit;
} else {
    $message = 'Hubo un error al agregar el articulo';
    header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
    exit;
}
