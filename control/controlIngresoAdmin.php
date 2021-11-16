<?php
include_once '../../configuracion.php';
class controlIngresoAdmin {
    public function verificarIngreso($pagina){
        $sesion = new Session();

        if (!$sesion->activa()) {
            header('Location: ../home/index.php');
            exit;
        }
    
        if ($sesion->getUsRoles()[0] != 1) {
            header('Location: ../home/index.php');
            exit;
        } else {
            header('Location: ../admin/' . $pagina . '.php?verificado=1');
            exit;
        }
        
    }
}
