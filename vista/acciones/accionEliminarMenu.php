<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmMenu = new AbmMenu();

?>

<div class="container mt-3">
    <?php
    $exito = $abmMenu->baja($datos);
    if ($exito) {
        $message = 'Eliminacion exitosa';
        header("Location: ../admin/administrarMenus.php?Message=" . urlencode($message));
    } else {
        $message = 'Eliminacion erronea';
        header("Location: ../admin/administrarMenus.php?Message=" . urlencode($message));
    }
    ?>
</div>