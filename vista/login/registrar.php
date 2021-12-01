<?php
$titulo = 'Registro de usuario';
include_once '../estructura/header.php';
?>

<div class="container mt-2">
    <h4 class="text-center">Registro</h4>
    <div class="col-md-4"></div>
    <div class="offset-md-4">
        <form action="../acciones/accionNuevoUsuario.php" method="post" class="col-md-6 mt-3 " id="usuarioNuevo" name="usuarioNuevo">
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre de usuario" required>
                    <label for="usnombre">Nombre de usuario: </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="uspass" name="uspass" type="text" placeholder="Contraseña" required>
                    <label for="uspass">Contraseña: </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Correo Electronico" required>
                    <label for="usmail">Correo Electronico: </label>
                </div>
            </div>
            <input id="idrol" name="idrol" type="text" value="3" hidden>
            <div class=" mb-3">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Registrarme</button>
                </div>
            </div>
        </form>
    </div>

</div>

<?php

include_once '../estructura/footer.php';

?>