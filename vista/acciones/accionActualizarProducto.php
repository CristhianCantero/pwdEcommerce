<?php
include_once '../../configuracion.php';

$datos = data_submitted();
print_r($datos);

$abmProducto = new AbmProducto();

$datosBusqueda['idproducto'] = $datos['idproducto'];
$listaProductos = $abmProducto->buscar($datosBusqueda);

if (isset($listaProductos[0])) {
    if (array_key_exists('imagen', $datos) && !is_null($datos['imagen'])) {
        $controlCargaImagen = new controlCargaImagenes();
        $controlCargaImagen->eliminarImagen($datos['idproducto']);
        $controlCargaImagen->cargarImagen($_FILES, $datos['idproducto']);
    }
    $exito = $abmProducto->modificacion($datos);

    if ($exito) {
        echo "bien papá";
        // header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode("Producto modificado"));
        // exit;
    } else {
        echo "uy";
        // header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode("Error en la modificacion"));
        // exit;
    }
} else {
    $message = "Producto no encontrado en la base de datos";
    // header('Location: ../managerDeposito/administrarProductos.php?message=' . urlencode($message));
    // exit;
}
