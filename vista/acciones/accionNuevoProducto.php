<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmProducto = new AbmProducto();

$datosBusqueda['idproducto'] = $datos['idproducto'];
$listaProductos = $abmProducto->buscar($datos);

if (isset($listaProductos[0])) {
    $message = "El ID ingresado ya existe";
    header('Location: ../managerDeposito/nuevoProducto.php?message=' . urlencode($message));
    exit;
} else {
    $datos['provecescomprado'] = 0;
    $exito = $abmProducto->alta($datos);

    if ($exito) {
        $controlCargaImagen = new controlCargaImagenes();
        $controlCargaImagen->cargarImagen($_FILES, $datos['idproducto']);
        $message = "Producto cargado correctamente";
        header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode($message));
        exit;
    } else {
        $message = "Error en la carga del producto";
        echo $message;
        header('Location: ../managerDeposito/nuevoProducto.php?message=' . urlencode($message));
        exit;
    }
}
