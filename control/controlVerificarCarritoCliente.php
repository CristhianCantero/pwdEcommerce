<?php
include_once '../../configuracion.php';

class controlVerificarCarritoCliente
{
    public function verificarCarrito($usuario){
        $carritoHabilitado = null;
        $abmCompra = new AbmCompra();
        $listadoCarritos = $abmCompra->buscar(["idusuario"=>$usuario]);
        $arrayCompras = [];

        foreach($listadoCarritos as $carrito){
            $compraEstadoCarrito = null;
            // Saco el id del carrito actual
            $idCarrito = $carrito->getIdCompra();
            // Busco el estado de la compra/carrito (si encuentra una es porque el usuario ya envio el carrito previamente, este carrito no puede ser utilizado)
            $abmCompraEstado = new AbmCompraEstado();
            $compraEstadoCarrito = $abmCompraEstado->buscar(['idcompra'=>$idCarrito]);
            if(!$compraEstadoCarrito){
                $carritoHabilitado = $carrito;
            }else{
                array_push($arrayCompras, $carrito);
            }
        }
        $arrayCarritos = ['carritoHabilitado'=>$carritoHabilitado, 'arrayCompras'=>$arrayCompras];
        return $arrayCarritos;
    }
}
