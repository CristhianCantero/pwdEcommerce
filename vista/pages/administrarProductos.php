<?php
$titulo = 'Listado Productos';
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
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class='table align-middle'>
                    <thead class='table-dark'>
                        <tr>
                            <th scope='col' class='text-center'>Codigo</th>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Detalle</th>
                            <th scope='col' class='text-center'>Precio</th>
                            <th scope='col' class='text-center'>Descuento</th>
                            <th scope='col' class='text-center'>Veces comprado</th>
                            <th scope='col' class='text-center'>Stock</th>
                            <th scope='col' class='text-center'>Fecha Ingreso</th>
                            <th scope='col' class='text-center'>Deshabiltado</th>
                            <th scope='col' class='text-center'>Editar</th>
                            <th scope='col' class='text-center'>Eliminar</th>
                            <th scope='col' class='text-center'>Deshabilitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($listaProductos) > 0) {
                            foreach ($listaProductos as $producto) {
                                $id = $producto->getIdProducto();
                                echo "<tr>";
                                echo "<td class='text-center'>{$producto->getIdProducto()}</td>";
                                echo "<td class='text-center'>{$producto->getProNombre()}</td>";
                                echo "<td class='text-center'>{$producto->getProDetalle()}</td>";
                                echo "<td class='text-center'>{$producto->getProPrecio()}</td>";
                                echo "<td class='text-center'>{$producto->getProDescuento()}</td>";
                                echo "<td class='text-center'>{$producto->getProVecesComprado()}</td>";
                                echo "<td class='text-center'>{$producto->getProCantStock()}</td>";
                                echo "<td class='text-center'>{$producto->getProIngreso()}</td>";
                                if($producto->getProDeshabilitado() == "0000-00-00 00:00:00"){
                                    $deshabilitado = "";
                                    echo "<td class='text-center'>{$deshabilitado}</td>";
                                }else{
                                    echo "<td class='text-center'>{$producto->getProDeshabilitado()}</td>";
                                }
                                echo "<form method='post' action='actualizarProducto.php'>
                            <td class='text-center'>
                            <input name='id' id='id' type='hidden' value='$id'>
                            <button class='btn btn-warning btn-sm' type='submit' value='$id' name='id' id='id' role='button' formaction='actualizarProducto.php'><i class='bi bi-pencil-square'></i></button>
                            </td>
                        </form>";
                                echo "<form method='post' action='eliminarProducto.php'>
                            <td class='text-center'>
                            <input name='id' id='id' type='hidden' value='$id'>
                            <button class='btn btn-danger btn-sm' type='submit' value='$id' name='id' id='id' role='button' formaction='eliminarProducto.php'><i class='bi bi-trash'></i></button>
                            </td>
                        </form>";
                                echo "<form method='post' action='deshabilitarProducto.php'>
                            <td class='text-center'>
                            <input name='id' id='id' type='hidden' value='$id'>
                            <button class='btn btn-secondary btn-sm' type='submit' value='$id' name='id' id='id' role='button' formaction='deshabilitarProducto.php'><i class='fas fa-ban'></i></button>
                            </td>
                        </form>";
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