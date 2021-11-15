<?php
// include_once "../estructura/header.php";
include_once "../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();

?>

<div class="container mt-3">
    <?php
    $exito = $abmProducto->baja($datos);
    if ($exito) {
        $message = 'Eliminacion exitosa';
        header("Location: ../managerDeposito/administrarProductos.php?Message=" . urlencode($message));
    } else {
        $message = 'Eliminacion erronea';
        header("Location: ../managerDeposito/administrarProductos.php?Message=" . urlencode($message));
    }
    ?>
</div>