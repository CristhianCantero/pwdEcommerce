<?php

$titulo = 'Productos Populares';

include_once '../estructura/header.php';

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
            <h4>Listado de Productos</h4>
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
                        $producto = $listaProductos[$cont_prod];
                        echo "<div class='col mb-5'>";
                        echo "<div class='card h-100'>";

                        if ($producto->getProDescuento() > 0) {
                            echo "<div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>Oferta<span>&nbsp;{$producto->getProDescuento()}%</span></div>";
                        }

                        echo "<img class='card-img-top' src='https://blog.ida.cl/wp-content/uploads/sites/5/2020/04/tamano-redes-blog-655x470.png' alt='...' />";
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
                        // echo "<p>{$producto->getProVecesComprado()}</p>";
                        echo "<p>Veces comprado: {$producto->getProVecesComprado()}</p>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                        echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='#'>Agregar al carrito</a></div>";
                        echo "</div>";

                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
    </div>
</section>

<?php

include_once '../estructura/footer.php';

?>