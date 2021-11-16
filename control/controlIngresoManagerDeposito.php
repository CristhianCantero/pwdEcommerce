<?php
include_once '../../configuracion.php';
class controlIngresoManagerDeposito
{
    public function verificarIngreso($pagina)
    {
        $sesion = new Session();

        if (!$sesion->activa()) {
            header('Location: ../home/index.php');
            exit;
        }

        if ($sesion->getUsRoles()[0] != 2) {
            if (isset($sesion->getUsRoles()[1])) {
                if ($sesion->getUsRoles()[1] != 2) {
                    header('Location: ../home/index.php');
                    exit;
                }
                header('Location: ../managerDeposito/' . $pagina . '.php?verificado=1');
                exit;
            }
            header('Location: ../home/index.php');
            exit;
        } else {
            header('Location: ../managerDeposito/' . $pagina . '.php?verificado=1');
            exit;
        }
    }
}
