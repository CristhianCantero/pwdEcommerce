<?php
$titulo = 'Confirmacion eliminacion';
include_once '../estructura/header.php';

$datos = data_submitted();
$abmProducto = new AbmProducto();

$id = $datos['id'];

?>

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header">
            Confirmacion de Eliminacion
        </div>
        <div class="card-body">
            <h5 class="card-title">¿Desea eliminar de forma permanente el producto?</h5>
            <p class="card-text">Codigo: <?php echo $id ?></p>
            <?php
                echo "<form action='../acciones/accionEliminarProducto.php' method='post'>";
                echo "<input name='idproducto' id='idproducto' type='hidden' value='$id'>";
                echo "<button class='btn btn-danger btn-sm' type='submit' value='$id' name='idproducto' id='idproducto' role='button' formaction='../acciones/accionEliminarProducto.php'>Eliminar</button>";
                echo "</form>";
            ?>
        </div>
    </div>
</div>

<?php

include_once '../estructura/footer.php';

?>