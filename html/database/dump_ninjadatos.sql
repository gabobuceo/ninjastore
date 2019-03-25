-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2019 a las 00:28:00
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ninjadatos`
--
CREATE DATABASE IF NOT EXISTS `ninjadatos` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `ninjadatos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `TITULO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PADRE` bigint(20) UNSIGNED DEFAULT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID`, `TITULO`, `PADRE`, `BAJA`) VALUES
(1, 'Categorias Padre', NULL, 0),
(2, 'Accesorios para Vehículos', 1, 0),
(3, 'Accesorios Autos y Camionetas', 2, 0),
(4, 'Accesorios para Motos', 2, 0),
(5, 'Audio para Autos', 2, 0),
(6, 'Llantas', 2, 0),
(7, 'Neumáticos', 2, 0),
(8, 'Repuestos Autos y Camionetas', 2, 0),
(9, 'Repuestos para Motos', 2, 0),
(10, 'Service Programado', 2, 0),
(11, 'Tuning', 2, 0),
(12, 'Alimentos y Bebidas', 1, 0),
(13, 'Bebidas Alcohólicas', 12, 0),
(14, 'Bebidas Analcohólicas', 12, 0),
(15, 'Comestibles', 12, 0),
(16, 'Animales y Mascotas', 1, 0),
(17, 'Aves', 16, 0),
(18, 'Conejos', 16, 0),
(19, 'Equinos', 16, 0),
(20, 'Gatos', 16, 0),
(21, 'Libros y Manuales de Animales', 16, 0),
(22, 'Peces', 16, 0),
(23, 'Perros', 16, 0),
(24, 'Roedores', 16, 0),
(25, 'Arte y Antigüedades', 1, 0),
(26, 'Adornos de Vitrina', 25, 0),
(27, 'Antigüedades', 25, 0),
(28, 'Artesanías', 25, 0),
(29, 'Cristal y Vidrio', 25, 0),
(30, 'Cuadros y Láminas', 25, 0),
(31, 'Filatelia', 25, 0),
(32, 'Juguetes Antiguos', 25, 0),
(33, 'Autos, Motos y Otros', 1, 0),
(34, 'Autos de Colección', 33, 0),
(35, 'Autos y Camionetas', 33, 0),
(36, 'Camiones', 33, 0),
(37, 'Maquinaria Agrícola', 33, 0),
(38, 'Maquinaria de Construcción', 33, 0),
(39, 'Motos', 33, 0),
(40, 'Náutica', 33, 0),
(41, 'Bebés', 1, 0),
(42, 'Andadores y Vehículos de Bebés', 41, 0),
(43, 'Artículos de Bebés para Baño', 41, 0),
(44, 'Artículos para Maternidad', 41, 0),
(45, 'Chupetes y Mordillos', 41, 0),
(46, 'Comida para Bebés', 41, 0),
(47, 'Corralitos', 41, 0),
(48, 'Cuarto del Bebé', 41, 0),
(49, 'Higiene y Cuidado del Bebé', 41, 0),
(50, 'Juegos y Juguetes para Bebés', 41, 0),
(51, 'Lactancia y Alimentación', 41, 0),
(52, 'Paseo del Bebé', 41, 0),
(53, 'Ropa y Calzado para Bebés', 41, 0),
(54, 'Salud del Bebé', 41, 0),
(55, 'Seguridad para Bebés', 41, 0),
(56, 'Cámaras y Accesorios', 1, 0),
(57, 'Accesorios para Cámaras', 56, 0),
(58, 'Baterías, Cargadores y Pilas', 56, 0),
(59, 'Cámaras Analógicas', 56, 0),
(60, 'Cámaras Antiguas o Colección', 56, 0),
(61, 'Cámaras Digitales', 56, 0),
(62, 'Cámaras Instantáneas', 56, 0),
(63, 'Laboratorios y Mini Labs', 56, 0),
(64, 'Memorias Digitales', 56, 0),
(65, 'Telescopios y Binoculares', 56, 0),
(66, 'Video Cámaras', 56, 0),
(67, 'Celulares y Telefonía', 56, 0),
(68, 'Accesorios para Celulares', 56, 0),
(69, 'Celulares y Smartphones', 1, 0),
(70, 'Handies', 69, 0),
(71, 'Radiofrecuencia', 69, 0),
(72, 'Repuestos para Celulares', 69, 0),
(73, 'Smartband', 69, 0),
(74, 'Smartwatch', 69, 0),
(75, 'Telefonía Fija', 69, 0),
(76, 'Teléfonos Inalámbricos', 69, 0),
(77, 'Coleccionables', 1, 0),
(78, 'Afiches, Posters y Carteles', 77, 0),
(79, 'Animé', 77, 0),
(80, 'Colecciones Diversas', 77, 0),
(81, 'Encendedores y Fósforos', 77, 0),
(82, 'Filatelia', 77, 0),
(83, 'Historietas y Comics', 77, 0),
(84, 'Latas, Botellas y Afines', 77, 0),
(85, 'Militaria y Afines', 77, 0),
(86, 'Modelismo', 77, 0),
(87, 'Monedas y Billetes', 77, 0),
(88, 'Muñecos y Accesorios', 77, 0),
(89, 'Papeles Impresos y Afines', 77, 0),
(90, 'Tarjetas Telefónicas', 77, 0),
(91, 'Computación', 1, 0),
(92, 'Apple', 91, 0),
(93, 'Cartuchos, Toner y Papeles', 91, 0),
(94, 'CDs y DVDs Vírgenes', 91, 0),
(95, 'Computadoras y Servidores', 91, 0),
(96, 'Discos Rígidos y Removibles', 91, 0),
(97, 'Fuentes y UPS', 91, 0),
(98, 'Gabinetes', 91, 0),
(99, 'Grabadoras de CDs y DVDs', 91, 0),
(100, 'Impresoras y Repuestos', 91, 0),
(101, 'iPad y Tablets', 91, 0),
(102, 'Memorias RAM', 91, 0),
(103, 'Monitores y Proyectores', 91, 0),
(104, 'Motherboards', 91, 0),
(105, 'Mouses', 91, 0),
(106, 'Multimedia', 91, 0),
(107, 'Netbooks y Accesorios', 91, 0),
(108, 'Notebooks y Accesorios', 91, 0),
(109, 'Palmtops y Handhelds', 91, 0),
(110, 'Pen Drives', 91, 0),
(111, 'Periféricos y Accesorios de PC', 91, 0),
(112, 'Placas de Video y Editoras', 91, 0),
(113, 'Procesadores', 91, 0),
(114, 'Redes', 91, 0),
(115, 'Resistencias', 91, 0),
(116, 'Scanners', 91, 0),
(117, 'Software', 91, 0),
(118, 'Consolas y Videojuegos', 1, 0),
(119, 'Juegos para PC', 118, 0),
(120, 'Lentes de Realidad Virtual', 118, 0),
(121, 'Maquinitas', 118, 0),
(122, 'Nintendo', 118, 0),
(123, 'PlayStation', 118, 0),
(124, 'Sega', 118, 0),
(125, 'Xbox', 118, 0),
(126, 'Deportes y Fitness', 1, 0),
(127, 'Acuáticos', 126, 0),
(128, 'Aerobics y Fitness', 126, 0),
(129, 'Artes Marciales', 126, 0),
(130, 'Básquetbol', 126, 0),
(131, 'Bicicletas y Ciclismo', 126, 0),
(132, 'Billar y Pool', 126, 0),
(133, 'Boxeo', 126, 0),
(134, 'Calzado', 126, 0),
(135, 'Camping', 126, 0),
(136, 'Extremos', 126, 0),
(137, 'Fútbol', 126, 0),
(138, 'Golf', 126, 0),
(139, 'Hockey', 126, 0),
(140, 'Lentes Deportivos y de Sol', 126, 0),
(141, 'Patín', 126, 0),
(142, 'Pesca', 126, 0),
(143, 'Rugby', 126, 0),
(144, 'Skateboarding', 126, 0),
(145, 'Suplementos Alimenticios', 126, 0),
(146, 'Tenis y Paddle', 126, 0),
(147, 'Electrodomésticos y Aires Ac.', 1, 0),
(148, 'Artefactos para el Hogar', 147, 0),
(149, 'Calefones y Termotanques', 147, 0),
(150, 'Campanas y Extractores', 147, 0),
(151, 'Climatización', 147, 0),
(152, 'Cocción', 147, 0),
(153, 'Cuidado Personal', 147, 0),
(154, 'Electrodomésticos de Cocina', 147, 0),
(155, 'Lavado y Secado de Ropa', 147, 0),
(156, 'Lavavajillas', 147, 0),
(157, 'Máquinas de Coser', 147, 0),
(158, 'Microondas y Repuestos', 147, 0),
(159, 'Refrigeración', 147, 0),
(160, 'Electrónica, Audio y Video', 1, 0),
(161, 'Accesorios para Audio y Video', 160, 0),
(162, 'Audio para Autos', 160, 0),
(163, 'Audio para el Hogar', 160, 0),
(164, 'Audio Portable', 160, 0),
(165, 'Audio Profesional y DJs', 160, 0),
(166, 'Calculadoras y Agendas', 160, 0),
(167, 'Drones', 160, 0),
(168, 'DVD y Video', 160, 0),
(169, 'Fotocopiadoras', 160, 0),
(170, 'GPS', 160, 0),
(171, 'iPod', 160, 0),
(172, 'MP3, MP4 y MP5 Players', 160, 0),
(173, 'Pilas, Baterías y Cargadores', 160, 0),
(174, 'Proyectores y Pantallas', 160, 0),
(175, 'Seguridad y Vigilancia', 160, 0),
(176, 'Televisores', 160, 0),
(177, 'Video Cámaras', 160, 0),
(178, 'Herramientas y Construcción', 1, 0),
(179, 'Construcción', 178, 0),
(180, 'Herramientas', 178, 0),
(181, 'Mobiliario para Baños', 178, 0),
(182, 'Mobiliario para Cocinas', 178, 0),
(183, 'Pisos, Paredes y Aberturas', 178, 0),
(184, 'Hogar, Muebles y Jardín', 1, 0),
(185, 'Baño', 184, 0),
(186, 'Cocina y Bazar', 184, 0),
(187, 'Comedor', 184, 0),
(188, 'Decoración', 184, 0),
(189, 'Dormitorio', 184, 0),
(190, 'Escritorio', 184, 0),
(191, 'Iluminación para el Hogar', 184, 0),
(192, 'Jardín y Exterior', 184, 0),
(193, 'Lavadero y Limpieza', 184, 0),
(194, 'Living', 184, 0),
(195, 'Industrias y Oficinas', 1, 0),
(196, 'Equipamiento para Oficinas', 195, 0),
(197, 'Industria Agrícola', 195, 0),
(198, 'Industria Automotriz', 195, 0),
(199, 'Industria Gastronómica', 195, 0),
(200, 'Industria Textil', 195, 0),
(201, 'Seguridad Industrial', 195, 0),
(202, 'Tanques y Contenedores', 195, 0),
(203, 'Inmuebles', 1, 0),
(204, 'Apartamentos', 203, 0),
(205, 'Campos', 203, 0),
(206, 'Casas', 203, 0),
(207, 'Cocheras', 203, 0),
(208, 'Habitaciones', 203, 0),
(209, 'Llave de Negocio', 203, 0),
(210, 'Locales', 203, 0),
(211, 'Oficinas', 203, 0),
(212, 'Quintas', 203, 0),
(213, 'Terrenos', 203, 0),
(214, 'Instrumentos Musicales', 1, 0),
(215, 'Amplificadores', 214, 0),
(216, 'Bajos', 214, 0),
(217, 'Baterías y Percusión', 214, 0),
(218, 'Consolas de Sonido', 214, 0),
(219, 'Efectos de Sonido', 214, 0),
(220, 'Guitarras', 214, 0),
(221, 'Instrumentos de Cuerda', 214, 0),
(222, 'Instrumentos de Viento', 214, 0),
(223, 'Micrófonos', 214, 0),
(224, 'Parlantes', 214, 0),
(225, 'Teclados, Pianos y Órganos', 214, 0),
(226, 'Joyas y Relojes', 1, 0),
(227, 'Joyas', 226, 0),
(228, 'Relojes', 226, 0),
(229, 'Juegos y Juguetes', 1, 0),
(230, 'Autos de Juguete', 229, 0),
(231, 'Disfraces y Cotillón', 229, 0),
(232, 'Juegos de Aire Libre y Agua', 229, 0),
(233, 'Juegos de Mesa', 229, 0),
(234, 'Juegos de Salón', 229, 0),
(235, 'Juegos Electrónicos', 229, 0),
(236, 'Juguetes', 229, 0),
(237, 'Muñecas y Accesorios', 229, 0),
(238, 'Muñecos y Accesorios', 229, 0),
(239, 'Vehículos para Niños', 229, 0),
(240, 'Música, Libros y Películas', 1, 0),
(241, 'Libros', 240, 0),
(242, 'Música', 240, 0),
(243, 'Películas', 240, 0),
(244, 'Revistas', 240, 0),
(245, 'Series', 240, 0),
(246, 'Ropa, Calzados y Accesorios', 1, 0),
(247, 'Accesorios de Moda', 246, 0),
(248, 'Bermudas y Shorts', 246, 0),
(249, 'Blusas', 246, 0),
(250, 'Buzos y Canguros', 246, 0),
(251, 'Calzados', 246, 0),
(252, 'Calzas y Leggings', 246, 0),
(253, 'Camisas', 246, 0),
(254, 'Camperas', 246, 0),
(255, 'Carteras, Mochilas y Equipajes', 246, 0),
(256, 'Chalecos', 246, 0),
(257, 'Championes', 246, 0),
(258, 'Chaquetas y Blazers', 246, 0),
(259, 'Chombas', 246, 0),
(260, 'Enteritos', 246, 0),
(261, 'Gabardinas y Pilots', 246, 0),
(262, 'Lentes', 246, 0),
(263, 'Pantalones', 246, 0),
(264, 'Poleras y Polerones', 246, 0),
(265, 'Polleras', 246, 0),
(266, 'Ponchos', 246, 0),
(267, 'Remeras y Musculosas', 246, 0),
(268, 'Ropa Deportiva', 246, 0),
(269, 'Ropa Interior y De Dormir', 246, 0),
(270, 'Ropa y Calzado para Bebés', 246, 0),
(271, 'Saquitos', 246, 0),
(272, 'Sweaters y Cardigans', 246, 0),
(273, 'Tapados', 246, 0),
(274, 'Trajes', 246, 0),
(275, 'Trajes de Baño', 246, 0),
(276, 'Uniformes', 246, 0),
(277, 'Vestidos', 246, 0),
(278, 'Salud y Belleza', 1, 0),
(279, 'Cuidado de la Piel', 278, 0),
(280, 'Cuidado de la Salud', 278, 0),
(281, 'Cuidado de Manos', 278, 0),
(282, 'Cuidado del Cabello', 278, 0),
(283, 'Cuidado del Cuerpo', 278, 0),
(284, 'Maquillaje', 278, 0),
(285, 'Medicamentos', 278, 0),
(286, 'Perfumes y Fragancias', 278, 0),
(287, 'Vitaminas', 278, 0),
(288, 'Servicios', 1, 0),
(289, 'Belleza y Cuidado Personal', 288, 0),
(290, 'Clases y Cursos', 288, 0),
(291, 'Fiestas y Eventos', 288, 0),
(292, 'Hogar', 288, 0),
(293, 'Imprenta', 288, 0),
(294, 'Mantenimiento de Vehículos', 288, 0),
(295, 'Medicina y Salud', 288, 0),
(296, 'Mudanzas y Traslados', 288, 0),
(297, 'Oficios', 288, 0),
(298, 'Profesionales', 288, 0),
(299, 'Servicio Técnico', 288, 0),
(300, 'Servicios para Mascotas', 288, 0),
(301, 'Viajes y Turismo', 288, 0),
(302, 'Otras categorías', 1, 0),
(303, 'Adultos', 302, 0),
(304, 'Artículos de Mercería', 302, 0),
(305, 'Cumpleaños y Fiestas', 302, 0),
(306, 'Esoterismo', 302, 0),
(307, 'Fuegos Artificiales', 302, 0),
(308, 'Productos para Tatuajes', 302, 0),
(309, 'Seguros de Viaje y Vida', 302, 0),
(310, 'TV Cable', 302, 0),
(311, 'Útiles Escolares', 302, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `FECHACOMPRA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CONCRETADO` tinyint(1) DEFAULT '0',
  `FECHACONCRETADO` datetime DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT '1',
  `TOTAL` double(10,2) NOT NULL,
  `COMISION` double(10,2) NOT NULL,
  `CALIFICACION` int(11) DEFAULT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE `contiene` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `IDCATEGORIA` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crea`
