<?php
include_once '../../configuracion.php';

$sesion = new Session();

if($sesion->activa()){
    $user = $sesion->getUsuario();
    $name = $user->getUsNombre();
}
$enlace = "";
// $datos = data_submitted();

// if ($sesion->activa()) {
//     list($sesionValidar, $error) = $sesion->validar();
//     if ($sesionValidar) {
//         $titulo = "MercadoPrivado";
//         $user = $sesion->getUsuario();
//         $iduser = $user->getIdUsuario();
//         $name = $user->getUsNombre();
//         $mail = $user->getUsMail();

//         // $abmUsuarioRol = new AbmUsuarioRol;
//         // $idRol = $abmUsuarioRol->buscarRolesUsuario($user);
//         // $roles = $sesion->getUsRoles();
//         // $idRol = $roles[0];
//         // print_r($idRol);

//         // $abmMenuRol = new AbmMenuRol();
//         // $arrayMenusRol = $abmMenuRol->buscar(['idrol' => $idRol]);
//         // if (count($arrayMenusRol) > 0) {
//         //     $abmMenu = new AbmMenu();
//         //     $idMenu = $arrayMenusRol[0]->getIdMenu()->getIdMenu();
//         //     $arrayMenus = $abmMenu->buscar(["idmenu" => $idMenu]);
//         //     if (count($arrayMenus) > 0) {
//         //         $idPadre = $arrayMenus[0]->getIdMenu();
//         //         $arraySubMenus = $abmMenu->buscar(["idpadre" => $idPadre]);
//         //     }
//         // }
//     } else {
//         header('Location: ../home/index.php');
//         exit();
//     }
// }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap/boostrapValidator.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Cabecera redirect index php htdocs -->
    <title><?php echo $titulo ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#">MercadoPrivado</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="../home/index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../home/acerca.php">Acerca</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../cliente/listadoProductos.php">Todos los productos</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="../cliente/productosPopulares.php">Items Populares</a></li>
                            <li><a class="dropdown-item" href="../cliente/nuevosIngresos.php">Nuevos Ingresos</a></li>
                        </ul>
                    </li>
                    <?php
                    if ($sesion->activa()) {
                        $roles = $sesion->getUsRoles();
                        foreach ($sesion->getUsRoles() as $rol) {
                            $abmMenuRol = new AbmMenuRol();
                            $arrayMenusRol = $abmMenuRol->buscar(['idrol' => $rol]);

                            if (count($arrayMenusRol) > 0) {
                                $abmMenu = new AbmMenu();
                                $idMenu = $arrayMenusRol[0]->getIdMenu()->getIdMenu();
                                $arrayMenus = $abmMenu->buscar(["idmenu" => $idMenu]);
                                if (count($arrayMenus) > 0) {
                                    $idPadre = $arrayMenus[0]->getIdMenu();
                                    $arraySubMenus = $abmMenu->buscar(["idpadre" => $idPadre]);
                                }
                            }
                            foreach ($arrayMenus as $menu) {
                                if ($menu->getMeDeshabilitado() == "0000-00-00 00:00:00") {
                    ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $menu->getMeNombre(); ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <?php
                                            foreach ($arraySubMenus as $subMenu) {
                                                if ($subMenu->getMeDeshabilitado() == "0000-00-00 00:00:00") {
                                                    switch ($rol) {
                                                        case '1':
                                                            $enlace .= "../admin/";
                                                            break;
                                                        case '2':
                                                            $enlace .= "../managerDeposito/";
                                                            break;
                                                        case '3':
                                                            $enlace .= "../cliente/";
                                                            break;
                                                    }
                                            ?>
                                                    <li><a class="dropdown-item" href="<?php echo $enlace .= $subMenu->getMeDescripcion() . '.php' ?>"><?php echo $subMenu->getMeNombre(); ?></a></li>
                                            <?php
                                                    $enlace = "";
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </ul>
                <ul class="navbar-nav d-flex">
                    <!-- Icon carrito -->
                    <li class="nav-item">
                        <a class="nav-link" href="../cliente/carrito.php" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i> <span class="d-lg-none">Carrito</span><span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </a>
                    </li>

                    <?php
                    if (!$sesion->activa()) { ?>
                        <!-- Visitante -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Visitante" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sign-in-alt"></i><span class="d-lg-none">Usuario</span></a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Visitante">
                                <a class="dropdown-item" href="../login/login.php"><span class="fas fa-sign-in-alt fa-fw" aria-hidden="true" title="Log in"></span>&nbsp;Entrar</a>
                                <a class="dropdown-item" href="../login/registrar.php"><span class="fas fa-pencil-alt fa-fw" aria-hidden="true" title="Sign up"></span>&nbsp;Registrarse</a>
                            </div>
                        </li>
                    <?php
                    } else { ?>
                        <!-- Usuario logeado -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i><span class="">&nbsp;&nbsp;<?php echo $name ?></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">
                                <?php
                                switch ($roles[0]) {
                                    case 1: ?>
                                        <a class="dropdown-item" href="#">&nbsp;<span class="fas fa-user-tag" aria-hidden="true" title="Admin"></span>&nbsp;Admin</a>
                                    <?php
                                        break;
                                    case 2: ?>
                                        <a class="dropdown-item" href="#">&nbsp;<span class="fas fa-id-card-alt" aria-hidden="true" title="Manager Deposito"></span>&nbsp;Manager Deposito</a>
                                    <?php
                                        break;
                                    default: ?>
                                        <a class="dropdown-item" href="#">&nbsp;<span class="fas fa-id-card-alt" aria-hidden="true" title="Cliente"></span>&nbsp;Cliente</a>
                                <?php
                                        break;
                                }
                                ?>

                                <a class="dropdown-item" href="../pages/perfil.php"><span class="fas fa-user fa-fw" aria-hidden="true" title="Perfil"></span>&nbsp;Perfil</a>
                                <a class="dropdown-item" href="../pages/configuracion.php"><span class="fas fa-cog fa-fw " aria-hidden="true" title="Configuración"></span>&nbsp;Configuración</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item logout" href="../login/logout.php"><span class="fas fa-sign-out-alt fa-fw" aria-hidden="true" title="Cerrar sesión"></span>&nbsp;Cerrar sesión</a>
                            </div>
                        </li>
                        <?php
                        if ($roles[0] < 3) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-cog"></i> <span class="d-lg-none">Roles</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">

                                    <?php
                                    for ($i = 3; $i >= $roles[0]; $i--) {
                                        $idRolAction = md5($i);
                                        switch ($i) {
                                            case 1:
                                                $rol = "<span class='fas fa-user-shield'></span>&nbsp;Administrador";
                                                break;
                                            case 2:
                                                $rol = "<span class='fas fa-dolly'></span>&nbsp;Depósito";
                                                break;
                                            case 3:
                                                $rol = "<span class='fas fa-users'></span>&nbsp;Cliente";
                                                break;
                                        }
                                    ?>

                                        <a class="dropdown-item" href="../../control/controlCambioRoles.php?rol=<?php echo $idRolAction ?>"><?php echo $rol ?></a>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>