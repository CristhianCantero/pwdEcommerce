<?php
include_once '../../configuracion.php';

$titulo = 'Administración de Menus';

$datos = data_submitted();

if(!isset($datos["verificado"])){
    $controlIngresoAdmin = new controlIngresoAdmin();
    $controlIngresoAdmin->verificarIngreso("administrarMenus");
}

$abmMenu = new AbmMenu();
$listadoMenus = $abmMenu->buscar(null);

include_once '../estructura/header.php';

?>

<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Administración de Menus</h4>
        </div>
    </div>
</header>

<div class="container mt-2">
    <section class="py-2">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class="table align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class='text-center'>ID Menu</th>
                            <th scope="col" class='text-center'>ID Padre</th>
                            <th scope="col" class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Descripción</th>
                            <th scope="col" class='text-center'>Fecha Deshabilitado</th>
                            <th scope='col' class='text-center'>Editar</th>
                            <th scope='col' class='text-center'>Eliminar</th>
                            <th scope='col' class='text-center'>Deshabilitar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($listadoMenus as $menu) {
                            $id = $menu->getIdMenu(); ?>
                            <tr>
                                <td scope='row' class='text-center'><?php echo $id ?></td>
                                <td scope='row' class='text-center'><?php echo $menu->getIdPadre() ?></td>
                                <td scope='row' class='text-center'><?php echo $menu->getMeNombre() ?></td>
                                <td scope='row' class='text-center'><?php echo $menu->getMeDescripcion() ?></td>

                                <?php
                                $estado = $menu->getMeDeshabilitado();
                                if ($estado == "0000-00-00 00:00:00") {
                                    $estado = "";
                                }
                                ?>

                                <td scope='row'><?php echo $estado ?></td>

                                <?php
                                if ($menu->getIdPadre() == $id) { ?>
                                        <td scope='row' class='text-center'></td>
                                        <td scope='row' class='text-center'></td>
                                        <td scope='row' class='text-center'></td>
                                    </tr>                             
                                <?php
                                } else { ?>
                                        <form method='post' action='actualizarMenu.php'>
                                            <td class='text-center'>
                                                <input name='idmenu' id='idmenu' type='hidden' value='<?php echo $id ?>'>
                                                <button class='btn btn-warning btn-sm' type='submit' role='button'><i class='bi bi-pencil-square'></i></button>
                                            </td>
                                        </form>

                                        <form method='post' action='eliminarMenu.php'>
                                            <td class='text-center'>
                                                <input name='idmenu' id='idmenu' type='hidden' value='<?php echo $id ?>'>
                                                <button class='btn btn-danger btn-sm' type='submit' value='<?php $id ?>' role='button'><i class='bi bi-trash'></i></button>
                                            </td>
                                        </form>
                                        
                                        <form method='post' action='deshabilitarMenu.php'>
                                            <td class='text-center'>
                                                <input name='idmenu' id='idmenu' type='hidden' value='<?php echo $id ?>'>
                                                <button class='btn btn-secondary btn-sm' type='submit' value='<?php $id ?>' role='button'><i class='fas fa-ban'></i></button>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php
                                }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php

include_once '../estructura/footer.php';

?>