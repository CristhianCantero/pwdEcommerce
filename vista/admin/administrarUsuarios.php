<?php
include_once '../../configuracion.php';

$datos = data_submitted();

if(!isset($datos["verificado"])){
    $controlIngresoAdmin = new controlIngresoAdmin();
    $controlIngresoAdmin->verificarIngreso("administrarUsuarios");
}

$titulo = 'Administración de Usuarios';

$abmUsuario = new AbmUsuario();
$listadoUsuarios = $abmUsuario->buscar(null);

include_once '../estructura/header.php';
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
                            <th scope="col" class='text-center'>ID</th>
                            <th scope="col" class='text-center'>Rol</th>
                            <th scope="col" class='text-center'>Usuario</th>
                            <th scope='col' class='text-center'>Contraseña</th>
                            <th scope="col" class='text-center'>Email</th>
                            <th scope="col" class='text-center'>Fecha Deshabilitado</th>
                            <th scope='col' class='text-center'>Editar</th>
                            <th scope='col' class='text-center'>Eliminar</th>
                            <th scope='col' class='text-center'>Deshabilitar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($listadoUsuarios as $usuario) {
                            $id = $usuario->getIdusuario();
                            $abmUsuarioRol = new AbmUsuarioRol();
                            $datos['idusuario'] = $id;
                            $listaUsuarioRol = $abmUsuarioRol->buscar($datos);
                            $rol = $listaUsuarioRol[0]->getObjRol()->getRolDescripcion(); ?>
                            <tr>
                                <td scope='row' class='text-center'><?php echo $id ?></td>
                                <?php
                                switch ($rol) {
                                    case 'Admin': ?>
                                        <td scope='row' class='text-center'><span class="badge rounded-pill bg-dark"><?php echo $rol ?></span></td>
                                    <?php
                                        break;
                                    case 'Manager Deposito': ?>
                                        <td scope='row' class='text-center'><span class="badge rounded-pill bg-success"><?php echo $rol ?></span></td>
                                    <?php
                                        break;
                                    default: ?>
                                        <td scope='row' class='text-center'><span class="badge rounded-pill bg-light text-dark"><?php echo $rol ?></span></td>
                                <?php
                                        break;
                                }
                                ?>

                                <td scope='row' class='text-center'><?php echo $usuario->getUsNombre() ?></td>
                                <td scope='row' class='text-center'><?php echo $usuario->getUsPass() ?></td>
                                <td scope='row' class='text-center'><?php echo $usuario->getUsmail() ?></td>

                                <?php
                                $estado = $usuario->getUsdeshabilitado();
                                if ($estado == "0000-00-00 00:00:00") {
                                    $estado = "";
                                }
                                ?>

                                <td scope='row'><?php echo $estado ?></td>

                                <?php
                                if ($id == $sesion->getIdUsuario()) { ?>
                                        <td scope='row' class='text-center'></td>
                                        <td scope='row' class='text-center'></td>
                                        <td scope='row' class='text-center'></td>
                                    </tr>
                                <?php
                                } else { ?>
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