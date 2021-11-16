<?php
include_once '../../configuracion.php';

$titulo = 'Deshabilitacion de Productos';

$datos = data_submitted();

if(!isset($datos["verificado"])){
    $controlIngresoManagerDeposito = new controlIngresoManagerDeposito();
    $controlIngresoManagerDeposito->verificarIngreso("deshabilitarProducto");
}

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