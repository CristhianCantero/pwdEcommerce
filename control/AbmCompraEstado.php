<?php
class AbmCompraEstado
{
    private function cargarObjeto($param)
    {
        //print_r ($param);
        $obj = null;
        if (array_key_exists('idcompra', $param)) {
            //creo objeto estadotipos
            $objProducto = new Compra();
            $objProducto->setIdCompra($param['idcompra']);
            $objProducto->cargar();
            
            //creo objeto usuario
            $objCompraEstadoTipo = new CompraEstadoTipo();
            $objCompraEstadoTipo->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompraEstadoTipo->cargar();
            
            //agregarle los otros objetos
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
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraestado'] = null;
        $objCompraEstado = $this->cargarObjeto($param);
        //print_r($objCompraEstado);
        if ($objCompraEstado != null and $objCompraEstado->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /* public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraEstado = $this->cargarObjetoConClave($param);
            if ($objCompraEstado!=null and $objCompraEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    } */

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
            $arrayBusqueda = ["idcompraestado" => $param['idcompraestado']];
            $objCompraEstadoBusqueda = $this->buscar($arrayBusqueda);
            // Busco el estadoTipo de 'aceptada'
            $abmEstadoTipo = new AbmCompraEstadoTipo;
            $objCompraEstadoTipo = $abmEstadoTipo->buscar(['idcompraestadotipo' => 2]);
            // Seteo el compraEstadoTipo 'aceptada'
            $objCompraEstadoBusqueda[0]->setIdCompraEstadoTipo($objCompraEstadoTipo[0]);
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
            $arrayBusqueda = ["idcompraestado" => $param['idcompraestado']];
            $objCompraEstadoBusqueda = $this->buscar($arrayBusqueda);
            // Busco el estadoTipo de 'aceptada'
            $abmEstadoTipo = new AbmCompraEstadoTipo;
            $objCompraEstadoTipo = $abmEstadoTipo->buscar(['idcompraestadotipo' => 3]);
            // Seteo el compraEstadoTipo 'aceptada'
            $objCompraEstadoBusqueda[0]->setIdCompraEstadoTipo($objCompraEstadoTipo[0]);
            // Si la compra no es nula y la fecha de fin de la compraEstado es igual a '0000-00-00 00:00:00' entonces hago la modificacion del estadoTipo
            if ($objCompraEstadoBusqueda != null and $objCompraEstadoBusqueda[0]->getCeFechaFin() == "0000-00-00 00:00:00") {
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
            if (count($listaCompraEstado) > 0) {
                $estadoCompra = $listaCompraEstado[0]->getCeFechaFin();
                if ($estadoCompra == '0000-00-00 00:00:00') {
                    if ($listaCompraEstado[0]->estado(date("Y-m-d H:i:s"))) {
                        $resp = true;
                    }
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
