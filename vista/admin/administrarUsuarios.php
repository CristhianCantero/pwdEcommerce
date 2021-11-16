<?php
$titulo = 'Administración de Usuarios';
include_once '../estructura/header.php';

$abmUsuario = new AbmUsuario();
$listadoUsuarios = $abmUsuario->buscar(null);

?>
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Listado usuarios</h4>
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
                            <th scope="col" class='text-center'>ID Usuario</th>
                            <th scope="col" class='text-center'>Nombre Usuario</th>
                            <th scope='col' class='text-center'>Contraseña MD5</th>
                            <th scope="col" class='text-center'>Correo Electronico</th>
                            <th scope="col" class='text-center'>Fecha Deshabilitado</th>
                            <th scope='col' class='text-center'>Editar</th>
                            <th scope='col' class='text-center'>Eliminar</th>
                            <th scope='col' class='text-center'>Deshabilitar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($listadoUsuarios as $usuario) {
                            $id = $usuario->getIdusuario(); ?>
                            <tr>
                                <td scope='row' class='text-center'><?php echo $id ?></td>
                                <td scope='row' class='text-center'><?php echo $usuario->getUsnombre() ?></td>
                                <td scope='row' class='text-center'><?php echo $usuario->getUsPass() ?></td>
                                <td scope='row' class='text-center'><?php echo $usuario->getUsmail() ?></td>

                                <?php
                                $estado = $usuario->getUsdeshabilitado();
                                if ($estado == "0000-00-00 00:00:00") {
                                    $estado = "";
                                }
                                ?>

                                <td scope='row'><?php echo $estado ?></td>

                                <form method='post' action='actualizarUsuario.php'>
                                    <td class='text-center'>
                                        <input name='idusuario' id='idusuario' type='hidden' value='<?php echo $id ?>'>
                                        <button class='btn btn-warning btn-sm' type='submit' role='button'><i class='bi bi-pencil-square'></i></button>
                                    </td>
                                </form>

                                <form method='post' action='eliminarUsuario.php'>
                                    <td class='text-center'>
                                        <input name='idusuario' id='idusuario' type='hidden' value='<?php echo $id ?>'>
                                        <button class='btn btn-danger btn-sm' type='submit' value='<?php $id ?>' role='button'><i class='bi bi-trash'></i></button>
                                    </td>
                                </form>
                                <form method='post' action='deshabilitarUsuario.php'>
                                    <td class='text-center'>
                                        <input name='idusuario' id='idusuario' type='hidden' value='<?php echo $id ?>'>
                                        <button class='btn btn-secondary btn-sm' type='submit' value='<?php $id ?>' role='button'><i class='fas fa-ban'></i></button>
                                    </td>
                                </form>
                            </tr>
                        <?php
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