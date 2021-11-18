<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmMenu = new AbmMenu();
$datosBusqueda['menombre'] = $datos['menombre'];

$lista = $abmMenu->buscar($datosBusqueda);

if (!isset($lista[0])) {
    $exito = false;
    $datosBusqueda = $datos;
    $exitoAltaMenu = $abmMenu->alta($datosBusqueda);

    if ($exitoAltaMenu) {
        $lista = $abmMenu->buscar($datosBusqueda);
        $datos['idmenu'] = $lista[0]->getIdMenu();
        $abmMenuRol = new AbmMenuRol();
        $datos['idrol'] = $datos['idpadre'];
        $exito = $abmMenuRol->alta($datos);
    }

    $exito ? header('Location: ../admin/administrarMenus.php?messageOk=' . urlencode("Menu cargado correctamente")) : header('Location: ../admin/administrarMenus.php?messageErr=' . urlencode("Error en la carga"));
    exit;
} else {
    $message = "Error carga menú";
    header('Location: ../admin/cargarMenu.php?messageErr=' . urlencode($message));
    exit;
}
