<?php
class AbmMenu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $objMenu = null;
        if (array_key_exists('menombre', $param) && array_key_exists('medescripcion', $param) && array_key_exists('idpadre', $param)) {
            $objMenu = new Menu();
            $objMenu->setear(
                '',
                $param['menombre'],
                $param['medescripcion'],
                $param['idpadre'],
                ''
            );
        }
        return $objMenu;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idmenu'])) {
            $obj = new Menu();
            $obj->setear($param['idmenu'], null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }

    /**
     * Carga un objeto con los datos pasados por parámetro y lo 
     * Inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $existe = false;
        $datosBusqueda['menombre'] = $param['menombre'];
        $listaMenu = $this->buscar($datosBusqueda);
        if (isset($listaMenu[0])) {
            $existe = true;
        }
        if(!$existe){
            $objMenu = $this->cargarObjeto($param);
            if ($objMenu->insertar()) {
                $resp = true;
            }
            $listaMenu = $this->buscar($datosBusqueda);
            $datos['idmenu'] = $listaMenu[0]->getIdMenu();
            $abmMenuRol = new AbmMenuRol();
            $datos['idrol'] = $datos['idpadre'];
            $abmMenuRol->alta($datos);
        }
        return $resp;
    }

    /**
     * Por lo general no se usa ya que se utiliza borrado lógico ( es decir pasar de activo a inactivo)
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu != null and $objMenu->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Carga un obj con los datos pasados por parámetro y lo modifica en base de datos (update)
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        $objMenu = new Menu();
        $objMenu->setear($param['idmenu'], $param['menombre'], $param['medescripcion'], $param['idpadre'], $param['medeshabilitado']);

        if ($objMenu->modificar()) {
            $resp = true;
        }

        return $resp;
    }

    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != NULL) {
            if (isset($param['idmenu']))
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
            if (isset($param['menombre']))
                $where .= " and menombre ='" . $param['menombre'] . "'";
            if (isset($param['medescripcion']))
                $where .= " and medescripcion ='" . $param['medescripcion'] . "'";
            if (isset($param['idpadre']))
                $where .= " and idpadre ='" . $param['idpadre'] . "'";
            if (isset($param['medeshabilitado']))
                $where .= " and medeshabilitado ='" . $param['medeshabilitado'] . "'";
        }
        $arreglo = Menu::listar($where);
        return $arreglo;
    }

    //Hace un borrado logico del menu. 
    //En caso de que ya estuviese deshabilitado, lo vuelve a habilitar.
    public function deshabilitarMenu($param)
    {
        $resp = false;
        $objMenu = $this->cargarObjetoConClave($param);
        $listadoMenus = $objMenu->listar("idmenu=" . $param['idmenu']);
        if (count($listadoMenus) > 0) {
            $estadoMenu = $listadoMenus[0]->getMeDeshabilitado();
            if ($estadoMenu == '0000-00-00 00:00:00') {
                if ($objMenu->estado(date("Y-m-d H:i:s"))) {
                    $resp = true;
                }
            } else {
                if ($objMenu->estado()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }
}
