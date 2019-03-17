-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2019 a las 20:54:51
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
CREATE DATABASE IF NOT EXISTS `ninjadatos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ninjadatos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(50) NOT NULL,
  `PADRE` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `TITULO` (`TITULO`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `FECHACOMPRA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CONCRETADO` tinyint(1) DEFAULT '0',
  `FECHACONCRETADO` datetime DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT '1',
  `TOTAL` double(10,2) NOT NULL,
  `COMISION` double(10,2) NOT NULL,
  `CALIFICACION` int(11) DEFAULT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`,`FECHACOMPRA`),
  UNIQUE KEY `ID` (`ID`),
  KEY `IDPUBLICACION` (`IDPUBLICACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE IF NOT EXISTS `contiene` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `IDCATEGORIA` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`,`IDPUBLICACION`,`IDCATEGORIA`),
  UNIQUE KEY `ID` (`ID`),
  KEY `IDPUBLICACION` (`IDPUBLICACION`),
  KEY `IDCATEGORIA` (`IDCATEGORIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crea`
--

DROP TABLE IF EXISTS `crea`;
CREATE TABLE IF NOT EXISTS `crea` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`,`IDUSUARIO`,`IDPUBLICACION`),
  UNIQUE KEY `ID` (`ID`),
  KEY `IDUSUARIO` (`IDUSUARIO`),
  KEY `IDPUBLICACION` (`IDPUBLICACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_busqueda_categoria`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_busqueda_categoria`;
CREATE TABLE IF NOT EXISTS `datos_busqueda_categoria` (
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
-- Estructura Stand-in para la vista `datos_busqueda_categoria_aux01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_busqueda_categoria_aux01`;
CREATE TABLE IF NOT EXISTS `datos_busqueda_categoria_aux01` (
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
-- Estructura Stand-in para la vista `datos_compras`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_compras`;
CREATE TABLE IF NOT EXISTS `datos_compras` (
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
CREATE TABLE IF NOT EXISTS `datos_persona` (
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
CREATE TABLE IF NOT EXISTS `datos_persona_aux01` (
`ID` bigint(20) unsigned
,`VENTAS` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_persona_aux02`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_persona_aux02`;
CREATE TABLE IF NOT EXISTS `datos_persona_aux02` (
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
CREATE TABLE IF NOT EXISTS `datos_persona_aux03` (
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
CREATE TABLE IF NOT EXISTS `datos_producto` (
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
CREATE TABLE IF NOT EXISTS `datos_producto_aux01` (
`IDPUBLICACION` bigint(20) unsigned
,`PREGUNTAS` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto_index`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_index`;
CREATE TABLE IF NOT EXISTS `datos_producto_index` (
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
-- Estructura Stand-in para la vista `datos_producto_oferta`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_oferta`;
CREATE TABLE IF NOT EXISTS `datos_producto_oferta` (
`ID` bigint(20) unsigned
,`IMGDEFAULT` varchar(50)
,`PRECIO` double(10,2)
,`TITULO` varchar(50)
,`FECHA` timestamp
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_producto_vip`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_producto_vip`;
CREATE TABLE IF NOT EXISTS `datos_producto_vip` (
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
-- Estructura Stand-in para la vista `datos_publicaciones`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_publicaciones`;
CREATE TABLE IF NOT EXISTS `datos_publicaciones` (
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
-- Estructura Stand-in para la vista `datos_publicaciones_aux01`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `datos_publicaciones_aux01`;
CREATE TABLE IF NOT EXISTS `datos_publicaciones_aux01` (
`IDPUBLICACION` bigint(20) unsigned
,`FAV` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia`
--

DROP TABLE IF EXISTS `denuncia`;
CREATE TABLE IF NOT EXISTS `denuncia` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `FECHA` datetime NOT NULL,
  `TIPO` varchar(15) NOT NULL,
  `IDOBJETO` bigint(20) UNSIGNED NOT NULL,
  `COMENTARIO` varchar(150) DEFAULT NULL,
  `ESTADO` varchar(10) DEFAULT 'ACTIVA',
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `IDOBJETO` (`IDOBJETO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDCOMPRA` bigint(20) UNSIGNED NOT NULL,
  `FECHAC` datetime NOT NULL,
  `FECHAV` datetime NOT NULL,
  `ESTADO` varchar(15) NOT NULL,
  `SUBTOTAL` double(10,2) NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

DROP TABLE IF EXISTS `favorito`;
CREATE TABLE IF NOT EXISTS `favorito` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`),
  KEY `IDPUBLICACION` (`IDPUBLICACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiona`
--

DROP TABLE IF EXISTS `gestiona`;
CREATE TABLE IF NOT EXISTS `gestiona` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDDENUNCIA` bigint(20) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` text,
  `HTML` text,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IDUSUARIO`,`IDDENUNCIA`),
  KEY `IDDENUNCIA` (`IDDENUNCIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(15) NOT NULL,
  `ACCION` varchar(15) NOT NULL,
  `DESCRIPCCION` text NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `USUARIO` (`USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permuta`
--

DROP TABLE IF EXISTS `permuta`;
CREATE TABLE IF NOT EXISTS `permuta` (
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `ESTADO` varchar(15) DEFAULT 'ACTIVA',
  `FECHAP` datetime NOT NULL,
  `ACEPTADA` tinyint(1) DEFAULT '0',
  `FECHAC` datetime DEFAULT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IDUSUARIO`,`IDPUBLICACION`),
  KEY `IDPUBLICACION` (`IDPUBLICACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `IDPUBLICACION` bigint(20) UNSIGNED NOT NULL,
  `MENSAJE` varchar(150) NOT NULL,
  `FECHAM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RESPUESTA` varchar(150) DEFAULT NULL,
  `FECHAR` datetime DEFAULT NULL,
  `ESTADO` varchar(15) DEFAULT 'ACTIVO',
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`,`IDUSUARIO`,`IDPUBLICACION`),
  UNIQUE KEY `ID` (`ID`),
  KEY `IDUSUARIO` (`IDUSUARIO`),
  KEY `IDPUBLICACION` (`IDPUBLICACION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `prueba`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `prueba`;
CREATE TABLE IF NOT EXISTS `prueba` (
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
-- Estructura de tabla para la tabla `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
CREATE TABLE IF NOT EXISTS `publicacion` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `TITULO` (`TITULO`),
  KEY `IDCATEGORIA` (`IDCATEGORIA`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacionimg`
--

DROP TABLE IF EXISTS `publicacionimg`;
CREATE TABLE IF NOT EXISTS `publicacionimg` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `IMAGENES` varchar(50) NOT NULL DEFAULT 'DEFAULT.JPG',
  PRIMARY KEY (`ID`,`IMAGENES`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

DROP TABLE IF EXISTS `realiza`;
CREATE TABLE IF NOT EXISTS `realiza` (
  `IDDENUNCIA` bigint(20) UNSIGNED NOT NULL,
  `IDUSUARIO` bigint(20) UNSIGNED NOT NULL,
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IDDENUNCIA`,`IDUSUARIO`),
  KEY `IDUSUARIO` (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `BAJA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `CEDULA` (`CEDULA`),
  UNIQUE KEY `USUARIO` (`USUARIO`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  KEY `CEDULA_2` (`CEDULA`),
  KEY `USUARIO_2` (`USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariotel`
--

DROP TABLE IF EXISTS `usuariotel`;
CREATE TABLE IF NOT EXISTS `usuariotel` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `TELEFONO` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`,`TELEFONO`),
  UNIQUE KEY `TELEFONO` (`TELEFONO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_producto_vip`  AS  select `u`.`ID` AS `USUARIO`,`p`.`ID` AS `ID`,`p`.`IDCATEGORIA` AS `IDCATEGORIA`,`p`.`TITULO` AS `TITULO`,`p`.`DESCRIPCION` AS `DESCRIPCION`,`p`.`IMGDEFAULT` AS `IMGDEFAULT`,`p`.`PRECIO` AS `PRECIO`,`p`.`OFERTA` AS `OFERTA`,`p`.`DESCUENTO` AS `DESCUENTO`,`p`.`FOFERTA` AS `FOFERTA`,`p`.`ESTADOP` AS `ESTADOP`,`p`.`ESTADOA` AS `ESTADOA`,`p`.`CANTIDAD` AS `CANTIDAD`,`p`.`PREGUNTAS` AS `PREGUNTAS`,`p`.`VISTO` AS `VISTO`,`p`.`BAJA` AS `BAJA` from ((`usuario` `u` join `crea` `c`) join `publicacion` `p`) where ((`u`.`ID` = `c`.`IDUSUARIO`) and (`c`.`IDPUBLICACION` = `p`.`ID`) and (`u`.`TIPO` = 'VIP')) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_publicaciones`
--
DROP TABLE IF EXISTS `datos_publicaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_publicaciones`  AS  select `publicacion`.`ID` AS `ID`,`publicacion`.`IDCATEGORIA` AS `IDCATEGORIA`,`publicacion`.`TITULO` AS `TITULO`,`publicacion`.`DESCRIPCION` AS `DESCRIPCION`,`publicacion`.`IMGDEFAULT` AS `IMGDEFAULT`,`publicacion`.`PRECIO` AS `PRECIO`,`publicacion`.`OFERTA` AS `OFERTA`,`publicacion`.`DESCUENTO` AS `DESCUENTO`,`publicacion`.`FOFERTA` AS `FOFERTA`,`publicacion`.`ESTADOP` AS `ESTADOP`,`publicacion`.`ESTADOA` AS `ESTADOA`,`publicacion`.`CANTIDAD` AS `CANTIDAD`,`publicacion`.`PREGUNTAS` AS `PREGUNTAS`,`publicacion`.`VISTO` AS `VISTO`,`publicacion`.`BAJA` AS `BAJA`,`datos_publicaciones_aux01`.`FAV` AS `FAV` from (`publicacion` left join `datos_publicaciones_aux01` on((`publicacion`.`ID` = `datos_publicaciones_aux01`.`IDPUBLICACION`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_publicaciones_aux01`
--
DROP TABLE IF EXISTS `datos_publicaciones_aux01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datos_publicaciones_aux01`  AS  select `favorito`.`IDPUBLICACION` AS `IDPUBLICACION`,count(`favorito`.`IDUSUARIO`) AS `FAV` from `favorito` group by `favorito`.`IDPUBLICACION` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `prueba`
--
DROP TABLE IF EXISTS `prueba`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prueba`  AS  select `publicacion`.`ID` AS `ID`,`publicacion`.`IDCATEGORIA` AS `IDCATEGORIA`,`publicacion`.`TITULO` AS `TITULO`,`publicacion`.`DESCRIPCION` AS `DESCRIPCION`,`publicacion`.`IMGDEFAULT` AS `IMGDEFAULT`,`publicacion`.`PRECIO` AS `PRECIO`,`publicacion`.`OFERTA` AS `OFERTA`,`publicacion`.`DESCUENTO` AS `DESCUENTO`,`publicacion`.`FOFERTA` AS `FOFERTA`,`publicacion`.`ESTADOP` AS `ESTADOP`,`publicacion`.`ESTADOA` AS `ESTADOA`,`publicacion`.`CANTIDAD` AS `CANTIDAD`,`publicacion`.`PREGUNTAS` AS `PREGUNTAS`,`publicacion`.`VISTO` AS `VISTO`,`publicacion`.`BAJA` AS `BAJA` from `publicacion` order by rand() limit 0,10 ;

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
  ADD CONSTRAINT `CONTIENE_IBFK_1` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`),
  ADD CONSTRAINT `CONTIENE_IBFK_2` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `categoria` (`ID`);

--
-- Filtros para la tabla `crea`
--
ALTER TABLE `crea`
  ADD CONSTRAINT `CREA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `CREA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `FAVORITO_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `FAVORITO_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `gestiona`
--
ALTER TABLE `gestiona`
  ADD CONSTRAINT `GESTIONA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `GESTIONA_IBFK_2` FOREIGN KEY (`IDDENUNCIA`) REFERENCES `denuncia` (`ID`);

--
-- Filtros para la tabla `permuta`
--
ALTER TABLE `permuta`
  ADD CONSTRAINT `PERMUTA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `PERMUTA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `PREGUNTA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `PREGUNTA_IBFK_2` FOREIGN KEY (`IDPUBLICACION`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `PUBLICACION_IBFK_1` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `categoria` (`ID`);

--
-- Filtros para la tabla `publicacionimg`
--
ALTER TABLE `publicacionimg`
  ADD CONSTRAINT `PUBLICACIONIMG_IBFK_1` FOREIGN KEY (`ID`) REFERENCES `publicacion` (`ID`);

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `REALIZA_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `REALIZA_IBFK_2` FOREIGN KEY (`IDDENUNCIA`) REFERENCES `denuncia` (`ID`);

--
-- Filtros para la tabla `usuariotel`
--
ALTER TABLE `usuariotel`
  ADD CONSTRAINT `USUARIOTEL_IBFK_1` FOREIGN KEY (`ID`) REFERENCES `usuario` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
