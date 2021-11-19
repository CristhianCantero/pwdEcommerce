<?php
include_once '../../configuracion.php';

$titulo = 'Administración de Compras';

$datos = data_submitted();

if (!isset($datos["verificado"])) {
    $controlIngresoManagerDeposito = new controlIngresoManagerDeposito();
    $controlIngresoManagerDeposito->verificarIngreso("administrarCompras");
}
include_once '../estructura/header.php';

$abmComprasIniciadas = new AbmCompraEstado();
$listaComprasIniciadas = $abmComprasIniciadas->buscar(null);

?>
<header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h4>Listado de Compras</h4>
        </div>
    </div>
</header>

<div class="container mt-2">
    <section class="py-2">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class='table align-middle'>
                    <thead class='table-dark'>
                        <tr class='align-middle'>
                            <th scope='col' class='text-center'>ID Compra</th>
                            <th scope='col' class='text-center'>Usuario</th>
                            <th scope='col' class='text-center'>Estado</th>
                            <th scope='col' class='text-center'>Fecha Inicio Compra</th>
                            <th scope='col' class='text-center'>Fecha Fin Compra</th>
                            <th scope='col' class='text-center'></th>
                            <th scope='col' class='text-center'></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (count($listaComprasIniciadas) > 0) {
                            foreach ($listaComprasIniciadas as $compra) {
                                $objCompra = $compra->getIdCompra();
                                $idCompra = $objCompra->getIdCompra();
                                $idCompraEstado = $compra->getIdCompraEstado();
                                $objCliente = $objCompra->getIdUsuario();
                        ?>
                                <tr>
                                    <td class='text-center'><?php echo $idCompra ?></td>
                                    <?php
                                    $idEstadoCompraTipo = $compra->getIdCompraEstadoTipo()->getIdCompraEstadoTipo();
                                    switch ($idEstadoCompraTipo) {
                                        case '2':
                                            $estadoCompra = '<span class="badge rounded-pill bg-warning text-dark">Aceptada</span>';
                                            break;
                                        case '3':
                                            $estadoCompra = '<span class="badge rounded-pill bg-success">Enviada</span>';
                                            break;
                                        case '4':
                                            $estadoCompra = '<span class="badge rounded-pill bg-danger">Cancelada</span>';
                                            break;
                                        default:
                                            $estadoCompra = '<span class="badge rounded-pill bg-primary">Iniciada</span>';
                                            break;
                                    }
                                    ?>
                                    <td class='text-center'><?php echo $objCliente->getUsNombre() ?></td>
                                    <td class='text-center'><?php echo $estadoCompra ?></td>
                                    <td class='text-center'><?php echo $compra->getCeFechaIni() ?></td>
                                    <?php
                                    $fechaFin = $compra->getCeFechaFin();
                                    if ($fechaFin == null) {
                                        $fechaFin = "";
                                    }
                                    ?>
                                    <td class='text-center'><?php echo $fechaFin ?></td>
                                    <?php
                                    if ($idEstadoCompraTipo == 1) {
                                    ?>
                                        <form method='post' action='../acciones/accionAceptarCompra.php'>
                                            <td class='text-center'>
                                                <input name='idcompraestado' id='idcompraestado' type='hidden' value='<?php echo $idCompra ?>'>
                                                <button class='btn btn-warning btn-sm' type='submit' role='button'><i class='bi bi-cart-check-fill'></i>&nbsp;Aceptar</button>
                                            </td>
                                        </form>
                                    <?php
                                    } else if ($idEstadoCompraTipo == 2) {
                                    ?>
                                        <form method='post' action='../acciones/accionEnviarCompra.php'>
                                            <td class='text-center'>
                                                <input name='idcompraestado' id='idcompraestado' type='hidden' value='<?php echo $idCompra ?>'>
                                                <button class='btn btn-warning btn-sm' type='submit' role='button'><i class='fas fa-shipping-fast'></i>&nbsp;Enviar</button>
                                            </td>
                                        </form>
                                    <?php
                                    } else { ?>
                                        <td class='text-center'></td>
                                    <?php
                                    }

                                    if ($idEstadoCompraTipo == 1 || $idEstadoCompraTipo == 2) { ?>
                                        <form method='post' action='../acciones/accionFinCompra.php'>
                                            <td class='text-center'>
                                                <input name='idcompraestado' id='idcompraestado' type='hidden' value='<?php echo $idCompra ?>'>
                                                <button class='btn btn-danger btn-sm' type='submit' role='button'><i class='bi bi-cart-x'></i>&nbsp;Cancelar</button>
                                            </td>
                                        </form>
                                    <?php
                                    } else { ?>
                                        <td class='text-center'></td>
                            <?php
                                    }
                                }
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php

include_once '../estructura/footer.php';

?>