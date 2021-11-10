<?php
$titulo = 'Listado de Productos';
include_once '../estructura/header.php';

$abmProductos = new AbmProducto();
$listaProductos = $abmProductos->buscar(null);

?>
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Listado de Productos</h4>
        </div>
    </div>
</header>
<div class="container mt-2">
    <section class="py-2">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                if (count($listaProductos) > 0) {
                    foreach ($listaProductos as $producto) {
                        $deshabilitado = $producto->getProDeshabilitado();
                        if ($deshabilitado == "0000-00-00 00:00:00") { ?>
                            <div class='col mb-5'>
                                <div class='card h-100'>
                                    <?php
                                    if ($producto->getProDescuento() > 0) { ?>
                                        <div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Oferta<span>&nbsp;<?php echo $producto->getProDescuento() ?>%</span></div>
                                    <?php
                                    } ?>

                                    <img class='card-img-top' src='https://periodismodelmotor.com/wp-content/uploads/2020/09/bmw-m4-2021--450x300.jpg' alt='Imagen de una autoparte' />

                                    <div class='card-body p-4'>
                                        <div class='text-center'>
                                            <h5 class='fw-bolder'><?php echo $producto->getProNombre() ?></h5>
                                            <p><?php echo $producto->getProDetalle() ?></p>

                                            <?php
                                            if ($producto->getProDescuento() > 0) {
                                                $precio = $producto->getProPrecio();
                                                $precioDescuento = $precio - (($precio * $producto->getProDescuento()) / 100); ?>
                                                <span class='text-muted text-decoration-line-through'>$<?php echo $precio ?></span>&nbsp;$<?php echo $precioDescuento ?>
                                            <?php } else { ?>
                                                <span>$<?php echo $producto->getProPrecio() ?></span>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>

                                    <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                        <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='#'>Agregar al carrito</a></div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                } ?>
            </div>
        </div>
    </section>
</div>

<?php

include_once '../estructura/footer.php';

?>