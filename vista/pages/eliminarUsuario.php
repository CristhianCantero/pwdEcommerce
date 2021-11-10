<?php
$titulo = 'Confirmacion de eliminación';
include_once '../estructura/header.php';

$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$objUsuario = $abmUsuario->buscar(["idusuario" => $datos['idUsuario']]);
$id = $datos['idUsuario'];

?>

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header">
            Eliminación del producto
        </div>
        <div class="card-body">
            <h5 class="card-title">¿Desea eliminar de forma permanente al usuario?</h5>
            <p class="card-text">Nombre del usuario: <?php echo $objUsuario[0]->getUsnombre() ?></p>
            <p class="card-text">Correo electronico del usuario: <?php echo $objUsuario[0]->getUsmail() ?></p>
            <?php
            echo "<form action='../acciones/accionEliminarUsuario.php' method='post'>";
            echo "<input name='idusuario' id='idusuario' type='hidden' value='$id'>";
            echo "<button class='btn btn-danger btn-sm' type='submit' value='$id' name='idusuario' id='idusuario' role='button' formaction='../acciones/accionEliminarUsuario.php'>Eliminar</button>";
            echo "</form>";
            ?>
        </div>
    </div>
</div>

<?php

include_once '../estructura/footer.php';

?>