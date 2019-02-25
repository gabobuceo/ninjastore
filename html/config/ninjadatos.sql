-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2019 a las 23:34:37
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ninjadatos`
--
CREATE DATABASE IF NOT EXISTS `ninjadatos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ninjadatos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CATEGORIA`
--

DROP TABLE IF EXISTS `CATEGORIA`;
CREATE TABLE `CATEGORIA` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `TITULO` varchar(50) NOT NULL,
  `PADRE` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CATEGORIA`
--

INSERT INTO `CATEGORIA` (`ID`, `TITULO`, `PADRE`, `BAJA`) VALUES
(1, 'Dispositivos Moviles', 0, 0),
(2, 'Electronica y Electrodomesticos', 0, 0),
(3, 'Celulares', 1, 0),
(4, 'Tablets', 1, 0),
(5, 'Accesorios', 1, 0),
(6, 'Computadoras y Accesorios', 2, 0),
(7, 'TV - Video - Audio', 2, 0),
(8, 'Camaras y Accesorios', 2, 0),
(9, 'Juegos y Entretenimiento', 2, 0),
(10, 'Electrodomésticos de Cocina', 2, 0),
(11, 'Electrodomésticos de Baño', 2, 0),
(12, 'Herramientas', 0, 0),
(13, 'GPS', 1, 0),
(14, 'Eléctricas', 12, 0),
(15, 'Instrumentos Musicales - Efectos', 16, 0),
(16, 'Hobby', 0, 0),
(17, 'Entrenamiento Físico', 16, 0),
(18, 'Vehiculos', 0, 0),
(19, 'Vestimenta', 0, 0),
(20, 'Calzado - Medias', 19, 0),
(21, 'Autos - Motos', 18, 0),
(22, 'Manuales', 12, 0),
(23, 'Accesorios - Varios', 12, 0),
(24, 'Remeras - Camperas', 19, 0),
(25, 'Pantalón - Short', 19, 0),
(26, 'Varios', 19, 0),
(27, 'Deportes', 16, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COMPRA`
--

DROP TABLE IF EXISTS `COMPRA`;
CREATE TABLE `COMPRA` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `COMPRA`
--

INSERT INTO `COMPRA` (`IDUSUARIO`, `IDPUBLICACION`, `FECHACOMPRA`, `CONCRETADO`, `FECHACONCRETADO`, `CANTIDAD`, `TOTAL`, `COMISION`, `CALIFICACION`, `BAJA`) VALUES
(6, 6, '2018-10-04 02:23:45', 0, NULL, 20, 1.00, 0.00, 1, 0),
(6, 7, '2018-10-04 02:13:47', 0, NULL, 4, 34000.00, 0.00, 1, 0),
(9, 7, '2018-10-04 02:14:20', 0, NULL, 10, 17000.00, 0.00, 2, 0),
(9, 7, '2018-10-14 19:26:40', 0, NULL, 40, 17000.00, 0.00, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CONTIENE`
--

DROP TABLE IF EXISTS `CONTIENE`;
CREATE TABLE `CONTIENE` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `IDCATEGORIA` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CREA`
--

DROP TABLE IF EXISTS `CREA`;
CREATE TABLE `CREA` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CREA`
--

INSERT INTO `CREA` (`ID`, `IDUSUARIO`, `IDPUBLICACION`, `FECHA`, `BAJA`) VALUES
(1, 6, 1, '2018-08-20 23:37:23', 0),
(2, 6, 2, '2018-08-21 00:21:43', 0),
(3, 6, 3, '2018-09-07 23:03:03', 0),
(4, 6, 4, '2018-09-08 00:54:11', 0),
(5, 6, 5, '2018-09-19 21:07:47', 0),
(6, 6, 6, '2018-09-19 21:14:47', 0),
(7, 6, 7, '2018-09-19 21:47:54', 0),
(8, 10, 8, '2018-10-08 21:42:54', 0),
(9, 6, 9, '2018-10-09 18:27:39', 0),
(10, 6, 10, '2018-10-31 22:59:15', 0),
(11, 6, 11, '2018-10-31 23:00:48', 0),
(12, 6, 12, '2019-01-14 23:32:09', 0),
(13, 16, 13, '2019-01-15 00:42:48', 0),
(14, 16, 14, '2019-01-15 00:44:32', 0),
(15, 17, 15, '2019-01-15 01:13:31', 0),
(16, 17, 16, '2019-01-15 01:14:40', 0),
(17, 18, 17, '2019-01-15 01:30:04', 0),
(18, 18, 18, '2019-01-15 01:31:13', 0),
(19, 19, 19, '2019-01-15 01:41:07', 0),
(20, 20, 20, '2019-01-15 01:46:34', 0),
(21, 20, 21, '2019-01-15 01:48:06', 0),
(22, 20, 22, '2019-01-15 01:55:31', 0),
(23, 20, 23, '2019-01-15 02:16:39', 0),
(24, 20, 24, '2019-01-15 02:18:42', 0),
(25, 22, 25, '2019-01-16 12:35:24', 0),
(26, 21, 26, '2019-01-16 12:45:21', 0),
(27, 6, 27, '2019-01-17 02:20:45', 0),
(28, 16, 28, '2019-01-20 09:58:49', 0),
(29, 16, 29, '2019-01-20 10:01:27', 0),
(30, 20, 30, '2019-01-20 10:20:30', 0),
(31, 20, 31, '2019-01-21 19:12:10', 0),
(32, 19, 32, '2019-01-21 19:16:30', 0),
(33, 16, 33, '2019-01-21 19:23:21', 0),
(34, 22, 34, '2019-01-21 19:35:32', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_BUSQUEDA_CATEGORIA`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_BUSQUEDA_CATEGORIA`;
CREATE TABLE `DATOS_BUSQUEDA_CATEGORIA` (
`USUARIO` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`ID` bigint(20) unsigned
,`TIPO` varchar(10)
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` timestamp
,`IDCATEGORIA` bigint(20) unsigned
,`CATTITULO` varchar(50)
,`CATID` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_BUSQUEDA_CATEGORIA_AUX01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_BUSQUEDA_CATEGORIA_AUX01`;
CREATE TABLE `DATOS_BUSQUEDA_CATEGORIA_AUX01` (
`USUARIO` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`ID` bigint(20) unsigned
,`TIPO` varchar(10)
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` timestamp
,`IDCATEGORIA` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PERSONA`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PERSONA`;
CREATE TABLE `DATOS_PERSONA` (
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
-- Estructura Stand-in para la vista `DATOS_PERSONA_AUX01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PERSONA_AUX01`;
CREATE TABLE `DATOS_PERSONA_AUX01` (
`ID` bigint(20) unsigned
,`VENTAS` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PERSONA_AUX02`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PERSONA_AUX02`;
CREATE TABLE `DATOS_PERSONA_AUX02` (
`IDUSUARIO` bigint(20) unsigned
,`NOTA` decimal(11,0)
,`CALIFICACION` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PERSONA_AUX03`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PERSONA_AUX03`;
CREATE TABLE `DATOS_PERSONA_AUX03` (
`ID` bigint(20) unsigned
,`CALIFICACION` bigint(21)
,`NOTA` decimal(11,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PRODUCTO`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PRODUCTO`;
CREATE TABLE `DATOS_PRODUCTO` (
`ID` bigint(20) unsigned
,`VISTO` int(11)
,`VENTAS` decimal(32,0)
,`PREGUNTAS` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PRODUCTO_AUX01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PRODUCTO_AUX01`;
CREATE TABLE `DATOS_PRODUCTO_AUX01` (
`IDPUBLICACION` bigint(20) unsigned
,`PREGUNTAS` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PRODUCTO_INDEX`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PRODUCTO_INDEX`;
CREATE TABLE `DATOS_PRODUCTO_INDEX` (
`USUARIO` bigint(20) unsigned
,`PNOMBRE` varchar(20)
,`PAPELLIDO` varchar(20)
,`ID` bigint(20) unsigned
,`TIPO` varchar(10)
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` timestamp
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PRODUCTO_OFERTA`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PRODUCTO_OFERTA`;
CREATE TABLE `DATOS_PRODUCTO_OFERTA` (
`ID` bigint(20) unsigned
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` timestamp
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PRODUCTO_VIP`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PRODUCTO_VIP`;
CREATE TABLE `DATOS_PRODUCTO_VIP` (
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
,`PREGUNTAS` int(11)
,`VISTO` int(11)
,`BAJA` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PUBLICACIONES`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PUBLICACIONES`;
CREATE TABLE `DATOS_PUBLICACIONES` (
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
,`PREGUNTAS` int(11)
,`VISTO` int(11)
,`BAJA` tinyint(1)
,`FAV` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOS_PUBLICACIONES_AUX01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `DATOS_PUBLICACIONES_AUX01`;
CREATE TABLE `DATOS_PUBLICACIONES_AUX01` (
`IDPUBLICACION` bigint(20) unsigned
,`FAV` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DENUNCIA`
--

DROP TABLE IF EXISTS `DENUNCIA`;
CREATE TABLE `DENUNCIA` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL,
  `TIPO` varchar(15) NOT NULL,
  `IDOBJETO` bigint(20) UNSIGNED NOT NULL,
  `COMENTARIO` varchar(150) DEFAULT NULL,
  `ESTADO` varchar(10) DEFAULT 'ACTIVA',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FACTURA`
--

DROP TABLE IF EXISTS `FACTURA`;
CREATE TABLE `FACTURA` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDCOMPRA` bigint(20) UNSIGNED NOT NULL,
  `FECHAC` datetime NOT NULL,
  `FECHAV` datetime NOT NULL,
  `ESTADO` varchar(15) NOT NULL,
  `SUBTOTAL` double(10,2) NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FAVORITO`
--

DROP TABLE IF EXISTS `FAVORITO`;
CREATE TABLE `FAVORITO` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `FAVORITO`
--

INSERT INTO `FAVORITO` (`IDUSUARIO`, `IDPUBLICACION`, `BAJA`) VALUES
(6, 13, 0),
(6, 14, 0),
(6, 15, 0),
(6, 16, 0),
(6, 17, 0),
(6, 18, 0),
(6, 20, 0),
(6, 23, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GESTIONA`
--

DROP TABLE IF EXISTS `GESTIONA`;
CREATE TABLE `GESTIONA` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDDENUNCIA` bigint(20) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` text,
  `HTML` text,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HISTORIAL`
--

DROP TABLE IF EXISTS `HISTORIAL`;
CREATE TABLE `HISTORIAL` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `USUARIO` varchar(15) NOT NULL,
  `ACCION` varchar(15) NOT NULL,
  `DESCRIPCCION` text NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PERMUTA`
--

DROP TABLE IF EXISTS `PERMUTA`;
CREATE TABLE `PERMUTA` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `ESTADO` varchar(15) DEFAULT 'ACTIVA',
  `FECHAP` datetime NOT NULL,
  `ACEPTADA` tinyint(1) DEFAULT '0',
  `FECHAC` datetime DEFAULT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PREGUNTA`
--

DROP TABLE IF EXISTS `PREGUNTA`;
CREATE TABLE `PREGUNTA` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `MENSAJE` varchar(150) NOT NULL,
  `FECHAM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RESPUESTA` varchar(150) DEFAULT NULL,
  `FECHAR` datetime DEFAULT NULL,
  `ESTADO` varchar(15) DEFAULT 'ACTIVO',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PREGUNTA`
--

INSERT INTO `PREGUNTA` (`ID`, `IDUSUARIO`, `IDPUBLICACION`, `MENSAJE`, `FECHAM`, `RESPUESTA`, `FECHAR`, `ESTADO`, `BAJA`) VALUES
(1, 13, 7, 'Hola, realizan cubre asientos para Hiunday grand I10? Cuál sería su precio? Gracias. ', '2018-10-15 18:19:40', NULL, NULL, 'ACTIVO', 0),
(2, 14, 7, 'me pasas la direccion exacta para ir a ver los modelos. Ademas te consulto , tiene tambien para cubrir el volante? gracias', '2018-10-15 18:19:40', 'Te comentamos que por cuestiones de las políticas de MercadoLibre, no podemos facilitarte esa información! - PARIS FUNDAS', '2018-10-15 14:03:00', 'ACTIVO', 0),
(3, 15, 7, 'Buenas noches , colocan fundas en eco-cuero a un kia rio sedan , y por favor cuanto es el costo ? muchas gracias.', '2018-10-15 18:19:40', NULL, NULL, 'ACTIVO', 0),
(4, 16, 7, 'Hola. Que es lo mejor que viene hoy en dia sin ser el eco-cuero, me incomoda la sensación de calor que me provoca este material, ya lo e comprobado', '2018-10-15 18:19:40', 'Hola, gracias por preguntar. El Neopreno es la mejor opción alternativa. Hacemos envíos al interior sin cobrar despacho. A las órdenes. - PARIS FUNDAS', '2018-10-15 14:03:00', 'ACTIVO', 0),
(5, 17, 7, 'Hola tengo un celta 2005. Cuanto seria los asientos de atrás más delanteros con logos...?', '2018-10-15 18:19:40', 'Hola, gracias por preguntar. En esta calidad el precio es de la publicación con logos delanteros, colocación sin costo, hecho enteramente a medida res', '2018-10-15 14:03:00', 'ACTIVO', 0),
(6, 18, 7, 'Hola buenas tardes para una seveiro g5 solo los de adela te cuanto me costaria ?gracias', '2018-10-15 18:19:40', NULL, NULL, 'ACTIVO', 0),
(12, 6, 7, 'hola', '2018-10-29 20:40:02', NULL, NULL, 'ACTIVO', 0),
(13, 6, 7, 'hola', '2018-10-29 20:40:10', NULL, NULL, 'ACTIVO', 0),
(14, 6, 7, 'puto', '2018-10-29 20:46:29', NULL, NULL, 'ACTIVO', 0),
(15, 6, 7, 'negro', '2018-10-29 21:01:08', NULL, NULL, 'ACTIVO', 0),
(16, 6, 7, 'cala boca', '2018-10-29 21:01:30', NULL, NULL, 'ACTIVO', 0),
(17, 6, 7, 'aaaa', '2018-10-29 21:05:42', NULL, NULL, 'ACTIVO', 0),
(18, 6, 7, 'aaaaasdas', '2018-10-29 21:06:09', NULL, NULL, 'ACTIVO', 0),
(19, 6, 7, 'ahora si Ã±eri', '2018-11-14 22:36:08', NULL, NULL, 'ACTIVO', 0),
(20, 19, 29, 'buenas a cuanto puedes bajar el precio publicado?', '2019-01-20 10:08:54', NULL, NULL, 'ACTIVO', 0),
(21, 19, 27, 'hola tenes kawa???', '2019-01-20 10:10:11', NULL, NULL, 'ACTIVO', 0),
(22, 19, 27, 'que costo la ninja???', '2019-01-20 10:10:27', NULL, NULL, 'ACTIVO', 0),
(23, 19, 24, 'afina bien ? esta en buen estado?', '2019-01-20 10:17:16', NULL, NULL, 'ACTIVO', 0),
(24, 19, 24, 'aceptas permuta?', '2019-01-20 10:17:30', NULL, NULL, 'ACTIVO', 0),
(25, 19, 22, 'aceptas permuta?', '2019-01-20 10:17:56', NULL, NULL, 'ACTIVO', 0),
(26, 20, 17, 'son de buena calidad?', '2019-01-20 10:22:01', NULL, NULL, 'ACTIVO', 0),
(27, 20, 14, 'aceptas permuta?', '2019-01-20 10:34:52', NULL, NULL, 'ACTIVO', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `PRUEBA`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `PRUEBA`;
CREATE TABLE `PRUEBA` (
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
,`PREGUNTAS` int(11)
,`VISTO` int(11)
,`BAJA` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PUBLICACION`
--

DROP TABLE IF EXISTS `PUBLICACION`;
CREATE TABLE `PUBLICACION` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IDCATEGORIA` bigint(20) UNSIGNED NOT NULL,
  `TITULO` varchar(50) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `IMGDEFAULT` varchar(50) DEFAULT 'noimage',
  `PRECIO` double(10,2) DEFAULT '1.00',
  `OFERTA` tinyint(1) DEFAULT '0',
  `DESCUENTO` int(11) DEFAULT '0',
  `FOFERTA` datetime DEFAULT NULL,
  `ESTADOP` varchar(10) DEFAULT 'PUBLICADA',
  `ESTADOA` varchar(10) DEFAULT 'NUEVO',
  `CANTIDAD` int(11) NOT NULL,
  `PREGUNTAS` int(11) NOT NULL DEFAULT '0',
  `VISTO` int(11) NOT NULL DEFAULT '0',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PUBLICACION`
--

INSERT INTO `PUBLICACION` (`ID`, `IDCATEGORIA`, `TITULO`, `DESCRIPCION`, `IMGDEFAULT`, `PRECIO`, `OFERTA`, `DESCUENTO`, `FOFERTA`, `ESTADOP`, `ESTADOA`, `CANTIDAD`, `PREGUNTAS`, `VISTO`, `BAJA`) VALUES
(1, 3, 'Publicacion 1', '&lt;p&gt;dasdasdas&amp;nbsp;&lt;strong&gt;sdasdsadsa&lt;/strong&gt;&amp;nbsp;sadasdsa&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;dasdsadsa&lt;/p&gt;\r\n', 'noimage', 1.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 2, 0),
(2, 7, 'Publicacion 1', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;ccedil;lk&amp;ntilde;ohujk&lt;/p&gt;\r\n', 'noimage', 1.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 2, 0),
(3, 7, 'Publicacion 2', '&lt;p&gt;soy una publicacion&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;CON Negrita&lt;/strong&gt;&lt;/p&gt;\r\n', 'noimage', 9000.00, 0, 0, NULL, 'BORRADOR', 'NUEVO', 1, 0, 11, 0),
(4, 3, 'Publicacion 8', '&lt;p&gt;ss&lt;/p&gt;\r\n', 'noimage', 1.00, 1, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 22, 0),
(5, 6, 'Publicacion prueba img def', '&lt;p&gt;Ficha t&amp;eacute;cnica&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;&lt;strong&gt;A&amp;ntilde;o&lt;/strong&gt;2004&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Kil&amp;oacute;metros&lt;/strong&gt;143.000 km&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Marca&lt;/strong&gt;Peugeot&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Modelo&lt;/strong&gt;206&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Versi&amp;oacute;n&lt;/strong&gt;1.4 Xr Confort&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Tipo&lt;/strong&gt;Hatchback&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Motor&lt;/strong&gt;1.4&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Potencia&lt;/strong&gt;75hp&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Transmisi&amp;oacute;n&lt;/strong&gt;Manual&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Color&lt;/strong&gt;Gris claro&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Tipo de combustible&lt;/strong&gt;Nafta&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Puertas&lt;/strong&gt;5&lt;/li&gt;\r\n	&lt;li&gt;&amp;nbsp;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Dimensiones y capacidades&lt;/p&gt;\r\n\r\n&lt;p&gt;Descripci&amp;oacute;n&lt;/p&gt;\r\n\r\n&lt;p&gt;Se vende Peugeot 206 1.4 XR Confort a&amp;ntilde;o 2004&lt;br /&gt;\r\n&lt;br /&gt;\r\nPapeles al d&amp;iacute;a pronto para transferir&lt;br /&gt;\r\n&lt;br /&gt;\r\nUltimo servicie a los 142.000 KMs:&lt;br /&gt;\r\nCambio de silenciador por catalizador&amp;nbsp;&lt;br /&gt;\r\nCambio de aceite sint&amp;eacute;tico (para 10.000km)&lt;br /&gt;\r\nCambio de rotulas y parrillas delanteras&lt;br /&gt;\r\nAlineaci&amp;oacute;n y balanceo&amp;nbsp;&lt;br /&gt;\r\n&lt;br /&gt;\r\nSe puede ver, probar y verlo con mec&amp;aacute;nico.&lt;br /&gt;\r\n&lt;br /&gt;\r\nPatente paga hasta 2019&lt;br /&gt;\r\n&lt;br /&gt;\r\nAuto en perfecto estado, se vende por problemas econ&amp;oacute;micos.&lt;/p&gt;\r\n\r\n&lt;p&gt;Peugeot 206 1.4 Xr Confort&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;/ul&gt;\r\n', 'noimage', 8500.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 3, 0),
(6, 6, 'Publicacion prueba imag def', '&lt;p&gt;Ficha t&amp;eacute;cnica&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;&lt;strong&gt;A&amp;ntilde;o&lt;/strong&gt;2004&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Kil&amp;oacute;metros&lt;/strong&gt;143.000 km&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Marca&lt;/strong&gt;Peugeot&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Modelo&lt;/strong&gt;206&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Versi&amp;oacute;n&lt;/strong&gt;1.4 Xr Confort&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Tipo&lt;/strong&gt;Hatchback&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Motor&lt;/strong&gt;1.4&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Potencia&lt;/strong&gt;75hp&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Transmisi&amp;oacute;n&lt;/strong&gt;Manual&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Color&lt;/strong&gt;Gris claro&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Tipo de combustible&lt;/strong&gt;Nafta&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Puertas&lt;/strong&gt;5&lt;/li&gt;\r\n	&lt;li&gt;&amp;nbsp;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Dimensiones y capacidades&lt;/p&gt;\r\n\r\n&lt;p&gt;Descripci&amp;oacute;n&lt;/p&gt;\r\n\r\n&lt;p&gt;Se vende Peugeot 206 1.4 XR Confort a&amp;ntilde;o 2004&lt;br /&gt;\r\n&lt;br /&gt;\r\nPapeles al d&amp;iacute;a pronto para transferir&lt;br /&gt;\r\n&lt;br /&gt;\r\nUltimo servicie a los 142.000 KMs:&lt;br /&gt;\r\nCambio de silenciador por catalizador&amp;nbsp;&lt;br /&gt;\r\nCambio de aceite sint&amp;eacute;tico (para 10.000km)&lt;br /&gt;\r\nCambio de rotulas y parrillas delanteras&lt;br /&gt;\r\nAlineaci&amp;oacute;n y balanceo&amp;nbsp;&lt;br /&gt;\r\n&lt;br /&gt;\r\nSe puede ver, probar y verlo con mec&amp;aacute;nico.&lt;br /&gt;\r\n&lt;br /&gt;\r\nPatente paga hasta 2019&lt;br /&gt;\r\n&lt;br /&gt;\r\nAuto en perfecto estado, se vende por problemas econ&amp;oacute;micos.&lt;/p&gt;\r\n\r\n&lt;p&gt;Peugeot 206 1.4 Xr Confort&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;/ul&gt;\r\n', 'cac52a444949121a2aafe68112507527', 8500.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 6, 0),
(7, 6, 'Peugeot 206', '&lt;p&gt;das&amp;ntilde;ldjasodjasf&lt;/p&gt;\r\n\r\n&lt;p&gt;sfjas&lt;/p&gt;\r\n\r\n&lt;p&gt;dfjlasdfj&lt;/p&gt;\r\n\r\n&lt;p&gt;asfasj&lt;/p&gt;\r\n\r\n&lt;p&gt;df&amp;ntilde;asd&amp;ntilde;f&lt;/p&gt;\r\n\r\n&lt;p&gt;sda&lt;/p&gt;\r\n', '88f7e8168033eeb1ba581a05a84d0a9f', 8500.00, 1, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 202, 0),
(8, 7, 'viagra', '&lt;p&gt;comete&amp;nbsp;&lt;strong&gt;ESTA&lt;/strong&gt; :D&lt;/p&gt;\r\n', '4ddffe797674bc65c838c845fef1a62d', 20.00, 0, 0, NULL, 'BORRADOR', 'NUEVO', 255, 0, 18, 0),
(9, 3, 'EL ale', '&lt;p&gt;hola&amp;nbsp;&lt;strong&gt;como&lt;/strong&gt; andas&lt;/p&gt;\r\n', '64d3a8943a67892111bb80d10d42cc33', 1.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 5, 0),
(10, 8, 'esae', '&lt;p&gt;esae&lt;/p&gt;\r\n', '9f50d6cb6511f9ec399aae66b731130e', 1.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 3, 0),
(11, 3, '1', '&lt;p&gt;1&lt;/p&gt;\r\n', '4067b5e3bdbe1485de2c23bf691c7373', 1.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 3, 0),
(12, 3, 'test123', '&lt;p&gt;soy una prueba&lt;/p&gt;\r\n', '9e09171baa4e2c812a9f66f08644ba9c', 1.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 30, 0),
(13, 9, 'Pelota Nike', '&lt;p&gt;Pelota de futbol nike, varios modelos disponibles.&lt;/p&gt;\r\n', '0461780ca0c86780ce13c17dbf5134f4', 1600.00, 0, 0, NULL, 'BORRADOR', 'NUEVO', 30, 0, 6, 0),
(14, 3, 'Banco de pecho', '&lt;p&gt;banco de pecho, incluye barra&amp;nbsp; y 50 kg en discos.&lt;/p&gt;\r\n', '7881634fe45554fdee79088c3c82c90e', 3900.00, 0, 0, NULL, 'BORRADOR', 'USADO', 2, 0, 8, 0),
(15, 14, 'Taladro inalambrico', '&lt;p&gt;Taladro inalambrico&amp;nbsp;marca slender.&lt;/p&gt;\r\n', '0ba52d7d3cb2577a2624474ce45c9132', 980.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 0, 36, 0),
(16, 14, 'Destorillador inalambrico', '&lt;p&gt;Destorillador inalambrico marca makita&lt;/p&gt;\r\n', '2566405112ac52452064d2b855953e7a', 1320.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 10, 0),
(17, 17, 'Guantes ejercicio', '&lt;p&gt;Guantes para entrenamiento, pesas.&lt;/p&gt;\r\n', 'b6d3a6aea8a57b8cfaebbf44037ec2b3', 730.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 6, 0, 6, 0),
(18, 17, 'Guantes levantamiento de pesas', '&lt;p&gt;guantes reforzados.&amp;nbsp;&lt;/p&gt;\r\n', 'bd080a019f66158ac22335f0661f191f', 1200.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 0, 4, 0),
(19, 17, 'Mancuernas', '&lt;p&gt;varias tipos y pesos disponibles.&lt;/p&gt;\r\n\r\n&lt;p&gt;El precio publicado es por el pack de seis, incluye seis mancuernas, dos de 1kg, dos de 2kg y dos de 4kg.&lt;/p&gt;\r\n', '664ba67a36d3b30c2b62cabfc621b8f3', 1340.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 30, 0, 3, 0),
(20, 15, 'Guitarra Electrica Ibanez Rg370', '&lt;p&gt;Guitarra Electrica Ibanez Rg370, nueva de paquete.&lt;/p&gt;\r\n', 'bd1c4184672232f3ded498d126de1cf7', 35500.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 7, 0),
(21, 15, 'Pedalera guitarra Boss me 70', '&lt;p&gt;Pedalera guitarra Boss me 70&lt;/p&gt;\r\n', 'bd1c4184672232f3ded498d126de1cf7', 5000.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 0, 3, 0),
(22, 15, 'Pedalera guitarra Boss me 70', '&lt;p&gt;Usada a toda prueba.&lt;/p&gt;\r\n', '158901d56f9917a9821a1dfe4a122650', 6500.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 5, 0),
(23, 15, 'Pedalera Line 6 ', '&lt;p&gt;Pedalera para guitarra, nueva.&lt;/p&gt;\r\n', '573576b22051066d8a557fc5f0ae0acb', 27000.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 4, 0),
(24, 15, 'Guitarra Fender Cd 60ce', '&lt;p&gt;Fender electroacustica&lt;/p&gt;\r\n', 'e7f6161d6872fef735454dd5261562f0', 15200.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 0, 4, 0),
(25, 14, 'Linterna ', '&lt;p&gt;Led&amp;nbsp; potencia&amp;nbsp;&lt;/p&gt;\r\n', '864fb3cca4125829a6c40f8d807eec72', 150.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 2, 0),
(26, 15, 'Paleta', '&lt;p&gt;Hshsh&lt;/p&gt;\r\n', '40d3695a8bc9d01d0940a76d40cf8f72', 900.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 0, 1, 0),
(27, 6, 'Se venden motos', '&lt;p&gt;se venden motos&lt;/p&gt;\r\n\r\n&lt;p&gt;las que quieras&lt;/p&gt;\r\n\r\n&lt;p&gt;contactame yaaaaa&lt;/p&gt;\r\n', '008e09b6f99a8fa9fefe6bfc923b9f1f', 30000.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 0, 8, 0),
(28, 9, 'Play Station 4', '&lt;p&gt;Play Station 4&lt;/p&gt;\r\n', 'e21b4022813c3483a0d2f3bea7f74b8b', 17.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 0, 1, 0),
(29, 9, 'PSP Go', '&lt;p&gt;PSP Go, nueva&lt;/p&gt;\r\n', '2bfe08d72a469d4d61cfa69d562a0e65', 6500.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 0, 5, 0),
(30, 9, 'Control xbox 360', '&lt;p&gt;Control xbox 360.&lt;/p&gt;\r\n', 'c57bd32bf8e13c12d90ddfbb35a46995', 1800.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 18, 0, 3, 0),
(31, 17, 'Raqueta Head', '&lt;p&gt;Head titanum nueva.&lt;/p&gt;\r\n', '38f08f2c515da95a5f567192f59dc23e', 2500.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 22, 0, 1, 0),
(32, 17, 'Raqueta De Ping Pong', '&lt;p&gt;BOER X6 Raqueta De Ping Pong&lt;/p&gt;\r\n', '5bbf3c2270ba249ff283e5adf478eda5', 1460.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 100, 0, 1, 0),
(33, 20, 'Medias para navidad', '&lt;p&gt;Para colgar en la estufa.&lt;/p&gt;\r\n', '5ec11dbe1dc16859ad0a15b622c39a38', 450.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 120, 0, 1, 0),
(34, 17, 'Bici santa cruz', '&lt;p&gt;Bici santa cruz usada pocas veces&lt;/p&gt;\r\n', '39355ba9af4a2004cb215d07bf5af69c', 9000.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PUBLICACIONIMG`
--

DROP TABLE IF EXISTS `PUBLICACIONIMG`;
CREATE TABLE `PUBLICACIONIMG` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IMAGENES` varchar(50) NOT NULL DEFAULT 'DEFAULT.JPG'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PUBLICACIONIMG`
--

INSERT INTO `PUBLICACIONIMG` (`ID`, `IMAGENES`) VALUES
(1, '5f9449ae3d9a59993fbba292223ca281'),
(2, 'd5cb6ed53edd7598910394d23eced911'),
(3, '6716e710c0507b3070e9b6052e6f4688'),
(3, '85eb9c4a70fb6a5d461fec02e24b7844'),
(3, 'b1973d44cdb39b3cf5e6dabb4c5c0118'),
(3, 'b5bd0d53ede3078f246634b2400cdd69'),
(3, 'd55a655e65640bb69c9433fcc6fda762'),
(4, '1e476113d3a7bf8a7d4e9d453f5b02ee'),
(4, '5968cc4e44a89acf39e90f5131147090'),
(4, 'a0e5f3a84fc05e3764b52a03ac84b53e'),
(4, 'dce3f1fe89d2c2b2a4d905b7173f6758'),
(4, 'fb53671b3e8dc3acaf6ac230cb57d767'),
(5, '1bce874c83ff78c21e9b1ab586bcdd0a'),
(5, '4e1593adaaa735ae959e3161716e437a'),
(5, '5f97451c7ca11283a60a4a735767fab6'),
(5, 'ab60536e1d72f42d08a5379b3769c484'),
(5, 'bb5e52468e3a7b7bf63ca549f00784ce'),
(6, '0a45fc639c0e45a266765dd4a0be2f14'),
(6, '0a4eae76690e6df46a1b57efd8e6379e'),
(6, '1604f617e0dd3cd574bc25d1f882d667'),
(6, '6f13fbefa9f3ec2ab15fef8ec934f358'),
(6, 'cac52a444949121a2aafe68112507527'),
(7, '20046ae1c0d6db5028a40d9699a4096b'),
(7, '447d53ef8c0cb5d2c1e16b335c837e87'),
(7, '627f0d4fbb1ca5ab524e0a525f6870ed'),
(7, '88f7e8168033eeb1ba581a05a84d0a9f'),
(7, 'b45b0a0fe242f99a616559ffd738e378'),
(8, '4ddffe797674bc65c838c845fef1a62d'),
(9, '64d3a8943a67892111bb80d10d42cc33'),
(10, '9f50d6cb6511f9ec399aae66b731130e'),
(11, '4067b5e3bdbe1485de2c23bf691c7373'),
(12, '9e09171baa4e2c812a9f66f08644ba9c'),
(13, '0461780ca0c86780ce13c17dbf5134f4'),
(13, '7eabb18e8174c0189363a554ff37503f'),
(13, '8485f05f16dfb4d4635808927a994738'),
(13, 'fc067a736706914982d9bfef058d5bf4'),
(14, '7881634fe45554fdee79088c3c82c90e'),
(14, '821d30cef9cd96e62c31d2c89253aef3'),
(15, '0ba52d7d3cb2577a2624474ce45c9132'),
(16, '2566405112ac52452064d2b855953e7a'),
(17, 'b6d3a6aea8a57b8cfaebbf44037ec2b3'),
(18, 'bd080a019f66158ac22335f0661f191f'),
(19, '664ba67a36d3b30c2b62cabfc621b8f3'),
(20, 'bd1c4184672232f3ded498d126de1cf7'),
(21, 'bd1c4184672232f3ded498d126de1cf7'),
(22, '158901d56f9917a9821a1dfe4a122650'),
(23, '573576b22051066d8a557fc5f0ae0acb'),
(24, 'e7f6161d6872fef735454dd5261562f0'),
(25, '864fb3cca4125829a6c40f8d807eec72'),
(26, '40d3695a8bc9d01d0940a76d40cf8f72'),
(27, '008e09b6f99a8fa9fefe6bfc923b9f1f'),
(28, 'e21b4022813c3483a0d2f3bea7f74b8b'),
(29, '2bfe08d72a469d4d61cfa69d562a0e65'),
(30, 'c57bd32bf8e13c12d90ddfbb35a46995'),
(31, '38f08f2c515da95a5f567192f59dc23e'),
(32, '5bbf3c2270ba249ff283e5adf478eda5'),
(33, '5ec11dbe1dc16859ad0a15b622c39a38'),
(34, '39355ba9af4a2004cb215d07bf5af69c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `REALIZA`
--

DROP TABLE IF EXISTS `REALIZA`;
CREATE TABLE `REALIZA` (
  `IDDENUNCIA` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

DROP TABLE IF EXISTS `USUARIO`;
CREATE TABLE `USUARIO` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `CEDULA` varchar(10) NOT NULL,
  `USUARIO` varchar(20) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `PASSWORDADM` varchar(50) DEFAULT NULL,
  `PNOMBRE` varchar(20) NOT NULL,
  `SNOMBRE` varchar(20) DEFAULT NULL,
  `PAPELLIDO` varchar(20) NOT NULL,
  `SAPELLIDO` varchar(20) DEFAULT NULL,
  `FNACIMIENTO` datetime NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CALLE` varchar(50) DEFAULT NULL,
  `NUMERO` int(11) DEFAULT NULL,
  `ESQUINA` varchar(50) DEFAULT NULL,
  `CPOSTAL` int(11) DEFAULT '0',
  `LOCALIDAD` varchar(50) DEFAULT NULL,
  `DEPARTAMENTO` varchar(50) DEFAULT NULL,
  `GEOX` varchar(15) DEFAULT NULL,
  `GEOY` varchar(15) DEFAULT NULL,
  `TIPO` varchar(10) DEFAULT 'COMUN',
  `ESTADO` varchar(50) DEFAULT 'CONFIRMAR EMAIL',
  `ACTIVACION` varchar(100) DEFAULT '1',
  `ROL` varchar(50) DEFAULT 'CLIENTE',
  `BAJA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`ID`, `CEDULA`, `USUARIO`, `PASSWORD`, `PASSWORDADM`, `PNOMBRE`, `SNOMBRE`, `PAPELLIDO`, `SAPELLIDO`, `FNACIMIENTO`, `EMAIL`, `CALLE`, `NUMERO`, `ESQUINA`, `CPOSTAL`, `LOCALIDAD`, `DEPARTAMENTO`, `GEOX`, `GEOY`, `TIPO`, `ESTADO`, `ACTIVACION`, `ROL`, `BAJA`) VALUES
(6, '51652357', 'gabobuceo', '4e4800c9e622ec10c62c4bf2ca9aa88136d88bdf', NULL, 'Gabriel', NULL, 'Fernandez', NULL, '1990-11-28 00:00:00', 'emgabo@gmail.com', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'VIP', 'RECUPERAR', '37c55379bdf99df28c82e96e6ba62d49d0644680', 'CLIENTE', 0),
(7, '46544017', 'lotar', 'b9b6db4b0fbca028512fba2db8015c9572c2c6c6', NULL, 'mataus', NULL, 'lotar', NULL, '1980-02-14 00:00:00', 'lotar@gmail.com', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'COMUN', 'CONFIRMAR EMAIL', '53f6ce85c5fda5259a8b43f87898803edc672b38', 'CLIENTE', 0),
(9, '32154641', 'kiko', '3b55b765725f874ac5421250a71175623ee325f9', NULL, 'kiko', NULL, 'loureiro', NULL, '1988-02-14 00:00:00', 'kiko@gmail.com', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'COMUN', 'CONFIRMAR EMAIL', '', 'CLIENTE', 0),
(10, '28186913', 'gabobuceo1', '4e4800c9e622ec10c62c4bf2ca9aa88136d88bdf', NULL, 'Ganzo', NULL, 'FEO', NULL, '1990-11-28 00:00:00', 'emgabo2@gmail.com', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'COMUN', 'CONFIRMAR EMAIL', '', 'CLIENTE', 0),
(12, '28186914', 'gfernandez', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'UTE', NULL, 'Fernandez', NULL, '1990-11-28 00:00:00', 'gfernandez@ceip.edu.uy', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'COMUN', 'CONFIRMAR EMAIL', '', 'CLIENTE', 0),
(13, '53373886', 'rmathis', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Rinah', NULL, 'Mathis', NULL, '0000-00-00 00:00:00', 'erat.eget.tincidunt@feugiat.org', 'Magariños Cervantes', 1930, 'Florencio Varela', 11600, 'Parque Batlle', 'Montevideo', '-34.890201', '-56.140479', 'COMUN', 'ACTIVADO', '0', 'MODERADOR', 0),
(14, '53367920', 'hgoodman', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Hope', NULL, 'Goodman', NULL, '0000-00-00 00:00:00', 'velit.Quisque.varius@luctussit.ca', 'Guadalupe', 1798, 'José L. Terra', 11800, 'Goes', 'Montevideo', '-34.879479', '-56.180132', 'VIP', 'ACTIVADO', '0', 'MODERADOR', 0),
(15, '52789056', 'iford', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Idola', NULL, 'Ford', NULL, '0000-00-00 00:00:00', 'nec.leo@CurabiturdictumPhasellus.com', 'Paraguay', 1104, 'Durazno', 11100, 'Barrio Sur', 'Montevideo', '-34.910560', '-56.191877', 'VIP', 'ACTIVADO', '0', 'ADMINISTRADOR', 0),
(16, '52651081', 'tsexton', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Tanisha', NULL, 'Sexton', NULL, '0000-00-00 00:00:00', 'felis.purus@tellus.net', 'Charcas', 2752, 'Costa de Marfil', 12800, 'Casabó', 'Montevideo', '-34.886466', '-56.271236', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(17, '52562268', 'dchurch', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Dillon', NULL, 'Church', NULL, '0000-00-00 00:00:00', 'eget.lacus@placerat.org', 'Dr Adolfo Pedralbes', 2351, 'Dr Luis Arcos Ferrand', 11400, 'Malvin Alto', 'Montevideo', '-34.874336', '-56.112215', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(18, '52393922', 'bbrady', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Blair', NULL, 'Brady', NULL, '0000-00-00 00:00:00', 'magna.Nam@Nullamvitaediam.ca', 'Río de Janeiro', 4032, 'Calle Las Canoas', 12800, 'Ciudad de la Costa', 'Departamento de Canelones', '-34.837539', '-55.984290', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(19, '52152922', 'hsummers', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Howard', NULL, 'Summers', NULL, '0000-00-00 00:00:00', 'elit.facilisi@nullaCras.net', 'Calle 2', 20, 'Calle 3', 80500, 'Ciudad del Plata', 'Departamento de San José', '-34.752014', '-56.423861', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(20, '51860497', 'thubbard', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Tanya', NULL, 'Hubbard', NULL, '0000-00-00 00:00:00', 'sapien@loremtristique.com', 'Av. Capitán Leal de Ibarra', 5545, 'Capitán Pedro de Mesa y Castro', 12800, 'Pajas Blancas', 'Montevideo', '-34.866848', '-56.335528', 'COMUN', 'ACTIVADO', '0', 'CLIENTE', 0),
(21, '51716911', 'hgibbs', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Harriet', NULL, 'Gibbs', NULL, '0000-00-00 00:00:00', 'vitae.dolor@dolornonummy.co.uk', 'Juan Russi', 331, 'Javier de Viana', 15900, 'La Paz', 'Departamento de Canelones', '-34.760102', '-56.235463', 'VIP', 'ACTIVADO', '0', 'CLIENTE', 0),
(22, '51712727', 'sknox', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', NULL, 'Scarlet', NULL, 'Knox', NULL, '0000-00-00 00:00:00', 'Nunc@euaccumsan.net', 'Pasaje F', 1425, 'Pasaje E', 12400, 'Asentamiento 21 de Enero', 'Montevideo', '-34.799185', '-56.171684', 'VIP', 'ACTIVADO', '0', 'CLIENTE', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOTEL`
--

DROP TABLE IF EXISTS `USUARIOTEL`;
CREATE TABLE `USUARIOTEL` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `TELEFONO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_BUSQUEDA_CATEGORIA`
--
DROP TABLE IF EXISTS `DATOS_BUSQUEDA_CATEGORIA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_BUSQUEDA_CATEGORIA`  AS  select `TT`.`USUARIO` AS `USUARIO`,`TT`.`PNOMBRE` AS `PNOMBRE`,`TT`.`PAPELLIDO` AS `PAPELLIDO`,`TT`.`ID` AS `ID`,`TT`.`TIPO` AS `TIPO`,`TT`.`IMGDEFAULT` AS `IMGDEFAULT`,`TT`.`PRECIO` AS `PRECIO`,`TT`.`TITULO` AS `TITULO`,`TT`.`FECHA` AS `FECHA`,`TT`.`IDCATEGORIA` AS `IDCATEGORIA`,`CATEGORIA`.`TITULO` AS `CATTITULO`,`CATEGORIA`.`ID` AS `CATID` from (`CATEGORIA` left join `DATOS_BUSQUEDA_CATEGORIA_AUX01` `TT` on((`CATEGORIA`.`ID` = `TT`.`IDCATEGORIA`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_BUSQUEDA_CATEGORIA_AUX01`
--
DROP TABLE IF EXISTS `DATOS_BUSQUEDA_CATEGORIA_AUX01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_BUSQUEDA_CATEGORIA_AUX01`  AS  select `U`.`USUARIO` AS `USUARIO`,`U`.`PNOMBRE` AS `PNOMBRE`,`U`.`PAPELLIDO` AS `PAPELLIDO`,`U`.`ID` AS `ID`,`U`.`TIPO` AS `TIPO`,`U`.`IMGDEFAULT` AS `IMGDEFAULT`,`U`.`PRECIO` AS `PRECIO`,`U`.`TITULO` AS `TITULO`,`U`.`FECHA` AS `FECHA`,`P`.`IDCATEGORIA` AS `IDCATEGORIA` from (`DATOS_PRODUCTO_INDEX` `U` left join `PUBLICACION` `P` on((`U`.`ID` = `P`.`ID`))) group by `U`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PERSONA`
--
DROP TABLE IF EXISTS `DATOS_PERSONA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PERSONA`  AS  select `U`.`ID` AS `ID`,`U`.`PNOMBRE` AS `PNOMBRE`,`U`.`PAPELLIDO` AS `PAPELLIDO`,count(`CR`.`IDPUBLICACION`) AS `PUBLICACIONES`,`TT`.`VENTAS` AS `VENTAS`,`TT2`.`CALIFICACION` AS `CALIFICACION`,`TT2`.`NOTA` AS `NOTA` from (((`USUARIO` `U` left join `CREA` `CR` on((`U`.`ID` = `CR`.`IDUSUARIO`))) left join `DATOS_PERSONA_AUX01` `TT` on((`U`.`ID` = `TT`.`ID`))) left join `DATOS_PERSONA_AUX03` `TT2` on((`U`.`ID` = `TT2`.`ID`))) group by `U`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PERSONA_AUX01`
--
DROP TABLE IF EXISTS `DATOS_PERSONA_AUX01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PERSONA_AUX01`  AS  select `U`.`ID` AS `ID`,sum(`CO`.`CANTIDAD`) AS `VENTAS` from (`USUARIO` `U` left join `COMPRA` `CO` on((`U`.`ID` = `CO`.`IDUSUARIO`))) group by `U`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PERSONA_AUX02`
--
DROP TABLE IF EXISTS `DATOS_PERSONA_AUX02`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PERSONA_AUX02`  AS  select `CR`.`IDUSUARIO` AS `IDUSUARIO`,round(avg(`CO`.`CALIFICACION`),0) AS `NOTA`,count(`CO`.`CALIFICACION`) AS `CALIFICACION` from (`CREA` `CR` join `COMPRA` `CO`) where (`CR`.`IDPUBLICACION` = `CO`.`IDPUBLICACION`) group by `CR`.`IDUSUARIO` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PERSONA_AUX03`
--
DROP TABLE IF EXISTS `DATOS_PERSONA_AUX03`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PERSONA_AUX03`  AS  select `U`.`ID` AS `ID`,`TT`.`CALIFICACION` AS `CALIFICACION`,`TT`.`NOTA` AS `NOTA` from (`USUARIO` `U` left join `DATOS_PERSONA_AUX02` `TT` on((`U`.`ID` = `TT`.`IDUSUARIO`))) group by `U`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PRODUCTO`
--
DROP TABLE IF EXISTS `DATOS_PRODUCTO`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PRODUCTO`  AS  select `P`.`ID` AS `ID`,`P`.`VISTO` AS `VISTO`,sum(`CO`.`CANTIDAD`) AS `VENTAS`,`CM`.`PREGUNTAS` AS `PREGUNTAS` from ((`PUBLICACION` `P` left join `COMPRA` `CO` on((`P`.`ID` = `CO`.`IDPUBLICACION`))) left join `DATOS_PRODUCTO_AUX01` `CM` on((`P`.`ID` = `CM`.`IDPUBLICACION`))) group by `P`.`ID` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PRODUCTO_AUX01`
--
DROP TABLE IF EXISTS `DATOS_PRODUCTO_AUX01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PRODUCTO_AUX01`  AS  select `PREGUNTA`.`IDPUBLICACION` AS `IDPUBLICACION`,count(`PREGUNTA`.`ID`) AS `PREGUNTAS` from `PREGUNTA` group by `PREGUNTA`.`IDPUBLICACION` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PRODUCTO_INDEX`
--
DROP TABLE IF EXISTS `DATOS_PRODUCTO_INDEX`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PRODUCTO_INDEX`  AS  select `U`.`ID` AS `USUARIO`,`U`.`PNOMBRE` AS `PNOMBRE`,`U`.`PAPELLIDO` AS `PAPELLIDO`,`P`.`ID` AS `ID`,`U`.`TIPO` AS `TIPO`,`P`.`IMGDEFAULT` AS `IMGDEFAULT`,`P`.`PRECIO` AS `PRECIO`,`P`.`TITULO` AS `TITULO`,`C`.`FECHA` AS `FECHA` from ((`USUARIO` `U` join `CREA` `C`) join `PUBLICACION` `P`) where ((`U`.`ID` = `C`.`IDUSUARIO`) and (`C`.`IDPUBLICACION` = `P`.`ID`)) order by `U`.`TIPO` desc,rand() ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PRODUCTO_OFERTA`
--
DROP TABLE IF EXISTS `DATOS_PRODUCTO_OFERTA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PRODUCTO_OFERTA`  AS  select `P`.`ID` AS `ID`,`P`.`IMGDEFAULT` AS `IMGDEFAULT`,`P`.`PRECIO` AS `PRECIO`,`P`.`TITULO` AS `TITULO`,`C`.`FECHA` AS `FECHA` from (`CREA` `C` join `PUBLICACION` `P`) where ((`P`.`OFERTA` = '1') and (`C`.`IDPUBLICACION` = `P`.`ID`)) order by rand() limit 8 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PRODUCTO_VIP`
--
DROP TABLE IF EXISTS `DATOS_PRODUCTO_VIP`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PRODUCTO_VIP`  AS  select `U`.`ID` AS `USUARIO`,`P`.`ID` AS `ID`,`P`.`IDCATEGORIA` AS `IDCATEGORIA`,`P`.`TITULO` AS `TITULO`,`P`.`DESCRIPCION` AS `DESCRIPCION`,`P`.`IMGDEFAULT` AS `IMGDEFAULT`,`P`.`PRECIO` AS `PRECIO`,`P`.`OFERTA` AS `OFERTA`,`P`.`DESCUENTO` AS `DESCUENTO`,`P`.`FOFERTA` AS `FOFERTA`,`P`.`ESTADOP` AS `ESTADOP`,`P`.`ESTADOA` AS `ESTADOA`,`P`.`CANTIDAD` AS `CANTIDAD`,`P`.`PREGUNTAS` AS `PREGUNTAS`,`P`.`VISTO` AS `VISTO`,`P`.`BAJA` AS `BAJA` from ((`USUARIO` `U` join `CREA` `C`) join `PUBLICACION` `P`) where ((`U`.`ID` = `C`.`IDUSUARIO`) and (`C`.`IDPUBLICACION` = `P`.`ID`) and (`U`.`TIPO` = 'VIP')) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PUBLICACIONES`
--
DROP TABLE IF EXISTS `DATOS_PUBLICACIONES`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PUBLICACIONES`  AS  select `PUBLICACION`.`ID` AS `ID`,`PUBLICACION`.`IDCATEGORIA` AS `IDCATEGORIA`,`PUBLICACION`.`TITULO` AS `TITULO`,`PUBLICACION`.`DESCRIPCION` AS `DESCRIPCION`,`PUBLICACION`.`IMGDEFAULT` AS `IMGDEFAULT`,`PUBLICACION`.`PRECIO` AS `PRECIO`,`PUBLICACION`.`OFERTA` AS `OFERTA`,`PUBLICACION`.`DESCUENTO` AS `DESCUENTO`,`PUBLICACION`.`FOFERTA` AS `FOFERTA`,`PUBLICACION`.`ESTADOP` AS `ESTADOP`,`PUBLICACION`.`ESTADOA` AS `ESTADOA`,`PUBLICACION`.`CANTIDAD` AS `CANTIDAD`,`PUBLICACION`.`PREGUNTAS` AS `PREGUNTAS`,`PUBLICACION`.`VISTO` AS `VISTO`,`PUBLICACION`.`BAJA` AS `BAJA`,`DATOS_PUBLICACIONES_AUX01`.`FAV` AS `FAV` from (`PUBLICACION` left join `DATOS_PUBLICACIONES_AUX01` on((`PUBLICACION`.`ID` = `DATOS_PUBLICACIONES_AUX01`.`IDPUBLICACION`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `DATOS_PUBLICACIONES_AUX01`
--
DROP TABLE IF EXISTS `DATOS_PUBLICACIONES_AUX01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOS_PUBLICACIONES_AUX01`  AS  select `FAVORITO`.`IDPUBLICACION` AS `IDPUBLICACION`,count(`FAVORITO`.`IDUSUARIO`) AS `FAV` from `FAVORITO` group by `FAVORITO`.`IDPUBLICACION` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `PRUEBA`
--
DROP TABLE IF EXISTS `PRUEBA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `PRUEBA`  AS  select `PUBLICACION`.`ID` AS `ID`,`PUBLICACION`.`IDCATEGORIA` AS `IDCATEGORIA`,`PUBLICACION`.`TITULO` AS `TITULO`,`PUBLICACION`.`DESCRIPCION` AS `DESCRIPCION`,`PUBLICACION`.`IMGDEFAULT` AS `IMGDEFAULT`,`PUBLICACION`.`PRECIO` AS `PRECIO`,`PUBLICACION`.`OFERTA` AS `OFERTA`,`PUBLICACION`.`DESCUENTO` AS `DESCUENTO`,`PUBLICACION`.`FOFERTA` AS `FOFERTA`,`PUBLICACION`.`ESTADOP` AS `ESTADOP`,`PUBLICACION`.`ESTADOA` AS `ESTADOA`,`PUBLICACION`.`CANTIDAD` AS `CANTIDAD`,`PUBLICACION`.`PREGUNTAS` AS `PREGUNTAS`,`PUBLICACION`.`VISTO` AS `VISTO`,`PUBLICACION`.`BAJA` AS `BAJA` from `PUBLICACION` order by rand() limit 0,10 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `TITULO` (`TITULO`);

--
-- Indices de la tabla `COMPRA`
--
ALTER TABLE `COMPRA`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`,`FECHACOMPRA`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `CONTIENE`
--
ALTER TABLE `CONTIENE`
  ADD PRIMARY KEY (`ID`,`IDPUBLICACION`,`IDCATEGORIA`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`),
  ADD KEY `IDCATEGORIA` (`IDCATEGORIA`);

--
-- Indices de la tabla `CREA`
--
ALTER TABLE `CREA`
  ADD PRIMARY KEY (`ID`,`IDUSUARIO`,`IDPUBLICACION`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `DENUNCIA`
--
ALTER TABLE `DENUNCIA`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDOBJETO` (`IDOBJETO`);

--
-- Indices de la tabla `FACTURA`
--
ALTER TABLE `FACTURA`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `FAVORITO`
--
ALTER TABLE `FAVORITO`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `GESTIONA`
--
ALTER TABLE `GESTIONA`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDDENUNCIA`),
  ADD KEY `IDDENUNCIA` (`IDDENUNCIA`);

--
-- Indices de la tabla `HISTORIAL`
--
ALTER TABLE `HISTORIAL`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `PERMUTA`
--
ALTER TABLE `PERMUTA`
  ADD PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `PREGUNTA`
--
ALTER TABLE `PREGUNTA`
  ADD PRIMARY KEY (`ID`,`IDUSUARIO`,`IDPUBLICACION`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`),
  ADD KEY `IDPUBLICACION` (`IDPUBLICACION`);

--
-- Indices de la tabla `PUBLICACION`
--
ALTER TABLE `PUBLICACION`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `TITULO` (`TITULO`),
  ADD KEY `IDCATEGORIA` (`IDCATEGORIA`);

--
-- Indices de la tabla `PUBLICACIONIMG`
--
ALTER TABLE `PUBLICACIONIMG`
  ADD PRIMARY KEY (`ID`,`IMAGENES`);

--
-- Indices de la tabla `REALIZA`
--
ALTER TABLE `REALIZA`
  ADD PRIMARY KEY (`IDDENUNCIA`,`IDUSUARIO`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `CEDULA` (`CEDULA`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `CEDULA_2` (`CEDULA`),
  ADD KEY `USUARIO_2` (`USUARIO`);

--
-- Indices de la tabla `USUARIOTEL`
--
ALTER TABLE `USUARIOTEL`
  ADD PRIMARY KEY (`ID`,`TELEFONO`),
  ADD UNIQUE KEY `TELEFONO` (`TELEFONO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `CONTIENE`
--
ALTER TABLE `CONTIENE`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CREA`
--
ALTER TABLE `CREA`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `DENUNCIA`
--
ALTER TABLE `DENUNCIA`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `FACTURA`
--
ALTER TABLE `FACTURA`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `HISTORIAL`
--
ALTER TABLE `HISTORIAL`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PREGUNTA`
--
ALTER TABLE `PREGUNTA`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `PUBLICACION`
--
ALTER TABLE `PUBLICACION`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `COMPRA`
--
ALTER TABLE `COMPRA`
  ADD CONSTRAINT `COMPRA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `COMPRA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `PUBLICACION` (`ID`);

--
-- Filtros para la tabla `CONTIENE`
--
ALTER TABLE `CONTIENE`
  ADD CONSTRAINT `CONTIENE_IBFK_1` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `PUBLICACION` (`ID`),
  ADD CONSTRAINT `CONTIENE_IBFK_2` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `CATEGORIA` (`ID`);

--
-- Filtros para la tabla `CREA`
--
ALTER TABLE `CREA`
  ADD CONSTRAINT `CREA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `CREA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `PUBLICACION` (`ID`);

--
-- Filtros para la tabla `FAVORITO`
--
ALTER TABLE `FAVORITO`
  ADD CONSTRAINT `FAVORITO_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `FAVORITO_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `PUBLICACION` (`ID`);

--
-- Filtros para la tabla `GESTIONA`
--
ALTER TABLE `GESTIONA`
  ADD CONSTRAINT `GESTIONA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `GESTIONA_IBFK_2` FOREIGN KEY (`IDDENUNCIA`) REFERENCES `DENUNCIA` (`ID`);

--
-- Filtros para la tabla `PERMUTA`
--
ALTER TABLE `PERMUTA`
  ADD CONSTRAINT `PERMUTA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `PERMUTA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `PUBLICACION` (`ID`);

--
-- Filtros para la tabla `PREGUNTA`
--
ALTER TABLE `PREGUNTA`
  ADD CONSTRAINT `PREGUNTA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `PREGUNTA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `PUBLICACION` (`ID`);

--
-- Filtros para la tabla `PUBLICACION`
--
ALTER TABLE `PUBLICACION`
  ADD CONSTRAINT `PUBLICACION_IBFK_1` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `CATEGORIA` (`ID`);

--
-- Filtros para la tabla `PUBLICACIONIMG`
--
ALTER TABLE `PUBLICACIONIMG`
  ADD CONSTRAINT `PUBLICACIONIMG_IBFK_1` FOREIGN KEY (`ID`) REFERENCES `PUBLICACION` (`ID`);

--
-- Filtros para la tabla `REALIZA`
--
ALTER TABLE `REALIZA`
  ADD CONSTRAINT `REALIZA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`ID`),
  ADD CONSTRAINT `REALIZA_IBFK_2` FOREIGN KEY (`IDDENUNCIA`) REFERENCES `DENUNCIA` (`ID`);

--
-- Filtros para la tabla `USUARIOTEL`
--
ALTER TABLE `USUARIOTEL`
  ADD CONSTRAINT `USUARIOTEL_IBFK_1` FOREIGN KEY (`ID`) REFERENCES `USUARIO` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
