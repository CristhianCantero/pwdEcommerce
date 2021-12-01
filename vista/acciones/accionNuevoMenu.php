<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmMenu = new AbmMenu();
$exito = $abmMenu->alta($datos);

if ($exito) {
    $message = "Menu cargado correctamente";
    header('Location: ../admin/administrarMenus.php?messageOk=' . urlencode($message)); 
    exit;
} else {
    $message = "Error carga menú";
    header('Location: ../admin/nuevoMenu.php?messageErr=' . urlencode($message));
    exit;
}
