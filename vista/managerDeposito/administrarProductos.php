<?php
include_once '../../configuracion.php';

$titulo = 'Administración de Productos';

$datos = data_submitted();

if (!isset($datos["verificado"])) {
    $controlIngresoManagerDeposito = new controlIngresoManagerDeposito();
    $controlIngresoManagerDeposito->verificarIngreso("administrarProductos");
}
include_once '../estructura/header.php';

$abmProductos = new AbmProducto();
$listaProductos = $abmProductos->buscar(null);

?>
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Listado de Productos</h4>
        </div>
    </div>
</header>

<div class="container mt-2">
    <section class="py-2">
        <div class="">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class='table align-middle'>
                    <thead class='table-dark'>
                        <tr class='align-middle'>
                            <th scope='col' class='text-center'>Codigo</th>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Detalle</th>
                            <th scope='col' class='text-center'>Precio</th>
                            <th scope='col' class='text-center'>Descuento</th>
                            <th scope='col' class='text-center'>Veces comprado</th>
                            <th scope='col' class='text-center'>Stock</th>
                            <th scope='col' class='text-center'>Fecha Ingreso</th>
                            <th scope='col' class='text-center'>Fecha Deshabilitado</th>
                            <th scope='col' class='text-center'></th>
                            <th scope='col' class='text-center'></th>
                            <th scope='col' class='text-center'></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (count($listaProductos) > 0) {
                            foreach ($listaProductos as $producto) {
                                $id = $producto->getIdProducto(); ?>
                                <tr>
                                    <td class='text-center'><?php echo $id ?></td>
                                    <td class='text-center'><?php echo $producto->getProNombre() ?></td>
                                    <td class='text-center'><?php echo $producto->getProDetalle() ?></td>
                                    <td class='text-center'><?php echo $producto->getProPrecio() ?></td>
                                    <td class='text-center'><?php echo $producto->getProDescuento() ?></td>
                                    <td class='text-center'><?php echo $producto->getProVecesComprado() ?></td>
                                    <td class='text-center'><?php echo $producto->getProCantStock() ?></td>
                                    <td class='text-center'><?php echo $producto->getProIngreso() ?></td>

                                    <?php
                                    if ($producto->getProDeshabilitado() == "0000-00-00 00:00:00") {
                                        $deshabilitado = ""; ?>
                                        <td class='text-center'><?php echo $deshabilitado ?></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td class='text-center'><?php echo $producto->getProDeshabilitado() ?></td>
                                    <?php
                                    }
                                    ?>
                                    <form method='post' action='actualizarProducto.php'>
                                        <td class='text-center'>
                                            <input name='idproducto' id='idproducto' type='hidden' value='<?php echo $id ?>'>
                                            <button class='btn btn-warning btn-sm' type='submit' role='button'><i class='bi bi-pencil-square'></i>&nbsp;Editar</button>
                                        </td>
                                    </form>

                                    <form method='post' action='eliminarProducto.php'>
                                        <td class='text-center'>
                                            <input name='idproducto' id='idproducto' type='hidden' value='<?php echo $id ?>'>
                                            <button class='btn btn-danger btn-sm' type='submit' value='<?php $id ?>' role='button'><i class='bi bi-trash'></i>&nbsp;Eliminar</button>
                                        </td>
                                    </form>


                                    <form method='post' action='deshabilitarProducto.php'>
                                        <td class='text-center'>
                                            <input name='idproducto' id='idproducto' type='hidden' value='<?php echo $id ?>'>
                                            <?php
                                            if ($producto->getProDeshabilitado() == "0000-00-00 00:00:00") { ?>
                                                <button class='btn btn-secondary btn-sm' type='submit' value='<?php $id ?>' role='button'><i class='fas fa-ban'></i>&nbsp;Deshabilitar</button>
                                            <?php
                                            } else { ?>
                                                <button class='btn btn-success btn-sm' type='submit' value='<?php $id ?>' role='button'><i class="fas fa-check-circle"></i><br>&nbsp;Habilitar</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </form>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php

include_once '../estructura/footer.php';

?>