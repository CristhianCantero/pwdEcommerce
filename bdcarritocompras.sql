-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 06:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwd_tpfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(10, '2021-11-19 02:43:15', 1),
(11, '2021-11-19 02:45:20', 1),
(12, '2021-11-19 02:53:10', 1),
(13, '2021-11-19 02:54:14', 1),
(14, '2021-11-19 16:23:41', 6),
(15, '2021-11-19 18:45:14', 1),
(16, '2021-11-19 18:49:39', 1),
(17, '2021-11-19 18:50:04', 1),
(18, '2021-11-19 18:51:56', 1),
(19, '2021-11-20 00:33:52', 1),
(20, '2021-11-20 01:13:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT current_timestamp(),
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(10, 10, 4, '2021-11-19 02:43:16', '2021-11-19 06:45:09'),
(11, 11, 4, '2021-11-19 02:45:21', '2021-11-19 06:52:46'),
(12, 12, 4, '2021-11-19 02:53:12', '2021-11-19 06:53:16'),
(13, 13, 4, '2021-11-19 02:54:15', '2021-11-19 06:54:18'),
(14, 14, 4, '2021-11-19 16:24:38', '2021-11-19 22:50:36'),
(15, 15, 3, '2021-11-19 18:46:56', '2021-11-19 22:47:24'),
(16, 16, 4, '2021-11-19 18:49:41', '2021-11-19 22:49:55'),
(17, 17, 3, '2021-11-19 18:50:15', '2021-11-19 22:50:33'),
(18, 18, 2, '2021-11-19 18:51:57', '0000-00-00 00:00:00'),
(19, 19, 1, '2021-11-20 00:34:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Table structure for table `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` varchar(150) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compraitem`
--

INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
(18, 'CFF2015', 10, 1),
(19, 'GDIFF2015', 11, 1),
(20, 'PDIVWGT2014', 12, 1),
(21, 'PDIVWGT2014', 13, 1),
(22, 'GDIFF2015', 14, 1),
(23, 'PDDVWGT2014', 15, 1),
(24, 'PDIVWGT2014', 15, 1),
(25, 'CFF2015', 16, 1),
(27, 'GDDFF2015', 18, 1),
(28, 'CVWGT2014', 19, 1),
(34, 'CFF2015', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(1, 'Administración', '#', NULL, '0000-00-00 00:00:00'),
(2, 'Depósito', '#', NULL, '0000-00-00 00:00:00'),
(3, 'Cliente', '#', NULL, '0000-00-00 00:00:00'),
(4, 'Listado de usuarios', 'administrarUsuarios', 1, '0000-00-00 00:00:00'),
(5, 'Administrar Menus', 'administrarMenus', 1, '0000-00-00 00:00:00'),
(6, 'Administrar Compras', 'administrarCompras', 2, '0000-00-00 00:00:00'),
(7, 'Administrar Productos', 'administrarProductos', 2, '0000-00-00 00:00:00'),
(8, 'Cargar Producto', 'nuevoProducto', 2, '0000-00-00 00:00:00'),
(9, 'Administrar Compras', 'compras', 3, '0000-00-00 00:00:00'),
(10, 'Nuevo Menú', 'nuevoMenu', 1, '0000-00-00 00:00:00'),
(11, 'Nuevo Usuario', 'nuevoUsuario', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menurol`
--

CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menurol`
--

INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idproducto` varchar(150) NOT NULL,
  `proingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `proprecio` bigint(20) NOT NULL,
  `prodescuento` int(20) DEFAULT NULL,
  `pronombre` varchar(150) NOT NULL,
  `prodetalle` varchar(512) NOT NULL,
  `provecescomprado` int(20) DEFAULT NULL,
  `procantstock` int(11) NOT NULL,
  `prodeshabilitado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idproducto`, `proingreso`, `proprecio`, `prodescuento`, `pronombre`, `prodetalle`, `provecescomprado`, `procantstock`, `prodeshabilitado`) VALUES
('CCC2016', '2021-11-25 17:26:56', 8000, 0, 'Capot', 'Chevrolet Cruze 2016', 0, 5, '0000-00-00 00:00:00'),
('CFF2015', '2021-11-20 22:54:14', 12590, 15, 'Capot', 'Ford Focus 2015', 11, 1, '0000-00-00 00:00:00'),
('CVWGT2014', '2021-11-15 17:43:22', 14300, 0, 'Capot', 'Volkswagen Gol Trend 2014', 0, 5, '0000-00-00 00:00:00'),
('CVWP2017', '2021-11-25 17:43:52', 6500, 0, 'Capot', 'Volkswagen Polo 2017', 0, 4, '0000-00-00 00:00:00'),
('FTE2013', '2021-11-25 17:48:01', 11000, 0, 'Frente', 'Toyota Etios 2013', 0, 4, '0000-00-00 00:00:00'),
('GDDCC2016', '2021-11-25 17:28:08', 6500, 0, 'Guardabarro Delantero Derecho', 'Chevrolet Cruze 2016', 0, 6, '0000-00-00 00:00:00'),
('GDDFF2015', '2021-11-15 17:43:22', 5300, 0, 'Guardabarro Delantero Derecho', 'Ford Focus 2015', 0, 7, '0000-00-00 00:00:00'),
('GDDVWGT2014', '2021-11-18 18:30:07', 8400, 20, 'Guardabarro Delantero Derecho', 'Volkswagen Gol Trend 2014', 0, 7, '0000-00-00 00:00:00'),
('GDDVWP2017', '2021-11-25 17:45:09', 7500, 0, 'Guardabarro Delantero Derecho', 'Volkswagen Polo 2017', 0, 5, '0000-00-00 00:00:00'),
('GDICC2016', '2021-11-25 17:28:50', 6500, 0, 'Guardabarro Delantero Izquierdo', 'Chevrolet Cruze 2016', 0, 8, '0000-00-00 00:00:00'),
('GDIFF2015', '2021-11-15 17:43:22', 5300, 0, 'Guardabarro Delantero Izquierdo', 'Ford Focus 2015', 0, 7, '0000-00-00 00:00:00'),
('GDIVWGT2014', '2021-11-18 18:30:05', 8400, 20, 'Guardabarro Delantero Izquierdo', 'Volkswagen Gol Trend 2014', 0, 7, '0000-00-00 00:00:00'),
('GDIVWP2017', '2021-11-25 17:44:44', 7500, 0, 'Guardabarro Delantero Izquierdo', 'Volkswagen Polo 2017', 0, 6, '0000-00-00 00:00:00'),
('OPTDDVWP2017', '2021-11-25 17:47:13', 13000, 5, 'Óptica Delantera Derecha', 'Volkswagen Polo 2017', 0, 5, '0000-00-00 00:00:00'),
('OPTDIVWP2017', '2021-11-25 17:46:39', 13000, 5, 'Óptica Delantera Izquierda', 'Volkswagen Polo 2017', 0, 4, '0000-00-00 00:00:00'),
('PDCC2016', '2021-11-25 17:25:45', 5000, 0, 'Paragolpe Delantero', 'Chevrolet Cruze 2016', 0, 8, '0000-00-00 00:00:00'),
('PDDCC2016', '2021-11-25 17:42:16', 9000, 0, 'Puerta Delantera Derecha', 'Chevrolet Cruze 2016', 0, 5, '0000-00-00 00:00:00'),
('PDDVWGT2014', '2021-11-15 17:43:22', 18700, 0, 'Puerta Delantera Derecha', 'Volkswagen Gol Trend 2014', 0, 3, '0000-00-00 00:00:00'),
('PDICC2016', '2021-11-25 17:42:51', 9000, 0, 'Puerta Delantera Izquierda', 'Chevrolet Cruze 2016', 0, 5, '0000-00-00 00:00:00'),
('PDIVWGT2014', '2021-11-19 16:22:29', 18700, 0, 'Puerta Delantera Izquierda', 'Volkswagen Gol Trend 2014', 0, 3, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `rodescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'Admin'),
(2, 'Manager Deposito'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `usnombre` varchar(150) NOT NULL,
  `uspass` varchar(150) NOT NULL,
  `usmail` varchar(150) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'JuanmaGonzalez', 'd663148d38fc201d1df5e4d4e2371fec', 'juanma@gmail.com', '0000-00-00 00:00:00'),
(2, 'CristhianCantero', '18caba35d8c174f20484860ec41974cf', 'criis2021@gmail.com', '0000-00-00 00:00:00'),
(3, 'RoGalecio', 'ccb49a37f7900db9fb1d2e06bfcd2aa6', 'rogalecio@gmail.com', '0000-00-00 00:00:00'),
(4, 'RuFus', '0b2bd24ba2b5fcf1f05e75e042fa87ef', 'rufus2021@gmail.com', '0000-00-00 00:00:00'),
(5, 'PepPerez', '04c119ea51fb165c4cfa1d27a069cb96', 'pepito450@gmail.com', '0000-00-00 00:00:00'),
(6, 'JuanCarlos', '9bf988e530e44a1ab4b18b6cb2622e1d', 'juancarlos3000@gmail.com', '0000-00-00 00:00:00'),
(13, 'Carlito', 'bc19efe522045b3f5654f9d2bb595a4b', 'carlito@gmail.com', '0000-00-00 00:00:00'),
(14, 'Claudio', 'b18cc3fe5cd4a1cd656df7180103a657', 'elgalloclaudio@gmail.com', '0000-00-00 00:00:00'),
(15, 'Holis', '401518eee35b49f00bc0a3ab74c4915e', 'holis@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuariorol`
--

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(13, 3),
(14, 3),
(15, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- Indexes for table `compraestado`
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- Indexes for table `compraestadotipo`
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

--
-- Indexes for table `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

--
-- Indexes for table `menurol`
--
ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indexes for table `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `compraestado`
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `compraitem`
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
