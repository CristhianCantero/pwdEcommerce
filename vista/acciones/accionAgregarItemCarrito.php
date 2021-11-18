<?php
// include_once "../estructura/header.php";
include_once "../../configuracion.php";

$datos = data_submitted();
$abmCompraItem = new AbmCompraItem();
$sesion = new Session();
$user = $sesion->getUsuario();
$idUser = $user->getIdUsuario();

$controlVerificarCarrito = new controlVerificarCarritoCliente();
$arrayCarritos = $controlVerificarCarrito->verificarCarrito($idUser);
$carrito = $arrayCarritos['carritoHabilitado'];

if ($carrito == null) {
    $abmCarrito = new AbmCompra();
    $array = ['idusuario' => $idUser];
    $altaCarrito = $abmCarrito->alta($array);
    if (!$altaCarrito) {
        $message = 'Hubo un error al agregar el articulo';
        header("Location: ../cliente/listadoProductos.php?Message=" . urlencode($message));
    } else {
        $arrayCarritos = $controlVerificarCarrito->verificarCarrito($idUser);
        $carrito = $arrayCarritos['carritoHabilitado'];
    }
}
$idCarrito = $carrito->getIdCompra();
$arrayCargaItem = ['idproducto' => $datos['codigoProducto'], 'idcompra' => $idCarrito];

?>

<div class="container mt-3">
    <?php
    $cargado = false;
    $exito = false;
    $arrayItemsCarrito = $abmCompraItem->buscar(['idcompra' => $carrito->getIdCompra()]);
    foreach ($arrayItemsCarrito as $itemCarrito) {
        if ($itemCarrito->getIdProducto()->getIdProducto() == $datos['codigoProducto']) {
            $cargado = true;
        }
    }
    if (!$cargado) {
        $exito = $abmCompraItem->alta($arrayCargaItem);
    }
    if ($exito) {
        $message = 'Agregado correctamente al carrito';
        header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
    } else {
        $message = 'Hubo un error al agregar el articulo';
        header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
    }
    ?>
</div>