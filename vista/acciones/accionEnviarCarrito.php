<?php
include_once "../../configuracion.php";

$datos = data_submitted();
// $exito = false;
$abmCompraEstado = new AbmCompraEstado();
$abmCompraItem = new AbmCompraItem();
$abmProducto = new AbmProducto();

$listadoItems = $abmCompraItem->buscar(['idcompra'=>$datos['idcompraitem']]);
$stockDisponible = true;
foreach ($listadoItems as $item) {
    $respStock = $abmProducto->chequearStock($item);
    if(!$respStock){
        $stockDisponible = false;
    }
}
$exito = true;
if($stockDisponible){
    $arrayCarrito = ['idcompra' => $datos['idcompraitem'], 'idcompraestadotipo' => 1];
    $exitoAltaCarrito = $abmCompraEstado->alta($arrayCarrito);
    if($exitoAltaCarrito){
        foreach ($listadoItems as $item) {
            $objProducto = new Producto();
            $producto = $objProducto->listar("idproducto ='" . $item->getIdProducto()->getIdProducto() . "'");
            $stockActual = $producto[0]->getProCantStock();
            $stockActualizado = $stockActual - $item->getCiCantidad();
            $producto[0]->setProStock($stockActualizado);
            $vecesCompradoActual = $producto[0]->getProVecesComprado();
            $vecesCompradoActualizado = $vecesCompradoActual + $item->getCiCantidad();
            $producto[0]->setProVecesComprado($vecesCompradoActualizado);
            $respModificar = $producto[0]->modificar();
            if(!$respModificar){
                $exito = false;
            }
        }
    }
}

if ($exito) {
    $message = 'Se envio el carrito correctamente';
    header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
} else {
    $message = 'Hubo un error al enviar su carrito';
    header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
}