--

DROP TABLE IF EXISTS `crea`;
CREATE TABLE `crea` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `crea`
--

INSERT INTO `crea` (`ID`, `IDUSUARIO`, `IDPUBLICACION`, `FECHA`, `BAJA`) VALUES
(1, 9, 1, '2019-03-25 20:26:51', 0),
(2, 9, 2, '2019-03-25 20:26:51', 0),
(3, 9, 3, '2019-03-25 20:26:51', 0),
(4, 9, 4, '2019-03-25 20:26:51', 0),
(5, 9, 5, '2019-03-25 20:26:51', 0),
(6, 9, 6, '2019-03-25 20:26:51', 0),
(7, 9, 7, '2019-03-25 20:26:51', 0),
(8, 9, 8, '2019-03-25 20:26:51', 0),
(9, 9, 9, '2019-03-25 20:26:51', 0),
(10, 9, 10, '2019-03-25 20:26:51', 0),
(11, 9, 11, '2019-03-25 20:26:51', 0),
(12, 9, 12, '2019-03-25 20:26:51', 0),
(13, 9, 13, '2019-03-25 20:26:51', 0),
(14, 9, 14, '2019-03-25 20:26:51', 0),
(15, 9, 15, '2019-03-25 20:26:51', 0),
(16, 9, 16, '2019-03-25 20:26:51', 0),
(17, 9, 17, '2019-03-25 20:26:51', 0),
(18, 9, 18, '2019-03-25 20:26:51', 0),
(19, 9, 19, '2019-03-25 20:26:51', 0),
(20, 9, 20, '2019-03-25 20:26:51', 0),
(21, 9, 21, '2019-03-25 20:26:51', 0),
(22, 9, 22, '2019-03-25 20:26:51', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_busqueda_categoria`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_busqueda_categoria`;
CREATE TABLE `datos_busqueda_categoria` (
`USUARIO` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`ID` bigint(20) unsigned
,`TIPO` varchar(10)
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` datetime
,`IDCATEGORIA` bigint(20) unsigned
,`CATTITULO` varchar(50)
,`CATID` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_busqueda_categoria_aux01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_busqueda_categoria_aux01`;
CREATE TABLE `datos_busqueda_categoria_aux01` (
`USUARIO` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`ID` bigint(20) unsigned
,`TIPO` varchar(10)
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` datetime
,`IDCATEGORIA` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_compras`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_compras`;
CREATE TABLE `datos_compras` (
`ID` bigint(20) unsigned
,`IDUSUARIO` bigint(20) unsigned
,`IDPUBLICACION` bigint(20) unsigned
,`FECHACOMPRA` timestamp
,`CONCRETADO` tinyint(1)
,`FECHACONCRETADO` datetime
,`CANTIDAD` int(11)
,`TOTAL` double(10,2)
,`COMISION` double(10,2)
,`CALIFICACION` int(11)
,`BAJA` tinyint(1)
,`TITULO` varchar(50)
,`IDVENDEDOR` bigint(20) unsigned
,`CEDULA` varchar(10)
,`PNOMBRE` varchar(20)
,`SNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`SAPELLIDO` varchar(20)
,`EMAIL` varchar(50)
,`CALLE` varchar(50)
,`NUMERO` int(11)
,`ESQUINA` varchar(50)
,`CPOSTAL` int(11)
,`LOCALIDAD` varchar(50)
,`DEPARTAMENTO` varchar(50)
,`GEOX` varchar(15)
,`GEOY` varchar(15)
,`IDCOMPRADOR` bigint(20) unsigned
,`CEDULACOMPRADOR` varchar(10)
,`PNOMBRECOMPRADOR` varchar(20)
,`PAPELLIDOCOMPRADOR` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_persona`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_persona`;
CREATE TABLE `datos_persona` (
`ID` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`PUBLICACIONES` bigint(21)
,`VENTAS` decimal(32,0)
,`CALIFICACION` bigint(21)
,`NOTA` decimal(11,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_persona_aux01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_persona_aux01`;
CREATE TABLE `datos_persona_aux01` (
`ID` bigint(20) unsigned
,`VENTAS` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_persona_aux02`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_persona_aux02`;
CREATE TABLE `datos_persona_aux02` (
`IDUSUARIO` bigint(20) unsigned
,`NOTA` decimal(11,0)
,`CALIFICACION` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_persona_aux03`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_persona_aux03`;
CREATE TABLE `datos_persona_aux03` (
`ID` bigint(20) unsigned
,`CALIFICACION` bigint(21)
,`NOTA` decimal(11,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto`;
CREATE TABLE `datos_producto` (
`ID` bigint(20) unsigned
,`VISTO` int(11)
,`VENTAS` decimal(32,0)
,`PREGUNTAS` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto_aux01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_aux01`;
CREATE TABLE `datos_producto_aux01` (
`IDPUBLICACION` bigint(20) unsigned
,`PREGUNTAS` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto_index`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_index`;
CREATE TABLE `datos_producto_index` (
`USUARIO` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`ID` bigint(20) unsigned
,`TIPO` varchar(10)
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto_oferta`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_oferta`;
CREATE TABLE `datos_producto_oferta` (
`ID` bigint(20) unsigned
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto_vip`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_vip`;
CREATE TABLE `datos_producto_vip` (
`USUARIO` bigint(20) unsigned
,`ID` bigint(20) unsigned
,`IDCATEGORIA` bigint(20) unsigned
,`TITULO` varchar(50)
,`DESCRIPCION` text
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`OFERTA` tinyint(1)
,`DESCUENTO` int(11)
,`FOFERTA` datetime
,`ESTADOP` varchar(10)
,`ESTADOA` varchar(10)
,`CANTIDAD` int(11)
,`VISTO` int(11)
,`BAJA` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_publicaciones`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_publicaciones`;
CREATE TABLE `datos_publicaciones` (
`ID` bigint(20) unsigned
,`IDCATEGORIA` bigint(20) unsigned
,`TITULO` varchar(50)
,`DESCRIPCION` text
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`OFERTA` tinyint(1)
,`DESCUENTO` int(11)
,`FOFERTA` datetime
,`ESTADOP` varchar(10)
,`ESTADOA` varchar(10)
,`CANTIDAD` int(11)
,`VISTO` int(11)
,`BAJA` tinyint(1)
,`FAV` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_publicaciones_aux01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_publicaciones_aux01`;
CREATE TABLE `datos_publicaciones_aux01` (
`IDPUBLICACION` bigint(20) unsigned
,`FAV` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia`
--

DROP TABLE IF EXISTS `denuncia`;
CREATE TABLE `denuncia` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL,
  `TIPO` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `IDOBJETO` bigint(20) UNSIGNED NOT NULL,
  `COMENTARIO` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO` varchar(10) COLLATE utf8_spanish_ci DEFAULT 'ACTIVA',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDCOMPRA` bigint(20) UNSIGNED NOT NULL,
  `FECHAC` datetime NOT NULL,
  `FECHAV` datetime NOT NULL,
  `ESTADO` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `SUBTOTAL` double(10,2) NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

DROP TABLE IF EXISTS `favorito`;
CREATE TABLE `favorito` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiona`
--

DROP TABLE IF EXISTS `gestiona`;
CREATE TABLE `gestiona` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDDENUNCIA` bigint(20) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` text COLLATE utf8_spanish_ci,
  `HTML` text COLLATE utf8_spanish_ci,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USUARIO` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `ACCION` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCCION` text COLLATE utf8_spanish_ci NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permuta`
--

DROP TABLE IF EXISTS `permuta`;
CREATE TABLE `permuta` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `ESTADO` varchar(15) COLLATE utf8_spanish_ci DEFAULT 'ACTIVA',
  `FECHAP` datetime NOT NULL,
  `ACEPTADA` tinyint(1) DEFAULT '0',
  `FECHAC` datetime DEFAULT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE `pregunta` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `MENSAJE` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `FECHAM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RESPUESTA` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FECHAR` datetime DEFAULT NULL,
  `ESTADO` varchar(15) COLLATE utf8_spanish_ci DEFAULT 'ACTIVO',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
CREATE TABLE `publicacion` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDCATEGORIA` bigint(20) UNSIGNED NOT NULL,
  `TITULO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` text COLLATE utf8_spanish_ci NOT NULL,
  `IMGDEFAULT` varchar(50) COLLATE utf8_spanish_ci DEFAULT 'noimage',
  `PRECIO` double(10,2) DEFAULT '1.00',
  `OFERTA` tinyint(1) DEFAULT '0',
  `DESCUENTO` int(11) DEFAULT '0',
  `FOFERTA` datetime DEFAULT NULL,
  `ESTADOP` varchar(10) COLLATE utf8_spanish_ci DEFAULT 'PUBLICADA',
  `ESTADOA` varchar(10) COLLATE utf8_spanish_ci DEFAULT 'NUEVO',
  `CANTIDAD` int(11) NOT NULL,
  `VISTO` int(11) DEFAULT '0',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`ID`, `IDCATEGORIA`, `TITULO`, `DESCRIPCION`, `IMGDEFAULT`, `PRECIO`, `OFERTA`, `DESCUENTO`, `FOFERTA`, `ESTADOP`, `ESTADOA`, `CANTIDAD`, `VISTO`, `BAJA`) VALUES
(1, 228, 'Relogio Masculino', '&lt;p&gt;zxcxzcxczxcz&lt;/p&gt;\r\n', '315737fdbaa4efcb8e935dbdc8eddf33', 32.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 30, 3, 0),
(2, 255, 'CARTERA BOLSO KORIUM CON DOBLE CIERRE FRONTAL ', '&lt;p&gt;Cartera tipo bolso Korium con doble cierre frontal y cierre central. Material sint&amp;eacute;tico s&amp;iacute;mil cuero.&lt;/p&gt;\r\n', '273a2311c486376604393b73d8d0c12f', 890.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 6, 1, 0),
(3, 255, 'Cartera Bolso Korium Tramada con Rafia', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '3b20b15cb14ede7dd082d11634607eee', 890.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 1, 0),
(4, 255, 'CARTERA KORIUM CLÃSICA CON MANIJA A MEDIDA', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '531262b335faba33437d97a88adb3476', 990.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
(5, 247, 'GORRO UMBRO NEGRO CON LOGO FRONTAL ', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Este gorro es ideal para la temporada de oto&amp;ntilde;o invierno, complementando un look sport casual para tu tiempo libre o para todos los d&amp;iacute;as.&lt;/p&gt;\r\n', '904c564d07fb0c069ef01c8c48b951e7', 360.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 1, 0),
(6, 255, 'Mochila Clasica Jansport Superbreak Verde', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '5eb09118d0c8c2b5cb3b7dbef1a44b21', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
(7, 255, 'Mochila Clasica Jansport Superbreak Azul', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '7002e7b58907181472922676d0f2e1f2', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
(8, 255, 'Mochila Clasica Jansport Superbreak Rosada', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '3a11ee90230a0555988b27fe2208063e', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
(9, 255, 'Mochila Clasica Jansport Superbreak Violeta', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '56befbe854d16d3d3b740d10bbf7595a', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
(10, 108, 'Notebook Asus S510uf-bq091t I7 W10 GEFORCE MX130 U', '&lt;p&gt;El ASUS VivoBook S ofrece la combinaci&amp;oacute;n ideal de belleza y rendimiento. Con su marco NanoEdge, acabado de metal pulido, procesador Intel&amp;reg; y gr&amp;aacute;fica NVIDIA, el VivoBook S es un port&amp;aacute;til pensado para los agitados estilos de vida de hoy en d&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;Garant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nPart Number 90NB0IK1-M03490&amp;nbsp;&lt;br /&gt;\r\nMarca Asus&amp;nbsp;&lt;br /&gt;\r\nCPU Intel&amp;reg; Core&amp;trade; i7-8550U Processor, 1.8 GHz (8M Cache, up to 4GHz)&amp;nbsp;&lt;br /&gt;\r\nMemoria 8 GB DDR4 2 slot memoria max. 16 gb&amp;nbsp;&lt;br /&gt;\r\nDisco Duro SATA 1TB 5400RPM 2.5&amp;#39; HDD&amp;nbsp;&lt;br /&gt;\r\nPantalla 15,6&amp;#39;//Ultra Slim 250nits// FHD 1920X1080 16:9 // AntiGlade // NTSC:45% // Wide View&amp;nbsp;&lt;br /&gt;\r\nResoluci&amp;oacute;n FHD 1920X1080&amp;nbsp;&lt;br /&gt;\r\nTarj. Video Intel UHD 620&amp;nbsp;&lt;br /&gt;\r\nCamara Web VGA web camera (Fixed type)&amp;nbsp;&lt;br /&gt;\r\nAudio Built-in speaker&amp;nbsp;&lt;br /&gt;\r\nBuilt-in microphone&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Sonic Master&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Bater&amp;iacute;a 42WHrs, 3S1P, 3-cell Li-ion&amp;nbsp;&lt;br /&gt;\r\nCard Reader SDXC&amp;nbsp;&lt;br /&gt;\r\nBluetooth 4.2&amp;nbsp;&lt;br /&gt;\r\nWifi Integrado 802.11 AC&amp;nbsp;&lt;br /&gt;\r\nUsb 2x USB 2.0&amp;nbsp;&lt;br /&gt;\r\n1x USB 3.0&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x USB3.1 Type C (gen 1)&amp;quot;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Hdmi 1.4&amp;nbsp;&lt;br /&gt;\r\nOtros Puertos I/0 1x Headphone-out &amp;amp; Audio-in Combo Jack&amp;nbsp;&lt;br /&gt;\r\n1x RJ45 LAN Jack for LAN insert&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x VGA Port (D-Sub)&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Teclado Chiclet espa&amp;ntilde;ol&amp;nbsp;&lt;br /&gt;\r\nMedidas (mm.) 36.1(W) x 24.3(D) x 1.79 ~ 1.79 (H) cm&amp;nbsp;&lt;br /&gt;\r\nPeso (kgs.) 1.7 KGS con bater&amp;iacute;a&amp;nbsp;&lt;br /&gt;\r\nColor GOLD METAL&amp;nbsp;&lt;br /&gt;\r\nSistema Operativo Windows 10 home ( 64 bits)&amp;nbsp;&lt;br /&gt;\r\nGarant&amp;iacute;a 1 a&amp;ntilde;o en Centro Autorizado de Servicio&lt;/p&gt;\r\n', '2ff7cae74ac678e34c17d5698abf36d0', 32400.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 2, 1, 0),
(11, 108, 'Notebook Hp Stream 11.6 Dual Core 4GB Ram 32Gb SSD', '&lt;p&gt;Ideal para la inform&amp;aacute;tica b&amp;aacute;sica, ya sea en casa o mientras viaja, disfruta de la navegaci&amp;oacute;n web, las redes sociales, el chat, las videollamadas, usa aplicaciones de oficina, correos electr&amp;oacute;nicos y descarga de aplicaciones.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nProcesador Intel Dual Core N2840 - 2.58GHz&lt;br /&gt;\r\nPantalla LED HD 11.6&amp;quot; 1366 x 768&lt;br /&gt;\r\nMemoria RAM 4GB DDR3L 1333MHz&lt;br /&gt;\r\nDisco S&amp;oacute;lido SSD 32GB&lt;br /&gt;\r\nS.O. Windows 10&lt;br /&gt;\r\nGr&amp;aacute;ficos Intel HD Graphic&lt;br /&gt;\r\nWebCam, micr&amp;oacute;fono&lt;br /&gt;\r\nHDMI, USB 3.0, USB 2.0&lt;br /&gt;\r\nLector de tarjetas de memoria&lt;br /&gt;\r\nBater&amp;iacute;a de 3 celdas&lt;br /&gt;\r\nPeso: 1.23 Kg&lt;/p&gt;\r\n', 'd795ac99ca3516bc28c38eb519031bac', 8950.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(12, 137, 'Pelota de fÃºtbol Topper Ultra Azul', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b5ab5bfbb231c14615f83d2ed7580b55', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(13, 137, 'Pelota de Futbol Topper Ultra VIII Roja', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b756d15507a508c4f5565a10fe03a2fd', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(14, 137, 'Pelota Neo Trainer 5 Umbro', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Esta pelota es ideal para practicar el deporte que m&amp;aacute;s te gusta.&lt;/p&gt;\r\n', '2496b899d43cdea1a7902868ad3aa993', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(15, 108, 'Notebook HP Quadcore 2.4Ghz 4GB 500GB 15.6 Win 10', '&lt;p&gt;Factory Refurbished. Modelo 15-ba015wm.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;6 meses&lt;br /&gt;\r\nN&amp;uacute;mero de parte HP 1NT85UA.&lt;br /&gt;\r\nColor negro.&lt;br /&gt;\r\nMicrosoft Windows 10 Home 64-bit en ingl&amp;eacute;s pre-instalado.&lt;br /&gt;\r\nProcesador AMD QuadCore E2-7110 2.0GHz (hasta 2.4 Ghz).&lt;br /&gt;\r\nMemoria 4GB DDR4-2133 SDRAM.&lt;br /&gt;\r\nGrabadora SuperMulti DVD burner.&lt;br /&gt;\r\nDisco Duro 500GB 5400rpm.&lt;br /&gt;\r\nPantalla 15.6&amp;quot; diagonal HD SVA BrightView WLED-backlit (1366 x 768).&lt;br /&gt;\r\nVideo AMD Radeon R2 Graphics.&lt;br /&gt;\r\nSonido DTS Studio Sound con parlantes est&amp;eacute;reo.&lt;br /&gt;\r\nRed LAN 10/100. 802.11n Wireless LAN.&lt;br /&gt;\r\nWebcam con micr&amp;oacute;fono digital integrado&lt;br /&gt;\r\nTeclado en ingl&amp;eacute;s completo con teclado num&amp;eacute;rico.&lt;br /&gt;\r\nBater&amp;iacute;a de 4 celdas 41Whr de litio ion.&lt;br /&gt;\r\nLector de micro SD.&lt;/p&gt;\r\n\r\n&lt;p&gt;Puertos disponibles:&lt;/p&gt;\r\n\r\n&lt;p&gt;1 HDMI&lt;br /&gt;\r\n2 USB 2.0&lt;br /&gt;\r\n1 USB 3.0&lt;br /&gt;\r\n1 RJ-45 (LAN)&lt;br /&gt;\r\n1 Headphone-out/microphone-in combo jack&lt;/p&gt;\r\n', '38a9d0d1586b08023a31414ed045c359', 11960.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 1, 0),
(16, 161, 'Auriculares de vincha GORSUN', '&lt;ul&gt;\r\n	&lt;li&gt;Inal&amp;aacute;mbricos.&lt;/li&gt;\r\n	&lt;li&gt;Calidad de sonido superior.&lt;/li&gt;\r\n	&lt;li&gt;Alta administraci&amp;oacute;n de buffer.&lt;/li&gt;\r\n	&lt;li&gt;Reproduce tarjetas Micro SD.&lt;/li&gt;\r\n	&lt;li&gt;Plegables y pr&amp;aacute;cticos para transportar.&lt;/li&gt;\r\n	&lt;li&gt;Estereo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '572d5b93d2d4bbbe0dedaaf07e992aeb', 1100.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 2, 0),
(17, 161, 'Auriculares de vincha XION', '&lt;ul&gt;\r\n	&lt;li&gt;Bluetooth&lt;/li&gt;\r\n	&lt;li&gt;Con bater&amp;iacute;as recargables&lt;/li&gt;\r\n	&lt;li&gt;Micr&amp;oacute;fono&lt;/li&gt;\r\n	&lt;li&gt;Con botones de control para operar su dispositivo.&lt;/li&gt;\r\n	&lt;li&gt;Compatibles con IOS y Android&lt;/li&gt;\r\n	&lt;li&gt;Est&amp;eacute;reo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '4a1a639231cf8f83efc86f396146baec', 1390.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(18, 161, 'Auriculares i7S TWS Bluetooth', '&lt;p&gt;Auriculares inalambricos que se conectan a trav&amp;eacute;s de bluetooth (4.2).&lt;/p&gt;\r\n\r\n&lt;p&gt;Ideales y c&amp;oacute;modos para escuchar m&amp;uacute;sica mientras haces deportes, tareas de la casa;&lt;br /&gt;\r\nmientras conduces los puedes usar como manos libres.&lt;/p&gt;\r\n\r\n&lt;p&gt;Detalles:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Micr&amp;oacute;fono y bot&amp;oacute;n multinacional incluido para recibir llamadas&lt;/li&gt;\r\n	&lt;li&gt;Tiempo de bater&amp;iacute;a 2-3 horas&lt;/li&gt;\r\n	&lt;li&gt;Alcance 10 mts&lt;/li&gt;\r\n	&lt;li&gt;Cargador Inalambrico&lt;/li&gt;\r\n	&lt;li&gt;Conexi&amp;oacute;n Bluetooth 4.2&lt;/li&gt;\r\n	&lt;li&gt;Parlantes Estero 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Compatible:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;iOS&lt;/li&gt;\r\n	&lt;li&gt;Android&lt;/li&gt;\r\n	&lt;li&gt;Windows&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Contenido:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Par de auriculares&lt;/li&gt;\r\n	&lt;li&gt;Caja de carga&lt;/li&gt;\r\n	&lt;li&gt;Manual&lt;/li&gt;\r\n	&lt;li&gt;Cable micro USB&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '63acacf572b8dfff9626473c67944fd8', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 1, 0),
(19, 161, 'Parlante Bluetooth ROCA', '&lt;p&gt;Escucha la m&amp;uacute;sica que quieres, donde quieras con este practico parlante port&amp;aacute;til!&lt;/p&gt;\r\n', 'f29d1589f88d93125ba678a99b24ae64', 540.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(20, 68, 'Brazalete hasta 4 pulgadas', '&lt;p&gt;Ideal para tener tu dispositivo de hasta 4 pulgadas seguro mientras haces actividades.&lt;/p&gt;\r\n', 'd753a93a4d27c85a17398687c1e18679', 300.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
(21, 68, 'Cable de datos MICRO USB', '&lt;ul&gt;\r\n	&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n	&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '816994e1a25e51a8754f12caac349d64', 190.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 1, 0),
(22, 68, 'Cable de datos TIPO-C', '&lt;ul&gt;\r\n	&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n	&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 'ebad02c778900d80810b2dcd46241802', 250.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacionimg`
--

DROP TABLE IF EXISTS `publicacionimg`;
CREATE TABLE `publicacionimg` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IMAGENES` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'DEFAULT.JPG'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publicacionimg`
--

INSERT INTO `publicacionimg` (`ID`, `IMAGENES`) VALUES
(1, '315737fdbaa4efcb8e935dbdc8eddf33'),
(2, '273a2311c486376604393b73d8d0c12f'),
(2, '2deb96b3b400f3c81046aba4c29a62f6'),
(2, '697c4bb34f48226222dc0982b6144ef3'),
(3, '27f144863894407c52a1e57ccad7731e'),
(3, '3b20b15cb14ede7dd082d11634607eee'),
(3, 'ad9589605e3e90fc9615bfcec5faa317'),
(3, 'd0a23ce84a1f55cf349d3f13cbd2501d'),
(4, '3035f97fa9a3ae8f5dd5b06d0400c5da'),
(4, '531262b335faba33437d97a88adb3476'),
(4, '7d8dc93d3fc0fc42e31ff75078c4edd2'),
(4, 'bb4970292db5798df13b112d972acec4'),
(4, 'e82425b3a16697cbf370681ed668cf92'),
(5, '904c564d07fb0c069ef01c8c48b951e7'),
(5, 'b966fe64886491293ed435cbfa753739'),
(6, '5eb09118d0c8c2b5cb3b7dbef1a44b21'),
(6, '83b24303818da6b93ed966462364c006'),
(7, '7002e7b58907181472922676d0f2e1f2'),
(7, 'a44d580c1bbaf65e985c19b10e97be73'),
(8, '2da02eb7435948f37810b8916842c49a'),
(8, '3a11ee90230a0555988b27fe2208063e'),
(9, '086cb7a5926734760a53aeb5fcd8117a'),
(9, '56befbe854d16d3d3b740d10bbf7595a'),
(10, '2ff7cae74ac678e34c17d5698abf36d0'),
(11, '0e47a04bb62699c7d2d76c66f3805544'),
(11, '31791b8614f355023e468606826b26cf'),
(11, 'd795ac99ca3516bc28c38eb519031bac'),
(12, '1035659bdae90dc64c8688b940ac42fc'),
(12, 'b5ab5bfbb231c14615f83d2ed7580b55'),
(13, '6604c89eea07ec6fc8ca5fa40e443011'),
(13, 'b756d15507a508c4f5565a10fe03a2fd'),
(14, '0f28799cd7296596b94acf151a131f2c'),
(14, '2496b899d43cdea1a7902868ad3aa993'),
(15, '38a9d0d1586b08023a31414ed045c359'),
(16, '572d5b93d2d4bbbe0dedaaf07e992aeb'),
(16, 'aa6bb48513cdedd8c26b52e2891cfb30'),
(16, 'd9ef5db5da36f59ba8616555b86841f7'),
(16, 'f3473771156bfd27e8c1220f543c5255'),
(17, '2ebcd0353b25f5a356924e64da6de79d'),
(17, '4a1a639231cf8f83efc86f396146baec'),
(17, 'f9161e73611ac35872443e293158efb7'),
(18, '2df6f411253fa2c8ca1f8f9db563da3c'),
(18, '38cc87d3e2fbaf035ad040ca4e0294d0'),
(18, '63acacf572b8dfff9626473c67944fd8'),
(18, '9bca5fb8f36e86888c3863ff50543b41'),
(19, '39096bbbd69de17d1a5e34971862d247'),
(19, 'f29d1589f88d93125ba678a99b24ae64'),
(20, '448d828ce33edffaf759fa72c732d091'),
(20, '492da95e8e12aec6676f3538f5b6402c'),
(20, '5a26642fbae4c509682415432a7e6888'),
(20, 'd753a93a4d27c85a17398687c1e18679'),
(21, '816994e1a25e51a8754f12caac349d64'),
(21, '898837f9257cad824d19912ae4212529'),
(22, 'd95cd61cfb3b345c417a174b317a56ef'),
(22, 'ebad02c778900d80810b2dcd46241802');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

DROP TABLE IF EXISTS `realiza`;
CREATE TABLE `realiza` (
  `IDDENUNCIA` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `CEDULA` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `USUARIO` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PNOMBRE` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `SNOMBRE` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `PAPELLIDO` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `SAPELLIDO` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FNACIMIENTO` datetime NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CALLE` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `NUMERO` int(11) DEFAULT NULL,
  `ESQUINA` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CPOSTAL` int(11) DEFAULT '0',
  `LOCALIDAD` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DEPARTAMENTO` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `GEOX` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `GEOY` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TIPO` varchar(10) COLLATE utf8_spanish_ci DEFAULT 'COMUN',
  `ESTADO` varchar(50) COLLATE utf8_spanish_ci DEFAULT 'CONFIRMAR EMAIL',
  `ACTIVACION` varchar(100) COLLATE utf8_spanish_ci DEFAULT '1',
  `ROL` varchar(50) COLLATE utf8_spanish_ci DEFAULT 'CLIENTE',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `CEDULA`, `USUARIO`, `PASSWORD`, `PNOMBRE`, `SNOMBRE`, `PAPELLIDO`, `SAPELLIDO`, `FNACIMIENTO`, `EMAIL`, `CALLE`, `NUMERO`, `ESQUINA`, `CPOSTAL`, `LOCALIDAD`, `DEPARTAMENTO`, `GEOX`, `GEOY`, `TIPO`, `ESTADO`, `ACTIVACION`, `ROL`, `BAJA`) VALUES
(1, '34190881', 'jarce', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Jael ', 'Arapey', 'Arce ', 'Ybarra', '1963-04-21 00:00:00', 'jarce@gmail.com', 'Av. Gral. Rivera', 4573, 'Santiago de Anca', 11400, 'Malvin Nuevo', 'Montevideo', '-34.891700', '-56.113456', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(2, '19918890', 'ahurtado', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Arapey', 'Silvio', 'Hurtado', 'Brito', '1947-05-09 00:00:00', 'ahurtado@gmail.com', 'Garzon', 646, 'Justino Muniz', 37000, 'Melo', 'Cerro largo', '-32.377925', '-54.170704', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(3, '72940202', 'zfajardo', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Zofía', 'Clímaco', 'Fajardo', 'Tovar', '1983-03-13 00:00:00', 'zfajardo@gmail.com', 'Gral Juan Antonio Lavalleja ', 1224, 'Wilson Ferreira Alduante', 80100, 'Libertad', 'San José', '-34.639277', '-56.620507', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(4, '54790312', 'hmaya', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Herminda', 'Josías', ' Maya', 'Tovar', '1949-11-25 00:00:00', 'hmaya@gmail.com', 'Ansina', 6818, 'Federico Garcia Lorca', 15800, 'Ciudad de la Costa', 'Canelones', '-34.852552', '-56.048759', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(5, '32206929', 'acamacho', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Ann', 'Zofía', 'Camacho', 'Ordóñez', '1993-08-26 00:00:00', 'acamacho3@gmail.com', 'Guayabos', 1775, 'Gaboto', 11200, 'Cordón', 'Montevideo', '-34.903645', '-56.177682', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(6, '11295947', 'srentia', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Silvio', 'Ann', 'Rentería', 'Montemayor', '1951-09-27 00:00:00', 'srentia@gmail.com', 'Joaquin Suarez', 5556, 'AV. Argentina', 15300, 'Parque del Plata', 'Canelones', '-34.755289', '-55.706514', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(7, '53917507', 'jtorres', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Josías', 'Herminda', 'Torres', 'Ontiveros', '1961-03-15 00:00:00', 'jtorres@gmail.com', 'Guipúzcoa', 402, 'Solano García', 11300, 'Punta Carreta', 'Montevideo', '-34.924050', '-56.156384', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(8, '16210700', 'cgarcia', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Clímaco', 'Jael ', 'García', 'Balderas', '1950-01-27 00:00:00', 'cgarcia@gmail.com', 'Del Monte', 2869, 'Av. Transversal', 15800, 'Ciudad de la Costa', 'Canelones', '-34.821007', '-55.943328', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(9, '51652357', 'gabobuceo', '4e4800c9e622ec10c62c4bf2ca9aa88136d88bdf', 'Gabriel', NULL, 'Fernandez', NULL, '1990-11-28 00:00:00', 'emgabo@gmail.com', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariotel`
--

DROP TABLE IF EXISTS `usuariotel`;
CREATE TABLE `usuariotel` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `TELEFONO` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuariotel`
--

INSERT INTO `usuariotel` (`ID`, `TELEFONO`) VALUES
(1, '094941073'),
(1, '495131497'),
(2, '095213190'),
(2, '291766058'),
(3, '091823275'),
(3, '493160386'),
(4, '093095314'),
(4, '297377925'),
(5, '099426475'),
(5, '495379841'),
(6, '299593321'),
(7, '498270023'),
(8, '299758321');

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_busqueda_categoria`
--
DROP TABLE IF EXISTS `datos_busqueda_categoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_busqueda_categoria`  AS  select `tt`.`USUARIO` AS `USUARIO`,`tt`.`PNOMBRE` AS `PNOMBRE`,`tt`.`PAPELLIDO` AS `PAPELLIDO`,`tt`.`ID` AS `ID`,`tt`.`TIPO` AS `TIPO`,`tt`.`IMGDEFAULT` AS `IMGDEFAULT`,`tt`.`PRECIO` AS `PRECIO`,`tt`.`TITULO` AS `TITULO`,`tt`.`FECHA` AS `FECHA`,`tt`.`IDCATEGORIA` AS `IDCATEGORIA`,`categoria`.`TITULO` AS `CATTITULO`,`categoria`.`ID` AS `CATID` from (`categoria` left join `datos_busqueda_categoria_aux01` `tt` on((`categoria`.`ID` = `tt`.`IDCATEGORIA`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_busqueda_categoria_aux01`
--
DROP TABLE IF EXISTS `datos_busqueda_categoria_aux01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_busqueda_categoria_aux01`  AS  select `u`.`USUARIO` AS `USUARIO`,`u`.`PNOMBRE` AS `PNOMBRE`,`u`.`PAPELLIDO` AS `PAPELLIDO`,`u`.`ID` AS `ID`,`u`.`TIPO` AS `TIPO`,`u`.`IMGDEFAULT` AS `IMGDEFAULT`,`u`.`PRECIO` AS `PRECIO`,`u`.`TITULO` AS `TITULO`,`u`.`FECHA` AS `FECHA`,`p`.`IDCATEGORIA` AS `IDCATEGORIA` from (`datos_producto_index` `u` left join `publicacion` `p` on((`u`.`ID` = `p`.`ID`))) group by `u`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_compras`
--
DROP TABLE IF EXISTS `datos_compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_compras`  AS  select `compra`.`ID` AS `ID`,`compra`.`IDUSUARIO` AS `IDUSUARIO`,`compra`.`IDPUBLICACION` AS `IDPUBLICACION`,`compra`.`FECHACOMPRA` AS `FECHACOMPRA`,`compra`.`CONCRETADO` AS `CONCRETADO`,`compra`.`FECHACONCRETADO` AS `FECHACONCRETADO`,`compra`.`CANTIDAD` AS `CANTIDAD`,`compra`.`TOTAL` AS `TOTAL`,`compra`.`COMISION` AS `COMISION`,`compra`.`CALIFICACION` AS `CALIFICACION`,`compra`.`BAJA` AS `BAJA`,`publicacion`.`TITULO` AS `TITULO`,`usuario`.`ID` AS `IDVENDEDOR`,`usuario`.`CEDULA` AS `CEDULA`,`usuario`.`PNOMBRE` AS `PNOMBRE`,`usuario`.`SNOMBRE` AS `SNOMBRE`,`usuario`.`PAPELLIDO` AS `PAPELLIDO`,`usuario`.`SAPELLIDO` AS `SAPELLIDO`,`usuario`.`EMAIL` AS `EMAIL`,`usuario`.`CALLE` AS `CALLE`,`usuario`.`NUMERO` AS `NUMERO`,`usuario`.`ESQUINA` AS `ESQUINA`,`usuario`.`CPOSTAL` AS `CPOSTAL`,`usuario`.`LOCALIDAD` AS `LOCALIDAD`,`usuario`.`DEPARTAMENTO` AS `DEPARTAMENTO`,`usuario`.`GEOX` AS `GEOX`,`usuario`.`GEOY` AS `GEOY`,`u2`.`ID` AS `IDCOMPRADOR`,`u2`.`CEDULA` AS `CEDULACOMPRADOR`,`u2`.`PNOMBRE` AS `PNOMBRECOMPRADOR`,`u2`.`PAPELLIDO` AS `PAPELLIDOCOMPRADOR` from ((((`compra` join `usuario`) join `publicacion`) join `crea`) join `usuario` `u2`) where ((`compra`.`IDPUBLICACION` = `publicacion`.`ID`) and (`compra`.`IDUSUARIO` = `u2`.`ID`) and (`publicacion`.`ID` = `crea`.`IDPUBLICACION`) and (`usuario`.`ID` = `crea`.`IDUSUARIO`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_persona`
--
DROP TABLE IF EXISTS `datos_persona`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_persona`  AS  select `u`.`ID` AS `ID`,`u`.`PNOMBRE` AS `PNOMBRE`,`u`.`PAPELLIDO` AS `PAPELLIDO`,count(`cr`.`IDPUBLICACION`) AS `PUBLICACIONES`,`tt`.`VENTAS` AS `VENTAS`,`tt2`.`CALIFICACION` AS `CALIFICACION`,`tt2`.`NOTA` AS `NOTA` from (((`usuario` `u` left join `crea` `cr` on((`u`.`ID` = `cr`.`IDUSUARIO`))) left join `datos_persona_aux01` `tt` on((`u`.`ID` = `tt`.`ID`))) left join `datos_persona_aux03` `tt2` on((`u`.`ID` = `tt2`.`ID`))) group by `u`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_persona_aux01`
--
DROP TABLE IF EXISTS `datos_persona_aux01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_persona_aux01`  AS  select `u`.`ID` AS `ID`,sum(`co`.`CANTIDAD`) AS `VENTAS` from (`usuario` `u` left join `compra` `co` on((`u`.`ID` = `co`.`IDUSUARIO`))) group by `u`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_persona_aux02`
--
DROP TABLE IF EXISTS `datos_persona_aux02`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_persona_aux02`  AS  select `cr`.`IDUSUARIO` AS `IDUSUARIO`,round(avg(`co`.`CALIFICACION`),0) AS `NOTA`,count(`co`.`CALIFICACION`) AS `CALIFICACION` from (`crea` `cr` join `compra` `co`) where (`cr`.`IDPUBLICACION` = `co`.`IDPUBLICACION`) group by `cr`.`IDUSUARIO` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_persona_aux03`
--
DROP TABLE IF EXISTS `datos_persona_aux03`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_persona_aux03`  AS  select `u`.`ID` AS `ID`,`tt`.`CALIFICACION` AS `CALIFICACION`,`tt`.`NOTA` AS `NOTA` from (`usuario` `u` left join `datos_persona_aux02` `tt` on((`u`.`ID` = `tt`.`IDUSUARIO`))) group by `u`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_producto`
--
DROP TABLE IF EXISTS `datos_producto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_producto`  AS  select `p`.`ID` AS `ID`,`p`.`VISTO` AS `VISTO`,sum(`co`.`CANTIDAD`) AS `VENTAS`,`cm`.`PREGUNTAS` AS `PREGUNTAS` from ((`publicacion` `p` left join `compra` `co` on((`p`.`ID` = `co`.`IDPUBLICACION`))) left join `datos_producto_aux01` `cm` on((`p`.`ID` = `cm`.`IDPUBLICACION`))) group by `p`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_producto_aux01`
--
DROP TABLE IF EXISTS `datos_producto_aux01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_producto_aux01`  AS  select `pregunta`.`IDPUBLICACION` AS `IDPUBLICACION`,count(`pregunta`.`ID`) AS `PREGUNTAS` from `pregunta` group by `pregunta`.`IDPUBLICACION` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_producto_index`
--
DROP TABLE IF EXISTS `datos_producto_index`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_producto_index`  AS  select `u`.`ID` AS `USUARIO`,`u`.`PNOMBRE` AS `PNOMBRE`,`u`.`PAPELLIDO` AS `PAPELLIDO`,`p`.`ID` AS `ID`,`u`.`TIPO` AS `TIPO`,`p`.`IMGDEFAULT` AS `IMGDEFAULT`,`p`.`PRECIO` AS `PRECIO`,`p`.`TITULO` AS `TITULO`,`c`.`FECHA` AS `FECHA` from ((`usuario` `u` join `crea` `c`) join `publicacion` `p`) where ((`u`.`ID` = `c`.`IDUSUARIO`) and (`c`.`IDPUBLICACION` = `p`.`ID`)) order by `u`.`TIPO` desc,rand() ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_producto_oferta`
--
DROP TABLE IF EXISTS `datos_producto_oferta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_producto_oferta`  AS  select `p`.`ID` AS `ID`,`p`.`IMGDEFAULT` AS `IMGDEFAULT`,`p`.`PRECIO` AS `PRECIO`,`p`.`TITULO` AS `TITULO`,`c`.`FECHA` AS `FECHA` from (`crea` `c` join `publicacion` `p`) where ((`p`.`OFERTA` = '1') and (`c`.`IDPUBLICACION` = `p`.`ID`)) order by rand() limit 8 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_producto_vip`
--
DROP TABLE IF EXISTS `datos_producto_vip`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_producto_vip`  AS  select `u`.`ID` AS `USUARIO`,`p`.`ID` AS `ID`,`p`.`IDCATEGORIA` AS `IDCATEGORIA`,`p`.`TITULO` AS `TITULO`,`p`.`DESCRIPCION` AS `DESCRIPCION`,`p`.`IMGDEFAULT` AS `IMGDEFAULT`,`p`.`PRECIO` AS `PRECIO`,`p`.`OFERTA` AS `OFERTA`,`p`.`DESCUENTO` AS `DESCUENTO`,`p`.`FOFERTA` AS `FOFERTA`,`p`.`ESTADOP` AS `ESTADOP`,`p`.`ESTADOA` AS `ESTADOA`,`p`.`CANTIDAD` AS `CANTIDAD`,`p`.`VISTO` AS `VISTO`,`p`.`BAJA` AS `BAJA` from ((`usuario` `u` join `crea` `c`) join `publicacion` `p`) where ((`u`.`ID` = `c`.`IDUSUARIO`) and (`c`.`IDPUBLICACION` = `p`.`ID`) and (`u`.`TIPO` = 'VIP')) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_publicaciones`
--
DROP TABLE IF EXISTS `datos_publicaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_publicaciones`  AS  select `publicacion`.`ID` AS `ID`,`publicacion`.`IDCATEGORIA` AS `IDCATEGORIA`,`publicacion`.`TITULO` AS `TITULO`,`publicacion`.`DESCRIPCION` AS `DESCRIPCION`,`publicacion`.`IMGDEFAULT` AS `IMGDEFAULT`,`publicacion`.`PRECIO` AS `PRECIO`,`publicacion`.`OFERTA` AS `OFERTA`,`publicacion`.`DESCUENTO` AS `DESCUENTO`,`publicacion`.`FOFERTA` AS `FOFERTA`,`publicacion`.`ESTADOP` AS `ESTADOP`,`publicacion`.`ESTADOA` AS `ESTADOA`,`publicacion`.`CANTIDAD` AS `CANTIDAD`,`publicacion`.`VISTO` AS `VISTO`,`publicacion`.`BAJA` AS `BAJA`,`datos_publicaciones_aux01`.`FAV` AS `FAV` from (`publicacion` left join `datos_publicaciones_aux01` on((`publicacion`.`ID` = `datos_publicaciones_aux01`.`IDPUBLICACION`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_publicaciones_aux01`
--
DROP TABLE IF EXISTS `datos_publicaciones_aux01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_publicaciones_aux01`  AS  select `favorito`.`IDPUBLICACION` AS `IDPUBLICACION`,count(`favorito`.`IDUSUARIO`) AS `FAV` from `favorito` group by `favorito`.`IDPUBLICACION` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`,`FECHACOMPRA`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD PRIMARY KEY (`ID`,`IDPUBLICACION`,`IDCATEGORIA`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`),
  ADD KEY `IDCATEGORIA` (`IDCATEGORIA`);

--
-- Indices de la tabla `crea`
--
ALTER TABLE `crea`
  ADD PRIMARY KEY (`ID`,`IDUSUARIO`,`IDPUBLICACION`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDOBJETO` (`IDOBJETO`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `gestiona`
--
ALTER TABLE `gestiona`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDDENUNCIA`),
  ADD KEY `IDDENUNCIA` (`IDDENUNCIA`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `permuta`
--
ALTER TABLE `permuta`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`ID`,`IDUSUARIO`,`IDPUBLICACION`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `TITULO` (`TITULO`),
  ADD KEY `IDCATEGORIA` (`IDCATEGORIA`);

--
-- Indices de la tabla `publicacionimg`
--
ALTER TABLE `publicacionimg`
  ADD PRIMARY KEY (`ID`,`IMAGENES`);

--
-- Indices de la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD PRIMARY KEY (`IDDENUNCIA`,`IDUSUARIO`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `CEDULA` (`CEDULA`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `CEDULA_2` (`CEDULA`),
  ADD KEY `USUARIO_2` (`USUARIO`);

--
-- Indices de la tabla `usuariotel`
--
ALTER TABLE `usuariotel`
  ADD PRIMARY KEY (`ID`,`TELEFONO`),
  ADD UNIQUE KEY `TELEFONO` (`TELEFONO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contiene`
--
ALTER TABLE `contiene`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `crea`
--
ALTER TABLE `crea`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `contiene_ibfk_1` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`),
  ADD CONSTRAINT `contiene_ibfk_2` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `categoria` (`ID`);

--
-- Filtros para la tabla `crea`
--
ALTER TABLE `crea`
  ADD CONSTRAINT `crea_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `crea_ibfk_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `gestiona`
--
ALTER TABLE `gestiona`
  ADD CONSTRAINT `gestiona_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `gestiona_ibfk_2` FOREIGN KEY (`IDDENUNCIA`) REFERENCES `denuncia` (`ID`);

--
-- Filtros para la tabla `permuta`
--
ALTER TABLE `permuta`
  ADD CONSTRAINT `permuta_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `permuta_ibfk_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `categoria` (`ID`);

--
-- Filtros para la tabla `publicacionimg`
--
ALTER TABLE `publicacionimg`
  ADD CONSTRAINT `publicacionimg_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `realiza_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `realiza_ibfk_2` FOREIGN KEY (`IDDENUNCIA`) REFERENCES `denuncia` (`ID`);

--
-- Filtros para la tabla `usuariotel`
--
ALTER TABLE `usuariotel`
  ADD CONSTRAINT `usuariotel_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuario` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
