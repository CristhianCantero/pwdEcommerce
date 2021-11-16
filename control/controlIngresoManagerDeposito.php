<?php
include_once '../../configuracion.php';
class controlIngresoManagerDeposito {
    public function verificarIngreso($pagina){
        $sesion = new Session();

        if (!$sesion->activa()) {
            header('Location: ../home/index.php');
            exit;
        }
    
        $abmUsuario = new AbmUsuario();
        $listadoUsuarios = $abmUsuario->buscar(null);
    
        $abmUsuarioRol = new AbmUsuarioRol();
        $listadoUsuariosRol = $abmUsuarioRol->buscar(['idusuario'=>$sesion->getIdUsuario()]);
    
        if ($listadoUsuariosRol[0]->getObjRol()->getIdRol() != 2) {
            header('Location: ../home/index.php');
            exit;
        } else {
            header('Location: ../managerDeposito/' . $pagina . '.php');
            exit;
        }
        
    }
}
