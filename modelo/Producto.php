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

    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    // Metodos
    public function setear($idproducto, $proprecio, $prodescuento, $pronombre, $prodetalle, $provecescomprado, $procantstock)
    {
        $this->setIdProducto($idproducto);
        $this->setProPrecio($proprecio);
        $this->setProDescuento($prodescuento);
        $this->setProNombre($pronombre);
        $this->setProDetalle($prodetalle);
        $this->setProVecesComprado($provecescomprado);
        $this->setProStock($procantstock);
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
                    $this->setear($row['idproducto'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['provecescomprado'], $row['procantstock']);
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

        $sql = "INSERT INTO producto (proprecio, prodescuento, pronombre, prodetalle, provecescomprado, procantstock) VALUES ('" . $this->getProPrecio() . "','" . $this->getProDescuento() . "','" . $this->getProNombre() . "','" . $this->getProDetalle() . "','" . $this->getProVecesComprado() . "','" . $this->getProCantStock() . "'";

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
        $sql = "UPDATE producto SET idproducto='" . $this->getIdProducto() . "', proprecio'" . $this->getProPrecio() . "', prodescuento'" . $this->getProDescuento() . "', pronombre='" . $this->getProNombre() . "', prodetalle='" . $this->getProDetalle() . "', provecescomprado='" . $this->getProVecesComprado() . "', procantstock='" . $this->getProCantStock() . "' WHERE idproducto='" . $this->getIdProducto() . "'";
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
        $sql = "DELETE FROM producto WHERE idproducto=" . $this->getIdProducto();
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
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['proprecio'], $row['prodescuento'], $row['pronombre'], $row['prodetalle'], $row['provecescomprado'], $row['procantstock']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
