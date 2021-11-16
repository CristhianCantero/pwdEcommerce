<?php
include_once '../../configuracion.php';

$controlIngresoAdmin = new controlIngresoAdmin();
$controlIngresoAdmin->verificarIngreso("deshabilitarMenu");

$datos = data_submitted();
$abmMenu = new AbmMenu();

$arrayBusqueda = ["idmenu" => $datos['idmenu']];

?>

<?php
$respuestaDeshabilitado = $abmMenu->deshabilitarMenu($arrayBusqueda);

if ($respuestaDeshabilitado) {
    $message = "Deshabilitacion exitosa";
    header('Location: ../admin/administrarMenus.php?Message=' . urlencode($message));
} else {
    $message = "Deshabilitacion erronea";
    header('Location: ../admin/administrarMenus.php?Message=' . urlencode($message));
}
?>

<?php

include_once '../estructura/footer.php';

?>