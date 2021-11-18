<?php
include_once '../../configuracion.php';
class controlIngresoCliente
{
    public function verificarIngreso($pagina)
    {
        $sesion = new Session();

        if (!$sesion->activa()) {
            header('Location: ../home/index.php');
            exit;
        }

        if ($sesion->getUsRoles()[0] != 3) {
            if (isset($sesion->getUsRoles()[1])) {
                if ($sesion->getUsRoles()[1] != 3) {
                    header('Location: ../home/index.php');
                    exit;
                }
                header('Location: ../cliente/' . $pagina . '.php?verificado=1');
                exit;
            }
            header('Location: ../home/index.php');
            exit;
        } else {
            header('Location: ../cliente/' . $pagina . '.php?verificado=1');
            exit;
        }
    }
    public function verificarCompras($pagina){

    }
}
