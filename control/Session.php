<?php
class Session{
    private $usuarioActual;
    private $pass;
    private $mensajeError;
    //Constructor que inicia la sesion
    public function __construct()
    {
        session_start();
    }

    // Getters
    public function getUsuarioActual()
    {
        return $_SESSION['usuario'];
    }
    
    public function getPass()
    {
        return $_SESSION['pass'];
    }
    
    public function getMensajeError()
    {
        return $_SESSION['error'];
    }
    
    // Setters
    public function setUsuarioActual($usuario)
    {
        $_SESSION['usuario']=$usuario;
    }

    public function setPass($pass)
    {
        $_SESSION['pass']=$pass;
    }

    public function setMensajeError($mensajeError)
    {
        $_SESSION['error'] = $mensajeError;
    }
    
    // Metodos
    // Actualiza las variables de sesion con los valores ingresados
    public function iniciar($nombreUsuario,$psw){
        $this->setUsuarioActual($nombreUsuario);
        $this->setPass($psw);
    }
    
    // Valida si la sesion actual tiene usuario y psw validos. Devuelve TRUE or FALSE
    public function validar(){
        $valido = false;
        $nombre = $this->getUsuarioActual();
        $pass = $this->getPass();
        $objUsuario = new AbmUsuario();
        $usuario = $objUsuario->buscar(['usnombre'=>$nombre,'uspass'=>$pass]);
        
        if (count($usuario) == 1){
            //Chequeo que no haya sido borrado
            if ($usuario[0]->getUsdeshabilitado()=="0000-00-00 00:00:00"){
                $valido=true;
            }else{
                $this->setMensajeError("El usuario no está habilitado en la base.");
            }
            //Chequeo que tenga un rol asignado
            $rolUsuario = new AbmUsuarioRol();
            $roles = $rolUsuario->buscar(['idusuario'=>$usuario[0]->getIdusuario()]);
            
            if (count($roles) < 1){
                $valido = false;
                $this->setMensajeError("El usuario no posee ningun rol en la base.");
            }
        }else{
            $this->setMensajeError("Usuario y/o contraseña incorrecto.");
        }
        
        return $valido;
    }
    
    // Devuelve TRUE o FALSE si la sesion esta activa o no
    public function activa(){
        $activa=false;
        
        if (isset($_SESSION['usuario'])){
            $activa=true;
        }
        
        return $activa;
    }
    
    // Devuelve el usuario logeado
    public function getUsuario(){
        $objUs=null;
        $abmUs = new AbmUsuario();
        $arrayUs = $abmUs->buscar(['usnombre'=>$this->getUsuarioActual(),'uspass'=>$this->getPass()]);
        
        if (count($arrayUs) == 1){
            $objUs=$arrayUs[0];
        }
        
        return $objUs;
    }
    
    // Devuelve array de roles del usuario logeado
    public function getRol(){
        $roles = [];
        $nombre = ['usnombre'=>$this->getUsuarioActual()];
        $abmUs = new AbmUsuario();
        $arreglo = $abmUs->buscar($nombre);
        
        if (count($arreglo) == 1){
            $id=$arreglo[0]->getIdusuario();
            $abmRelacion=new AbmUsuarioRol();
            $roles=$abmRelacion->buscar(['idusuario'=>$id]);
        }
        
        return $roles;
    }
    
    // Cierra la sesion actual
    public function cerrar(){
        session_unset();
        session_destroy();
    }


    
}
?>