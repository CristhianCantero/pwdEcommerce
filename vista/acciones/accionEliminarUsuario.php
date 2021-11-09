<?php
// include_once "../estructura/header.php";
include_once "../../configuracion.php";

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

?>

<div class="container mt-3">
    <?php
    $exito = $abmUsuario->baja($datos);
    if ($exito) {
        $message = 'Eliminacion exitosa';
        header("Location: ../pages/administrarUsuarios.php?Message=" . urlencode($message));
    } else {
        $message = 'Eliminacion erronea';
        header("Location: ../pages/administrarUsuarios.php?Message=" . urlencode($message));
    }
    ?>
</div>