<?php
include_once "../../configuracion.php";

$sesion = new Session();

if (!$sesion->activa()) {
    header('Location: ../login.php');
    exit;
}
$titulo = 'Perfil Usuario';

include_once "../estructura/header.php";

?>
<div class="container mt-3">

</div>

<?php
include_once("../estructura/footer.php");
?>