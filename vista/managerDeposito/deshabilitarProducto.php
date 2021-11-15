<?php
$titulo = 'Deshabilitación del producto';
include_once "../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();

$arrayBusqueda = ["idproducto" => $datos['id']];

?>

<div class="container mt-5">

    <?php
    $respuestaDeshabilitado = $abmProducto->deshabilitarProd($arrayBusqueda);
    if ($respuestaDeshabilitado) {
        $message = "Deshabilitacion exitosa";
        header('Location: ../managerDeposito/administrarProductos.php?Message=' . urlencode($message));
    } else {
        $message = "Deshabilitacion erronea";
        header('Location: ../managerDeposito/administrarProductos.php?Message=' . urlencode($message));
    }
    ?>

</div>

<?php

include_once '../estructura/footer.php';

?>