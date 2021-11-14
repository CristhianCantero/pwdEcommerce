<?php
class Usuariorol
{
    private $idrol;
    private $idusuario;
    private $mensajeoperacion;


    // Constructor
    public function __construct()
    {
        $this->idusuario = new Usuario();
        $this->idrol = new Rol();
        $this->mensajeoperacion = "";
    }

    // Getters
    public function getObjUsuario()
    {
        return $this->idusuario;
    }

    public function getObjRol()
    {
        return $this->idrol;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    // Setters
    public function setObjUsuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    public function setObjRol($idrol)
    {
        $this->idrol = $idrol;
    }

    public function setMensajeOperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /** SETEAR **/
    public function setear($idusuario, $idrol)
    {
        $this->setobjusuario($idusuario);
        $this->setobjrol($idrol);
    }

    /** CARGAR **/
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario = " . $this->getObjUsuario() . "and idrol =" . $this->getObjRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    $objRol = NULL;
                    if ($row['idrol'] != null) {
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idrol']);
                        $objRol->cargar();
                    }
                    $this->setear($row['idusuario'], $row['idrol']);
                }
            }
        } else {
            $this->setmensajeoperacion("usuariorol->listar: " . $base->getError());
        }
        return $resp;
    }


    /** INSERTAR **/
    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol (idusuario,idrol)  VALUES ('" . $this->getObjUsuario()->getIdUsuario() . "','" . $this->getObjRol()->getIdRol() . "')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuariorol->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->insertar: " . $base->getError());
        }
        return $resp;
    }


    /** ELIMINAR **/
    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idusuario = " . $this->getObjUsuario() . "and idrol =" . $this->getObjRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("usuariorol->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->eliminar: " . $base->getError());
        }
        return $resp;
    }


    /** LISTAR **/
    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $consultasql = "SELECT * FROM usuariorol ";
        if ($parametro != "") {
            $consultasql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($consultasql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objUsuario = NULL;
                    if ($row['idusuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    $objRol = NULL;
                    if ($row['idrol'] != null) {
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idrol']);
                        $objRol->cargar();
                    }
                    $obj = new Usuariorol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            // $this->setmensajeoperacion("Auto->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
