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
$exito = true;

if ($respuestaFinCompra) {
    $abmCompraItem = new AbmCompraItem();
    $abmProducto = new AbmProducto();
    $listadoItems = $abmCompraItem->buscar(['idcompra'=>$datos['idcompraestado']]);

    foreach ($listadoItems as $item) {
        $objProducto = new Producto();
        $producto = $objProducto->listar("idproducto ='" . $item->getIdProducto()->getIdProducto() . "'");
        $stockActual = $producto[0]->getProCantStock();
        $stockActualizado = $stockActual + $item->getCiCantidad();
        $producto[0]->setProStock($stockActualizado);
        $vecesCompradoActual = $producto[0]->getProVecesComprado();
        $vecesCompradoActualizado = $vecesCompradoActual - $item->getCiCantidad();
        $producto[0]->setProVecesComprado($vecesCompradoActualizado);
        $respModificar = $producto[0]->modificar();
        if(!$respModificar){
            $exito = false;
        }
    }
}

if ($exito) {
    $message = "Compra finalizada exitosamente";
    header('Location: ../home/index.php?Message=' . urlencode($message));
} else {
    $message = "No se pudo finalizar la compra";
    header('Location: ../home/index.php?Message=' . urlencode($message));
}
