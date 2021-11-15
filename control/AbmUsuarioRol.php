<?php
class AbmUsuarioRol
{

    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idusuario', $param) and array_key_exists('idrol', $param)) {
            $objusuario = new Usuario();
            $objusuario->setIdUsuario($param['idusuario']);
            $objusuario->cargar();

            $objrol = new Rol();
            $objrol->setIdRol($param['idrol']);
            $objrol->cargar();

            $obj = new UsuarioRol();
            $obj->setear($objusuario, $objrol);
        }
        return $obj;
    }


    //Definir como se va a cargar el objeto y asignar las claves de lo que hace falta
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param[''])) {
            $obj = new UsuarioRol();
            $obj->setear($param[''], null, null,);
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
        if (isset($param['idusuario']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }


    /**
     * Carga un objeto con los datos pasados por parámetro y lo 
     * Inserta en la base de datos
     * @param array $param= idusuario/idrol
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        //Creo objeto con los datos
        $obj = $this->cargarObjeto($param);
        //Verifico que el objeto no sea nulo y lo inserto en BD 
        if ($obj != null and $obj->insertar()) {
            $resp = true;
        }
        return $resp;
    }


    /**
     * Por lo general no se usa ya que se utiliza borrado lógico (es decir pasar de activo a inactivo)
     * Permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjetoConClave($param);
            if ($objUsuarioRol != null and $objUsuarioRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * Permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idusuario']))
                $where .= " and idusuario =" . $param['idusuario'];
            if (isset($param['idrol']))
                $where .= " and idrol =" . $param['idrol'];
        }
        $arreglo = UsuarioRol::listar($where);

        return $arreglo;
    }


    /** 
     * Busca todos los usuariorol correspondientes a un objusuario
     * Lista todos los roles que tiene el usuario
     * @param object
     * @return array devuelve las descripciones de cada rol de dicho usuario
     */
    public function buscarRolesUsuario($objUsuario)
    {
        $listaUsRol = [];
        //Listo todos los obj usuariorol
        $listaUsRol = $this->buscar(null);

        if ($listaUsRol != "") {
            $roles = [];
            //Agrego todos los roles que tenga el usuario en el array $roles
            foreach ($listaUsRol as $usuariorol) {
                if ($usuariorol->getObjUsuario()->getIdUsuario() == $objUsuario->getIdUsuario()) {
                    $rolid = $usuariorol->getObjRol()->getIdRol();
                    array_push($roles, $rolid);
                }
            }
        }
        return $roles;
    }
}
