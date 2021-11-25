<?php
class AbmCompraItem
{
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idproducto', $param) && array_key_exists('idcompra', $param)) {
            $objProducto = new Producto();
            $objProducto->setIdProducto($param['idproducto']);
            $objProducto->cargar();

            $objCompra = new Compra();
            $objCompra->setIdCompra($param['idcompra']);
            $objCompra->cargar();

            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'], $objProducto, $objCompra, $param['cicantidad']);
        }

        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraitem'])) {
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'], null, null, null);
        }

        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompraitem'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraitem'] = null;
        $objCompraItem = $this->cargarObjeto($param);
        //print_r($objCompraItem);
        if ($objCompraItem != null and $objCompraItem->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjetoConClave($param);
            if ($objCompraItem != null and $objCompraItem->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjeto($param);
            if ($objCompraItem != null and $objCompraItem->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function sumarItem($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjetoConClave($param);
            $objCompraItem = $this->buscar(['idcompraitem' => $param['idcompraitem']]);
            if ($objCompraItem[0] != null) {
                $cantItems = $objCompraItem[0]->getCiCantidad();
                $objCompraItem[0]->setCiCantidad($cantItems + 1);
                if ($objCompraItem[0]->modificar()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    public function restarItem($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjetoConClave($param);
            $objCompraItem = $this->buscar(['idcompraitem' => $param['idcompraitem']]);
            if ($objCompraItem[0] != null) {
                $cantItems = $objCompraItem[0]->getCiCantidad();
                if ($cantItems > 1) {
                    $objCompraItem[0]->setCiCantidad($cantItems - 1);
                    if ($objCompraItem[0]->modificar()) {
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
            if (isset($param['idcompraitem']))
                $where .= " and idcompraitem =" . $param['idcompraitem'];
            if (isset($param['idproducto']))
                $where .= " and idproducto =" . $param['idproducto'];
            if (isset($param['idcompra']))
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            if (isset($param['cicantidad']))
                $where .= " and cicantidad ='" . $param['cicantidad'] . "'";
        }
        $arreglo = CompraItem::listar($where);
        return $arreglo;
    }
}
