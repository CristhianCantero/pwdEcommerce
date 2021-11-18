<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmItemCarrito = new AbmCompraItem();

?>

<div class="container mt-3">
    <?php
    $exito = $abmItemCarrito->baja($datos);
    if ($exito) {
        $message = 'Eliminacion de item de carrito exitosa';
        header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
    } else {
        $message = 'Eliminacion erronea';
        header("Location: ../cliente/carrito.php?Message=" . urlencode($message));
    }
    ?>
</div>