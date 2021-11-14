<?php

class Session
{
    // Constructor
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    // Getters
    public function getIdUsuario()
    {
        return $_SESSION['idusuario'];
    }

    public function getUsNombre()
    {
        return $_SESSION['usnombre'];
    }

    public function getUsPass()
    {
        return $_SESSION['uspass'];
    }

    // Setters
    public function setIdUsuario($idUser)
    {
        $_SESSION['idusuario'] = $idUser;
    }

    public function setUsNombre($userName)
    {
        $_SESSION['usnombre'] = $userName;
    }

    public function setUsPass($pass)
    {
        $_SESSION['uspass'] = $pass;
    }

    // Metodos
    public function iniciar($nombreUsuario, $passUsuario)
    {
        $this->setUsNombre($nombreUsuario);
        $this->setUsPass($passUsuario);
    }


    /**
     * Valida la existencia de un usuario en la bd
     * @return array ($inicia, $error)
     */
    public function validar()
    {
        $inicia = false;
        $nombreUsuario = $this->getUsNombre();
        $passUsuario = $this->getUsPass();
        $abmUsuario = new AbmUsuario();
        $where = array();
        $filtro1 = array();
        $filtro1['usnombre'] = $nombreUsuario;
        $filtro2 = array();
        $filtro2['uspass'] = $passUsuario;
        $where['usnombre'] = $nombreUsuario;
        $where['uspass'] = $passUsuario;
        $listaUsuarios = $abmUsuario->buscar($where);
        $username = $abmUsuario->buscar($filtro1);
        $pass =  $abmUsuario->buscar($filtro2);
        $error = "";

        if ($username == null || $pass == null) {
            $error .= "Usuario y/o contraseña incorrecto!";
        }

        if (count($listaUsuarios) > 0) {
            $fechaDes = $listaUsuarios[0]->getUsDeshabilitado();
            if ($fechaDes != "0000-00-00 00:00:00") {
                $error .= "Este usuario se encuentra deshabilitado!";
            } else {
                $inicia = true;
                $this->setIdUsuario($listaUsuarios[0]->getIdUsuario());
            }
        }

        return array($inicia, $error);
    }


    /**
     * Pone la sesion activa para el usuario loggeado
     * @return boolean $activa
     */
    public function activa()
    {
        $activa = false;
        if (isset($_SESSION['usnombre'])) {
            $activa = true;
        }

        return $activa;
    }


    /**
     * Consigue a un usuario de la bd
     * @return $datosUsuario
     */
    public function getUsuario()
    {
        $abmUsuario = new AbmUsuario();
        $where = ['idusuario' => $_SESSION['idusuario']];
        $listaUsuarios = $abmUsuario->buscar($where);

        if ($listaUsuarios >= 1) {
            $datosUsuario = $listaUsuarios[0];
        }

        return $datosUsuario;
    }


    /**
     * Consigue al rol del usuario a loggearse
     * @return string $rol
     */
    public function getRol()
    {
        $abmUsuarioRol = new AbmUsuarioRol();
        $usuario = $this->getUsuario();
        $idUsuario = $usuario->getIdUsuario();
        $param = ['idusuario' => $idUsuario];
        $listaRolesUsu = $abmUsuarioRol->buscar($param);

        if ($listaRolesUsu > 1) {
            $rol = $listaRolesUsu;
        } else {
            $rol = $listaRolesUsu[0];
        }

        return $rol;
    }

    /**
     * Destruye la session creada.
     */
    public function cerrarSession()
    {
        session_unset();
        session_destroy();
    }


    /*---------------- MOSTRAR VALORES DE SESSION ----------------*/

    /*public function mostrarValorVariables()
    {
        print_object($_SESSION);
    }*/
}
