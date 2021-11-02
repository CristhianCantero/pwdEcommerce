<?php
class AbmUsuario {
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            }

            if (isset($param['usnombre'])) {
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            }

            if (isset($param['uspass'])) {
                $where .= " and uspass ='" . $param['uspass'] . "'";
            }

            if (isset($param['usmail'])) {
                $where .= " and usmail ='" . $param['usmail'] . "'";
            }
            if (isset($param['usdeshabilitado'])) {
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
            }

        }
        $arreglo = Usuario::seleccionar($where);
        return $arreglo;
    }

    public function modificacion($param){
        $resp = false;
        $objUs= new Usuario();
        $pass=md5($param['uspass']);
        $objUs->setear($param['idusuario'],$param['usnombre'],$pass,$param['usmail'],$param['usdeshabilitado']);
        if ($objUs->modificar()){
            $resp=true;
        }
        return $resp;
    }

    //Hace un borrado logico del usuario. 
    //En caso de que ya estuviese deshabilitado, lo vuelve a habilitar.
    public function baja ($param){
        $resp=false;
        $objUs=new Usuario();
        $objUs->setear($param['idusuario'],"","","","");
        $arreglo=$objUs->seleccionar("idusuario= ".$param['idusuario']);
        if (count($arreglo)==1){
            $estado=$arreglo[0]->getUsdeshabilitado();
            if ($estado=="0000-00-00 00:00:00"){
                if ($objUs->estado(date("Y-m-d H:i:s"))){
                    $resp=true;
                }
            }else{
                if ($objUs->estado()){
                    $resp=true;
                }
            }
        }
        
        return $resp;
    }
}
?>