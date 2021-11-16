<?php
include_once '../../configuracion.php';
class controlIngresoAdmin {
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
    
        if ($listadoUsuariosRol[0]->getObjRol()->getIdRol() != 1) {
            header('Location: ../home/index.php');
            exit;
        } else {
            header('Location: ../admin/' . $pagina . '.php');
            exit;
        }
        
    }
}
