<?php

include_once '../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    header('Location: ../vista/home/index.php?message=' . urlencode('La sesion no esta iniciada'));
    exit;
} else {
    $datos = data_submitted();
    $roles = $sesion->getUsRoles();
    $rolesSesion = array($roles[0]);
    switch ($datos['rol']) {
        case md5(1):
            if ($rolesSesion[0] != 1) {
                $rolesSesion[1] = 1;;
                $sesion->setUsRoles($rolesSesion);
                print_r($sesion->getUsRoles());
            } else {
                $rolesSesion = array($roles[0]);
                $sesion->setUsRoles($rolesSesion);
            }
            break;
        case md5(2):
            if ($rolesSesion[0] != 2) {
                $rolesSesion[1] = 2;
                $sesion->setUsRoles($rolesSesion);
                print_r($sesion->getUsRoles());
            } else {
                $rolesSesion = array($roles[0]);
                $sesion->setUsRoles($rolesSesion);
            }
            break;
        case md5(3):
            if ($rolesSesion[0] != 3) {
                $rolesSesion[1] = 3;
                $sesion->setUsRoles($rolesSesion);
                print_r($sesion->getUsRoles());
            } else {
                $rolesSesion = array($roles[0]);
                $sesion->setUsRoles($rolesSesion);
            }
            break;
    }

    header('Location: ../vista/home/index.php?message=' . urlencode("Cambio de rol exitoso!"));
    exit;
}
