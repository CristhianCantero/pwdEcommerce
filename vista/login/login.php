<?php
$titulo = "Login";
include_once '../estructura/header.php';
include_once '../../configuracion.php';

$sesion = new Session();

if ($sesion->activa()) {
    header("Location:../home/index.php");
} else {
    include_once("../estructura/header.php");
}

$datos = data_submitted();
?>

<div class="form-signin mx-auto p-3 text-center">
    <form id="loginForm" name="loginForm" method="POST" action="verificarLogin.php">
        <h4 class="mt-3 mb-3">Entrar al sitio</h4>
        <div class="form-group">
            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input class="form-control" type="text" id="usnombre" name="usnombre" placeholder="Usuario" aria-label="username" aria-describedby="basic-addon1" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                <input class="form-control" type="password" id="uspass" name="uspass" placeholder="*********" aria-label="password" aria-describedby="basic-addon1" required>
            </div>
        </div>
        <div class="d-grid my-3">
            <button class="btn btn-lg btn-primary" type="submit">Iniciar sesión</button>
        </div>

        <?php
        if (isset($datos['error'])) {
            $mensaje = $datos['error']; ?>
            <div class='alert alert-danger d-flex align-items-center text-center' role='alert'>
                <i class="bi bi-exclamation-triangle-fill">&nbsp;<?php echo $mensaje ?></i>
            </div>
        <?php
        } ?>
    </form>
    <div>
        <p class="mb-0 text-muted">¿No tenés cuenta? <a href="registrar.php">¡Registrate!</a></p>
    </div>
</div>

<?php
include_once("../estructura/footer.php");
?>