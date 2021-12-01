<?php
class AbmCompraEstado
{
    private function cargarObjeto($param)
    {
        $obj = null;

        if (array_key_exists('idcompra', $param)) {
            //creo objeto estadotipos
            $objProducto = new Compra();
            $objProducto->setIdCompra($param['idcompra']);
            $objProducto->cargar();

            // Creo objeto usuario
            $objCompraEstadoTipo = new CompraEstadoTipo();
            $objCompraEstadoTipo->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompraEstadoTipo->cargar();

            // Agregarle los otros objetos
            $obj = new CompraEstado();
            $obj->setear('', $objProducto, $objCompraEstadoTipo, '', '');
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idcompraestado'])) {
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], null, null, null, null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;

        if (isset($param['idcompraestado'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        // $param['idcompraestado'] = null;
        $abmCompraItem = new AbmCompraItem();
        $abmProducto = new AbmProducto();
        // busco los items pertenecientes al carrito
        $listadoItems = $abmCompraItem->buscar(['idcompra' => $param['idcompra']]);
        print_r($listadoItems);
        $stockDisponible = true;
        // chequeo que haya stock del producto en la bd
        foreach ($listadoItems as $item) {
            $respStock = $abmProducto->chequearStock($item);
            if (!$respStock) {
                $stockDisponible = false;
            }
        }
        // si hay stock dispomible entonces envio el carrito
        if ($stockDisponible) {
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null and $objCompraEstado->insertar()) {
                $resp = true;
            }
            // si se cargo el carrito entonces paso a modificar el stock y vecesComprado del producto
            if ($resp) {
                foreach ($listadoItems as $item) {
                    $objProducto = new Producto();
                    $producto = $objProducto->listar("idproducto ='" . $item->getIdProducto()->getIdProducto() . "'");
                    $stockActual = $producto[0]->getProCantStock();
                    $stockActualizado = $stockActual - $item->getCiCantidad();
                    $producto[0]->setProStock($stockActualizado);
                    $vecesCompradoActual = $producto[0]->getProVecesComprado();
                    $vecesCompradoActualizado = $vecesCompradoActual + $item->getCiCantidad();
                    $producto[0]->setProVecesComprado($vecesCompradoActualizado);
                    $respModificar = $producto[0]->modificar();
                    if (!$respModificar) {
                        $exito = false;
                    }
                }
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null and $objCompraEstado->modificar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function aceptarCompra($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            // Busco el estadoCompra actual
            $arreglo = ["idcompra" => $param['idcompraestado']];
            $arrayBusqueda = ["idcompra" => $arreglo['idcompra']];
            $objCompraEstadoBusqueda = $this->buscar($arrayBusqueda);
            // Busco el estadoTipo de 'aceptada'
            $abmEstadoTipo = new AbmCompraEstadoTipo;
            $objCompraEstadoTipo = $abmEstadoTipo->buscar(['idcompraestadotipo' => 2]);
            // print_r($objCompraEstadoBusqueda);
            // Seteo el compraEstadoTipo 'aceptada'
            $objCompraEstadoBusqueda[0]->setIdCompraEstadoTipo($objCompraEstadoTipo[0]);
            // print_r($objCompraEstadoTipo[0]->getIdCompraEstadoTipo());
            // Si la compra no es nula y la fecha de fin de la compraEstado es igual a '0000-00-00 00:00:00' entonces hago la modificacion del estadoTipo

            if ($objCompraEstadoBusqueda != null and $objCompraEstadoBusqueda[0]->getCeFechaFin() == "0000-00-00 00:00:00") {
                if ($objCompraEstadoBusqueda[0]->modificar()) {
                    $resp = true;
                }
            }
        }

        return $resp;
    }

    public function enviarCompra($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            // Busco el estadoCompra actual
            $arreglo = ["idcompra" => $param['idcompraestado']];
            $arrayBusqueda = ["idcompra" => $arreglo['idcompra']];
            $objCompraEstadoBusqueda = $this->buscar($arrayBusqueda);
            // Busco el estadoTipo de 'aceptada'
            $abmEstadoTipo = new AbmCompraEstadoTipo;
            $objCompraEstadoTipo = $abmEstadoTipo->buscar(['idcompraestadotipo' => 3]);
            // Seteo el compraEstadoTipo 'aceptada'
            $objCompraEstadoBusqueda[0]->setIdCompraEstadoTipo($objCompraEstadoTipo[0]);
            // Si la compra no es nula y la fecha de fin de la compraEstado es igual a '0000-00-00 00:00:00' entonces hago la modificacion del estadoTipo
            if ($objCompraEstadoBusqueda != null and $objCompraEstadoBusqueda[0]->getCeFechaFin() == "0000-00-00 00:00:00") {
                $objCompraEstadoBusqueda[0]->setCeFechaFin(date("Y-m-d H:i:s"));
                if ($objCompraEstadoBusqueda[0]->modificar()) {
                    $resp = true;
                }
            }
        }

        return $resp;
    }

    public function finCompra($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = $this->cargarObjetoConClave($param);
            $listaCompraEstado = $objCompraEstado->listar("idcompraestado='" . $param['idcompraestado'] . "'");
            print_r($listaCompraEstado);
            if (count($listaCompraEstado) > 0) {
                $estadoCompra = $listaCompraEstado[0]->getCeFechaFin();
                if ($estadoCompra == '0000-00-00 00:00:00') {
                    $abmEstadoTipo = new AbmCompraEstadoTipo;
                    $objCompraEstadoTipo = $abmEstadoTipo->buscar(['idcompraestadotipo' => 4]);
                    // Seteo el compraEstadoTipo 'cancelada'
                    $listaCompraEstado[0]->setIdCompraEstadoTipo($objCompraEstadoTipo[0]);
                    if ($listaCompraEstado[0]->modificar()) {
                        $listaCompraEstado[0]->estado(date("Y-m-d H:i:s"));
                        $resp = true;
                    }
                }
            }
            if ($resp) {
                $abmCompraItem = new AbmCompraItem();
                $listadoItems = $abmCompraItem->buscar(['idcompra' => $param['idcompraestado']]);
                foreach ($listadoItems as $item) {
                    $abmProducto = new AbmProducto();
                    $objProducto = $item->getIdProducto();
                    $producto = $abmProducto->buscar(['idproducto' => $objProducto->getIdProducto()]);
                    $stockActual = $producto[0]->getProCantStock();
                    $stockActualizado = $stockActual + $item->getCiCantidad();
                    $producto[0]->setProStock($stockActualizado);
                    $vecesCompradoActual = $producto[0]->getProVecesComprado();
                    $vecesCompradoActualizado = $vecesCompradoActual - $item->getCiCantidad();
                    $producto[0]->setProVecesComprado($vecesCompradoActualizado);
                    $producto[0]->modificar();
                }
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";

        if ($param <> NULL) {
            if (isset($param['idcompraestado']))
                $where .= " and idcompraestado =" . $param['idcompraestado'];
            if (isset($param['idcompra']))
                $where .= " and idcompra =" . $param['idcompra'];
            if (isset($param['idcompraestadotipo']))
                $where .= " and idcompraestadotipo ='" . $param['idcompraestadotipo'] . "'";
            if (isset($param['cefechaini']))
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            if (isset($param['cefechafin']))
                $where .= " and cefechafin ='" . $param['cefechafin'] . "'";
        }
        $arreglo = CompraEstado::listar($where);

        return $arreglo;
    }
}
