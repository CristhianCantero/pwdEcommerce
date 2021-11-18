<?php

$titulo = 'Productos Populares';

include_once '../estructura/header.php';
$sesion = new Session();
$abmProductos = new AbmProducto();
$arrayConsulta = ["provecescomprado" => 10];
$listaProductos = $abmProductos->buscar($arrayConsulta);
$cantProductos = count($listaProductos);
for ($i = 1; $i < $cantProductos; $i++) {
    $aux = $listaProductos[$i];
    $j = $i;
    while ($j > 0 && $aux->getProVecesComprado() > $listaProductos[$j - 1]->getProVecesComprado()) {
        $listaProductos[$j] = $listaProductos[$j - 1];
        $j = $j - 1;
    }
    $listaProductos[$j] = $aux;
}

?>
<!-- Header-->
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Productos Populares</h4>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            if (count($listaProductos) > 0) {
                for ($cont_prod = 0; $cont_prod <= 7; $cont_prod++) {
                    if ($cont_prod < count($listaProductos)) {
                        $producto = $listaProductos[$cont_prod]; ?>
                        <div class='col mb-5'>
                            <div class='card h-100'>

                                <?php
                                if ($producto->getProDescuento() > 0) { ?>
                                    <div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Oferta<span>&nbsp;<?php echo $producto->getProDescuento() ?>%</span></div>
                                <?php
                                } ?>

                                <img class='card-img-top' src='https://blog.ida.cl/wp-content/uploads/sites/5/2020/04/tamano-redes-blog-655x470.png' alt='...' />

                                <div class='card-body p-4'>
                                    <div class='text-center'>
                                        <h5 class='fw-bolder'><?php echo $producto->getProNombre() ?></h5>
                                        <p><?php echo $producto->getProDetalle() ?></p>

                                        <?php
                                        if ($producto->getProDescuento() > 0) {
                                            $precio = $producto->getProPrecio();
                                            $precioDescuento = $precio - (($precio * $producto->getProDescuento()) / 100); ?>
                                            <span class='text-muted text-decoration-line-through'>$<?php echo $precio ?>&nbsp;</span> $<?php echo $precioDescuento ?>
                                        <?php
                                        } else { ?>
                                            <span>$<?php echo $producto->getProPrecio() ?></span>
                                        <?php
                                        } ?>

                                    </div>
                                </div>

                                <?php
                                if ($sesion->activa()) {
                                    foreach ($sesion->getUsRoles() as $rol) {
                                        if ($rol == 3) {
                                ?>
                                            <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                                <div class='text-center'>
                                                    <form method='post' action='../acciones/accionAgregarItemCarrito.php'>
                                                        <td class='text-center'>
                                                            <input name='codigoProducto' id='codigoProducto' type='hidden' value='<?php echo $producto->getIdProducto() ?>'>
                                                            <button class='btn btn-outline-dark mt-auto' type='submit' role='button'>Agregar al carrito</button>
                                                        </td>
                                                    </form>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                        <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='../login/login.php'>Agregar al carrito</a></div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
            <?php
                    }
                }
            } ?>
        </div>
    </div>
</section>

<?php

include_once '../estructura/footer.php';

?>