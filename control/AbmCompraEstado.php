<?php
class AbmCompraEstado
{
    private function cargarObjeto($param)
    {
        //print_r ($param);
        $obj = null;
        if (
            array_key_exists('idcompraestadotipoestado', $param) and array_key_exists('idcompra', $param)
            and array_key_exists('idcompraestadotipo', $param) and array_key_exists('cefechaini', $param)
            and array_key_exists('cefechafin', $param)
        ) {

            //creo objeto estadotipos
            $objProducto = new Compra();
            $objProducto->getIdCompra($param['idcompra']);
            $objProducto->cargar();

            //creo objeto usuario
            $objCompra = new CompraEstadoTipo();
            $objCompra->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objCompra->cargar();

            //agregarle los otros objetos
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestadotipoestado'], $objProducto, $objCompra, $param['cefechaini'], $param['cefechafin']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestadotipoestado'])) {
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestadotipoestado'], null, null, null, null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraestadotipoestado']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraestadotipoestado'] = null;
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
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null and $objCompraEstado->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idcompraestadotipoestado']))
                $where .= " and idcompraestadotipoestado =" . $param['idcompraestadotipoestado'];
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
