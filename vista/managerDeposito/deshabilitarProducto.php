<?php
$titulo = 'Deshabilitación de Producto';

include_once '../estructura/header.php';

$datos = data_submitted();

$abmProducto = new AbmProducto();

$id = $datos['idproducto'];

?>

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header">
            Deshabilitación del producto
        </div>
        <div class="card-body">
            <h5 class="card-title">¿Desea deshabilitar temporalmente el producto?</h5>
            <p class="card-text">Código: <?php echo $id ?></p>
            <form action='../acciones/accionDeshabilitarProducto.php' method='post'>
                <input name='idproducto' id='idproducto' type='hidden' value='<?php echo $id ?>'>
                <button class='btn btn-danger btn-sm' type='submit' value='<?php $id ?>' role='button'>Deshabilitar</button>
            </form>
        </div>
    </div>
</div>

<?php

include_once '../estructura/footer.php';

?>