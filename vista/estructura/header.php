<?php
include_once '../../configuracion.php';

$sesion = new Session();
$enlace = "";
// $datos = data_submitted();

if ($sesion->activa()) {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        $titulo = "MercadoPrivado";
        $user = $sesion->getUsuario();
        $iduser = $user->getIdUsuario();
        $name = $user->getUsNombre();
        $mail = $user->getUsMail();
        
        $abmUsuarioRol = new AbmUsuarioRol;
        $idRol = $abmUsuarioRol->buscarRolesUsuario($user);
        
        $abmMenuRol = new AbmMenuRol();
        $arrayMenusRol = $abmMenuRol->buscar(['idrol' => $idRol[0]]);
        if (count($arrayMenusRol) > 0) {
            $abmMenu = new AbmMenu();
            $idMenu = $arrayMenusRol[0]->getIdMenu()->getIdMenu();
            $arrayMenus = $abmMenu->buscar(["idmenu" => $idMenu]);
            if (count($arrayMenus) > 0) {
                $idPadre = $arrayMenus[0]->getIdMenu();
                $arraySubMenus = $abmMenu->buscar(["idpadre" => $idPadre]);
            }
        }
    } else {
        header('Location: ../home/index.php');
        exit();
    }
}
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
                        foreach ($arrayMenus as $menu) {
                    ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $menu->getMeNombre(); ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php
                                    // $enlace = "../";

                                    foreach ($arraySubMenus as $subMenu) {
                                        switch ($idRol[0]) {
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
                                    <?php $enlace = "";
                                    } ?>
                                </ul>
                            </li>
                    <?php
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
                                <a class="dropdown-item" href="../login/login.php"><span class="fas fa-sign-in-alt fa-fw" aria-hidden="true" title="Log in"></span>Entrar</a>
                                <a class="dropdown-item" href="../login/registrar.php"><span class="fas fa-pencil-alt fa-fw" aria-hidden="true" title="Sign up"></span>Registrarse</a>
                            </div>
                        </li>
                    <?php
                    } else { ?>
                        <!-- Usuario logeado -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <span class="d-lg-none">Usuario</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">
                                <!-- <li class="nav-item"></li> -->
                                <span class="" aria-hidden="true" title="Perfil"></span>&nbsp;<?php echo $idRol[0]; ?>
                                <a class="dropdown-item" href="../pages/perfil.php"><span class="fas fa-user fa-fw" aria-hidden="true" title="Perfil"></span>&nbsp;Perfil</a>
                                <a class="dropdown-item" href="../pages/configuracion.php"><span class="fas fa-cog fa-fw " aria-hidden="true" title="Configuración"></span>&nbsp;Configuración</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item logout" href="../login/logout.php"><span class="fas fa-sign-out-alt fa-fw" aria-hidden="true" title="Cerrar sesión"></span>&nbsp;Cerrar sesión</a>
                            </div>
                        </li>
                        <?php
                    }
                    if ($sesion->activa()) {
                        $cantRolesUsuario = count($idRol);
                        if ($cantRolesUsuario > 1) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Vistas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-id-badge"></i><span class="d-lg-none">Ver como...</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Vistas">
                                    <?php
                                    foreach ($idRol as $rol) {
                                        switch ($rol) {
                                            case '1':
                                                ?>
                                                <form method='post' action=''>
                                                    <input name='idrol' id='idrol' type='hidden' value='<?php echo $rol ?>'>
                                                    <button class='dropdown-item' type='submit' value='<?php echo $rol ?>' role='button'><span class="fas fa-users-cog" aria-hidden="true" title="Admin"></span>&nbsp;Admin</button>
                                                </form>
                                                <?php
                                                break;
                                            case '2':
                                                // echo '<a class="dropdown-item" href=""><span class="fas fa-tasks" aria-hidden="true" title="Configuración"></span>&nbsp;Manager Deposito</a>';
                                                ?>
                                                <form method='post' action=''>
                                                    <input name='idrol' id='idrol' type='hidden' value='<?php echo $rol ?>'>
                                                    <button class='dropdown-item' type='submit' value='<?php echo $rol ?>' role='button'><span class="fas fa-tasks" aria-hidden="true" title="ManagerDeposito"></span>&nbsp;Manager Deposito</button>
                                                </form>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <div class="dropdown-divider"></div>
                                                <form method='post' action=''>
                                                    <input name='idrol' id='idrol' type='hidden' value='<?php echo $rol ?>'>
                                                    <button class='dropdown-item' type='submit' value='<?php echo $rol ?>' role='button'><span class="fas fa-user" aria-hidden="true" title="Cliente"></span>&nbsp;Cliente</button>
                                                </form>
                                                <?php
                                                // echo '<a class="dropdown-item" href=""><span class="fas fa-user" aria-hidden="true" title="Cliente"></span>&nbsp;Cliente</a>';
                                                break;
                                        }
                                    }
                                    ?>
                                    <!-- <a class="dropdown-item" href="#"><span class="fas fa-users-cog" aria-hidden="true" title="Admin"></span>&nbsp;Admin</a>
                                    <a class="dropdown-item" href="#"><span class="fas fa-tasks" aria-hidden="true" title="Configuración"></span>&nbsp;Manager Deposito</a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="#"><span class="fas fa-user" aria-hidden="true" title="Cliente"></span>&nbsp;Cliente</a> -->
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        <!-- Vista de pagina con otro rol -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Vistas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-id-badge"></i><span class="d-lg-none">Ver como...</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Vistas">
                                <a class="dropdown-item" href="#"><span class="fas fa-users-cog" aria-hidden="true" title="Admin"></span>&nbsp;Admin</a>
                                <a class="dropdown-item" href="#"><span class="fas fa-tasks" aria-hidden="true" title="Configuración"></span>&nbsp;Manager Deposito</a>
                                <a class="dropdown-item" href="#"><span class="fas fa-people-carry" aria-hidden="true" title="Deposito"></span>&nbsp;Deposito</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#"><span class="fas fa-user" aria-hidden="true" title="Cliente"></span>&nbsp;Cliente</a>
                            </div>
                        </li> -->
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>