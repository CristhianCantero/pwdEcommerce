<?php

$titulo = 'MercadoPrivado';

include_once '../estructura/header.php';

$abmProductos = new AbmProducto();
$listaProductos = $abmProductos->buscar(null);
shuffle($listaProductos);

?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Lo bueno, nos lo guardamos</h1>
            <p class="lead fw-normal text-white-50 mb-0">
            <div class="bi bi-heart-fill"></div>
            </p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            if (count($listaProductos) > 0) {
                for($cont_prod=0; $cont_prod<=7; $cont_prod++){
                    $producto = $listaProductos[$cont_prod];
                    echo "<div class='col mb-5'>";
                    echo "<div class='card h-100'>";

                    if ($producto->getProDescuento() > 0) {
                        echo "<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Oferta<span>&nbsp;{$producto->getProDescuento()}%</span></div>";
                    }

                    echo "<img class='card-img-top' src='https://dummyimage.com/450x300/dee2e6/6c757d.jpg' alt='...' />";
                    echo "<div class='card-body p-4'>";
                    echo "<div class='text-center'>";
                    echo "<h5 class='fw-bolder'>{$producto->getProNombre()}</h5>";
                    echo "<p>{$producto->getProDetalle()}</p>";

                    if ($producto->getProDescuento() > 0) {
                        $precio = $producto->getProPrecio();
                        $precioDescuento = $precio - (($precio * $producto->getProDescuento()) / 100);
                        echo "<span class='text-muted text-decoration-line-through'>$" . $precio . "</span> $" . $precioDescuento;
                    } else {
                        echo "$" . $producto->getProPrecio();
                    }
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                    echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='#'>Agregar al carrito</a></div>";
                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</section>

<?php

include_once '../estructura/footer.php';

?>