<?php
include_once '../../configuracion.php';

$datos = data_submitted();

if (!isset($datos["verificado"])) {
    $controlIngresoCarrito = new controlIngresoCliente();
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
$arrayCarritos = $controlVerificarCarrito->verificarCarrito($idUser);
$carrito = $arrayCarritos['carritoHabilitado'];

if ($carrito == null) {
    $carrito = new Compra();
}

$abmItemsCarrito = new AbmCompraItem();
$compraItems = $abmItemsCarrito->buscar(['idcompra' => $carrito->getIdCompra()]);
$subTotalCompra = 0;
$iva = 0;
$totalFinalCompra = 0;

?>
<div class="container mt-2">
    <section>
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-light shadow wish-list mb-3">
                    <div class="card-body">
                        <?php
                        if (count($compraItems) == 0) { ?>
                            <h5 class="text-center mb-4">Estoy vacío, llename porfis <i class="far fa-sad-tear"></i></h5>
                        <?php
                        } else { ?>
                            <h5 class="mb-4">Carrito: (<?php echo count($compraItems) . " items" ?>)</h5>
                            <?php
                        }
                        $subTotalCompra = 0;
                        $iva = 0;
                        $totalFinalCompra = 0;
                        if (count($compraItems)) {

                            foreach ($compraItems as $compraItem) {
                                $producto = $compraItem->getIdProducto();
                                $id = $producto->getIdProducto();
                                $precio = $producto->getProPrecio();
                                $descuento = $producto->getProDescuento();
                                $unidades = $compraItem->getCiCantidad();
                                $subTotalProducto = ($precio * $unidades) - ((($precio * $unidades) * $descuento) / 100);
                                $subTotalCompra = $subTotalCompra + $subTotalProducto;

                            ?>
                                <div class="row mb-4">
                                    <div class="col-md-5 col-lg-3 col-xl-3">
                                        <div>
                                            ACA VA LA IMAGEN
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-9 col-xl-9">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h4><?php echo $producto->getProNombre() ?></h4>
                                                    <p class="mb-3 text-muted text-uppercase small">Modelo: <?php echo $producto->getProDetalle() ?></p>
                                                    <p class="mb-2 text-muted text-uppercase small">Descuento: <?php echo $descuento ?>%</p>
                                                </div>
                                                <div class='text-center'>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <form method='post' action='../acciones/accionRestarCantidadCompra.php'>
                                                            <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $compraItem->getIdCompraItem() ?>'>
                                                            <button class='btn btn-dark mx-1' type='submit' role='button'><i class='fas fa-minus'></i></button>
                                                        </form>
                                                        <span class="input-group-text" id="basic-addon1"><?php echo $unidades ?></span>
                                                        <form method='post' action='../acciones/accionSumarCantidadCompra.php'>
                                                            <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $compraItem->getIdCompraItem() ?>'>
                                                            <button class='btn btn-dark mx-1' type='submit' role='button'><i class='fas fa-plus'></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <form method='post' action='../acciones/accionEliminarItemCarrito.php'>
                                                    <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $compraItem->getIdCompraItem() ?>'>
                                                    <button class='btn btn-danger btn-sm' type='submit' role='button'><i class="fas fa-trash"></i></button>
                                                </form>
                                                <p class="mb-0"><span>Precio x unidad: <strong>$<?php echo $precio ?>.-</strong></span></p>
                                            </div>
                                            <?php
                                            $stockFinal = $producto->getProCantStock() - $unidades;
                                            if ($stockFinal == 0) {
                                            ?>
                                                <span class="badge rounded-pill bg-warning text-black">STOCK MINIMO</span>
                                                <?php
                                            } else {
                                                if ($stockFinal < 0) {
                                                ?>
                                                    <span class="badge rounded-pill bg-danger">SIN STOCK</span>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                        <?php
                            }
                        }
                        ?>
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>&nbsp;Haga su compra ahora, agregar items al carrito no significa que se reserven.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-light shadow mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Detalles compra:</h5>
                        <?php
                        $iva = $subTotalCompra * 0.21;
                        $totalFinalCompra = $subTotalCompra + $iva;
                        ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Subtotal
                                <span>$<?php echo round($subTotalCompra, 2); ?>.-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                IVA (21%)
                                <span>$<?php echo round($iva, 2); ?>.-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total Final</strong>
                                    <p class="mb-0 text-muted fw-light">(Incluyendo IVA)</p>
                                </div>
                                <span><strong>$<?php echo round($totalFinalCompra, 2); ?>.-</strong></span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <form method='post' action='../acciones/accionEnviarCarrito.php'>
                                <input name='idcompraitem' id='idcompraitem' type='hidden' value='<?php echo $carrito->getIdCompra(); ?>'>
                                <?php if (count($compraItems) > 0) {
                                ?>
                                    <button class='btn btn-success m-1' type='submit' role='button'>Confirmar Pedido</button>
                                <?php
                                } ?>
                            </form>
                            <a href="listadoProductos.php"><button type="button" class="btn btn-primary btn-block waves-effect waves-light">Continuar Comprando</button></a>
                            <!-- <button type="button" class="btn btn-success">Confirmar Pedido</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include_once("../estructura/footer.php");
?>