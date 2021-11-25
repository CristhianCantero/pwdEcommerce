<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmMenu = new AbmMenu();

$modificado = $abmMenu->modificacion($datos);

if ($modificado) {
    $message = "Menu modificado";
    header('Location: ../admin/administrarMenus.php?Message=' . urlencode($message));
    exit;
} else {
    $message = "Error al modificar menu";
    header('Location: ../admin/administrarMenus.php?Message=' . urlencode($message));
    exit;
}
