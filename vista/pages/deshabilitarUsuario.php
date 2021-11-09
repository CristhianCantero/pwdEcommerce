<?php
// $titulo = 'Deshabilitacion del usuario';
// include_once '../estructura/header.php';
include_once "../../configuracion.php";

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

$arrayBusqueda = ["idusuario" => $datos['idUsuario']];

?>

<div class="container mt-5">

    <?php
    $respuestaDeshabilitado = $abmUsuario->deshabilitarUsuario($arrayBusqueda);
    if ($respuestaDeshabilitado) {
        $message = "Deshabilitacion exitosa";
        header('Location: ../pages/administrarUsuarios.php?Message=' . urlencode($message));
    } else {
        $message = "Deshabilitacion erronea";
        header('Location: ../pages/administrarUsuarios.php?Message=' . urlencode($message));
    }
    ?>

</div>

<?php

include_once '../estructura/footer.php';

?>