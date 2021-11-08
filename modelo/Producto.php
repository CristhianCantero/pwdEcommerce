<?php

class Producto
{
    private $idProducto;
    private $proPrecio;
    private $proDescuento;
    private $proNombre;
    private $proDetalle;
    private $proVecesComprado;
    private $proCantStock;
    private $proIngreso;
    private $proDeshabilitado;
    private $mensajeOperacion;


    public function __construct()
    {

        $this->idProducto = "";
        $this->proPrecio = "";
        $this->proDescuento = "";
        $this->proNombre = "";
        $this->proDetalle = "";
        $this->proVecesComprado = "";
        $this->proCantStock = "";
        $this->proIngreso = "";
        $this->deshabilitado = "";
        $this->mensajeOperacion = "";
    }

    // Getters
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function getProPrecio()
    {
        return $this->proPrecio;
    }

    public function getProDescuento()
    {
        return $this->proDescuento;
    }

    public function getProNombre()
    {
        return $this->proNombre;
    }

    public function getProDetalle()
    {
        return $this->proDetalle;
    }

    public function getProVecesComprado()
    {
        return $this->proVecesComprado;
    }

    public function getProCantStock()
    {
        return $this->proCantStock;
    }

    public function getProIngreso()
    {
        return $this->proIngreso;
    }

    public function getProDeshabilitado()
    {
        return $this->proDeshabilitado;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    // Setters
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function setProPrecio($proPrecio)
    {
        $this->proPrecio = $proPrecio;
    }

    public function setProDescuento($proDescuento)
    {
        $this->proDescuento = $proDescuento;
    }

    public function setProNombre($proNombre)
    {
        $this->proNombre = $proNombre;
    }

    public function setProDetalle($proDetalle)
    {
        $this->proDetalle = $proDetalle;
    }

    public function setProVecesComprado($proVecesComprado)
    {
        $this->proVecesComprado = $proVecesComprado;
    }

    public function setProStock($proCantStock)
    {
        $this->proCantStock = $proCantStock;
    }

    public function setProIngreso($proIngreso)
    {
        $this->proIngreso = $proIngreso;
    }

    public function setProDeshabilitado($proDeshabilitado)
    {
        $this->proDeshabilitado = $proDeshabilitado;
    }

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($idproducto, $proingreso, $proprecio, $prodescuento, $pronombre, $prodetalle, $provecescomprado, $procantstock, $prodeshabilitado)
    {
        $this->setIdProducto($idproducto);
        $this->setProIngreso($proingreso);
        $this->setProPrecio($proprecio);
        $this->setProDescuento($prodescuento);
        $this->setProNombre($pronombre);
        $this->setProDetalle($prodetalle);
        $this->setProVecesComprado($provecescomprado);
        $this->setProStock($procantstock);
        $this->setProDeshabilitado($prodeshabilitado);
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdProducto();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['proingreso'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['provecescomprado'], $row['procantstock'], $row['prodeshabilitado']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("Producto->listar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "INSERT INTO producto (idproducto, proprecio, prodescuento, pronombre, prodetalle, provecescomprado, procantstock, prodeshabilitado) VALUES ('" . $this->getIdProducto() . "'," . $this->getProPrecio() . "," . $this->getProDescuento() . ",'" . $this->getProNombre() . "','" . $this->getProDetalle() . "'," . $this->getProVecesComprado() . "," . $this->getProCantStock() . ", '0000-00-00 00:00:00')";

        if ($base->Iniciar()) {
            if ($base = $base->Ejecutar($sql)) {
                $this->setIdProducto($base);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Producto->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET idproducto='" . $this->getIdProducto() . "', proprecio=" . $this->getProPrecio() . ", prodescuento=" . $this->getProDescuento() . ", pronombre='" . $this->getProNombre() . "', prodetalle='" . $this->getProDetalle() . "', provecescomprado=" . $this->getProVecesComprado() . ", procantstock=" . $this->getProCantStock() . ", prodeshabilitado='0000-00-00 00:00:00' WHERE idproducto='" . $this->getIdProducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto='" . $this->getIdProducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    // print_r($row);
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['proingreso'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['provecescomprado'], $row['procantstock'], $row['prodeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }

        return $arreglo;
    }

    public function estado($param = "")
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET prodeshabilitado= '" . $param . "' WHERE idproducto='" . $this->getIdProducto() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->estado: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->estado: " . $base->getError());
        }
        return $resp;
    }
}
