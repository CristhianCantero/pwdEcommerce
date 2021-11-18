<?php

include_once '../../configuracion.php';

$titulo = 'Nuevo Producto';

$datos = data_submitted();

if (!isset($datos["verificado"])) {
    $controlIngresoManagerDeposito = new controlIngresoManagerDeposito();
    $controlIngresoManagerDeposito->verificarIngreso("nuevoProducto");
}
include_once '../estructura/header.php';

?>
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Cargar nuevo producto</h4>
        </div>
    </div>
</header>

<div class="container mt-3">
    <div class="col-md-4"></div>
    <div class="offset-md-4">
        <form action="../acciones/accionNuevoProducto.php" method="post" class="col-md-6 mt-3 " id="productoNuevo" name="productoNuevo">
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="idproducto" name="idproducto" type="text" placeholder="Codigo producto" required>
                    <label for="idproducto">Codigo del producto: </label>
                </div>
            </div>

            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="pronombre" name="pronombre" type="text" placeholder="Nombre producto" required>
                    <label for="pronombre">Nombre del producto: </label>
                </div>
            </div>

            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="prodetalle" name="prodetalle" type="text" placeholder="Detalle producto" required>
                    <label for="prodetalle">Detalle del producto: </label>
                </div>
            </div>

            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="proprecio" name="proprecio" type="text" placeholder="Precio producto" required>
                    <label for="proprecio">Precio del producto: </label>
                </div>
            </div>

            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="prodescuento" name="prodescuento" type="text" placeholder="Descuento producto" required>
                    <label for="prodescuento">Descuento aplicado al producto: </label>
                </div>
            </div>

            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="procantstock" name="procantstock" type="text" placeholder="Stock producto" required>
                    <label for="procantstock">Stock del producto: </label>
                </div>
            </div>

            <input class="form-control" id="provecescomprado" name="provecescomprado" type="number" value="0" hidden>
            <div class=" mb-3">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once '../estructura/footer.php';

?>