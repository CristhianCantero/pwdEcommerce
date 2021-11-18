<?php

include_once '../../configuracion.php';

$datos = data_submitted();

if (!isset($datos["verificado"])) {
    $controlIngresoCarrito = new controlIngresoCarrito();
    $controlIngresoCarrito->verificarIngreso("carrito");
}

$sesion = new Session();

if ($sesion->activa()) {
    $user = $sesion->getUsuario();
    $idUser = $user->getIdUsuario();
}

$titulo = 'Carrito de compra';

include_once "../estructura/header.php";

$controlVerificarCarrito = new controlVerificarCarritoCliente();
$carrito = $controlVerificarCarrito->verificarCarrito($idUser);

if ($carrito == null) {
    $carrito = new Compra();
}

?>
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Carrito de Compra</h4>
        </div>
    </div>
</header>
<div class="container mt-2">
    <section class="py-2">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <table class='table align-middle'>
                    <thead class='table-dark'>
                        <tr class='align-middle'>
                            <th scope='col' class='text-center'>Codigo Producto</th>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Descripcion</th>
                            <th scope='col' class='text-center'>Precio x Unidad</th>
                            <th scope='col' class='text-center'>Cantidad</th>
                            <th scope='col' class='text-center'>Descuento</th>
                            <th scope='col' class='text-center'>Subtotal</th>
                            <th scope='col' class='text-center'>Quitar Producto</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $abmItemsCarrito = new AbmCompraItem();
                        $compraItems = $abmItemsCarrito->buscar(['idcompra' => $carrito->getIdCompra()]);
                        // print_r($compraItems);
                        if (count($compraItems) > 0) {
                            foreach ($compraItems as $compraItem) {
                                $producto = $compraItem->getIdProducto();
                                $id = $producto->getIdProducto();
                                $precio = $producto->getProPrecio();
                                $descuento = $producto->getProDescuento();
                                $unidades = $compraItem->getCiCantidad();
                                $subtotal = ($precio*$unidades) - ((($precio*$unidades)*$descuento)/100);
                        ?>
                                <tr>
                                    <td class='text-center'><?php echo $id ?></td>
                                    <td class='text-center'><?php echo $producto->getProNombre() ?></td>
                                    <td class='text-center'><?php echo $producto->getProDetalle() ?></td>
                                    
                                    <td class='text-center'><span>$<?php echo $precio ?></span></td>
                                    <td class='text-center'>
                                        <div class="btn-group text-center" role="group" aria-label="Basic example">
                                            <form method='post' action='../acciones/accionRestarCantidadCompra.php'>
                                                <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $compraItem->getIdCompraItem() ?>'>
                                                <button class='btn btn-dark mx-1' type='submit' role='button'><i class='fas fa-minus'></i></button>
                                            </form>
                                            <span class="input-group-text" id="basic-addon3"><?php echo $unidades ?></span>
                                            <form method='post' action='../acciones/accionSumarCantidadCompra.php'>
                                                <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $compraItem->getIdCompraItem() ?>'>
                                                <button class='btn btn-dark mx-1' type='submit' role='button'><i class='fas fa-plus'></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class='text-center'><span><?php echo $descuento; ?>%</span></td>
                                    <td class='text-center'><span>$<?php echo $subtotal; ?></span></td>
                                    <form method='post' action='../acciones/accionEliminarItemCarrito.php'>
                                        <td class='text-center'>
                                            <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $compraItem->getIdCompraItem() ?>'>
                                            <button class='btn btn-danger btn-sm' type='submit' role='button'><i class='fas fa-times-circle'></i></button>
                                        </td>
                                    </form>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (count($compraItems) == 0) {
                ?>
                    <div class="">
                        <h2>Su carrito se encuentra vacio.</h2>
                        <a href="listadoProductos.php"><button class='btn btn-primary' type='submit' role='button'>Volver al listado</button></a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</div>

<?php
include_once("../estructura/footer.php");
?>