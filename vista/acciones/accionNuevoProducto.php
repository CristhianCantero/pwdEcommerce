<?php
// include_once "../estructura/header.php";
include_once "../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();
?>

<div class="container mt-3">
    <?php
    // print_r($datos);
    $exito = $abmProducto->alta($datos);
    if ($exito) {
        $message = 'Se cargo correctamente el articulo';
        header("Location: ../pages/administrarProductos.php?Message=" . urlencode($message));
    } else {
        $message = 'Hubo un error al cargar el articulo';
        header("Location: ../pages/administrarProductos.php?Message=" . urlencode($message));
    }
    ?>
</div>