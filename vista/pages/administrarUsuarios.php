<?php
$titulo = 'Listado Usuarios';
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
                            <?php
                            // if ($idRol == 1) {
                            echo "<th scope='col' class='text-center'>Contraseña MD5</th>";
                            // }
                            ?>
                            <th scope="col" class='text-center'>Correo Electronico</th>
                            <th scope="col" class='text-center'>Deshabilitado</th>
                            <?php
                            // if ($idRol == 1) {
                            echo "<th scope='col' class='text-center'>Editar</th>";
                            echo "<th scope='col' class='text-center'>Eliminar</th>";
                            echo "<th scope='col' class='text-center'>Deshabilitar</th>";
                            // }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listadoUsuarios as $usuario) {
                            $id = $usuario->getIdusuario();
                            echo "<tr>";
                            echo "<td scope='row' class='text-center'>" . $usuario->getIdusuario() . "</td>";
                            echo "<td scope='row' class='text-center'>" . $usuario->getUsnombre() . "</td>";
                            // if ($idRol == 1 || $idRol == 2) {
                            echo "<td scope='row' class='text-center'>" . $usuario->getUspass() . "</td>";
                            // }
                            echo "<td scope='row' class='text-center'>" . $usuario->getUsmail() . "</td>";
                            $estado = $usuario->getUsdeshabilitado();
                            if ($estado == "0000-00-00 00:00:00") {
                                $estado = "";
                            }
                            echo "<td scope='row'>" . $estado . "</td>";
                            // if ($idRol == 1) {
                            echo "<form method='post' action='actualizarUsuario.php'>
                                    <td class='text-center'>
                                    <input name='idUsuario' id='idUsuario' type='hidden' value='$id'>
                                    <button class='btn btn-warning btn-sm' type='submit' value='$id' name='idUsuario' id='idUsuario' role='button' formaction='actualizarUsuario.php'><i class='bi bi-pencil-square'></i></button>
                                    </td>
                                </form>";
                            echo "<form method='post' action='eliminarUsuario.php'>
                                    <td class='text-center'>
                                    <input name='idUsuario' id='idUsuario' type='hidden' value='$id'>
                                    <button class='btn btn-danger btn-sm' type='submit' value='$id' name='idUsuario' id='idUsuario' role='button' formaction='eliminarUsuario.php'><i class='bi bi-trash'></i></button>
                                    </td>
                                </form>";
                            echo "<form method='post' action='deshabilitarUsuario.php'>
                                    <td class='text-center'>
                                    <input name='idUsuario' id='idUsuario' type='hidden' value='$id'>
                                    <button class='btn btn-secondary btn-sm' type='submit' value='$id' name='idUsuario' id='idUsuario' role='button' formaction='deshabilitarUsuario.php'><i class='fas fa-ban'></i></button>
                                    </td>
                                </form>";
                            // }
                            echo "</tr>";
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