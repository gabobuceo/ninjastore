/* CREATE DATABASE */
CREATE DATABASE IF NOT EXISTS `NINJADATOS` DEFAULT CHARACTER SET UTF8 COLLATE UTF8_SPANISH_CI;
USE `NINJADATOS`;

/* DROPS VIEW */
DROP VIEW IF EXISTS DATOS_VENTAS;
DROP VIEW IF EXISTS DATOS_CATEGORIAS_AUX01;
DROP VIEW IF EXISTS DATOS_CATEGORIAS;
DROP VIEW IF EXISTS DATOS_PERSONA_AUX01; 
DROP VIEW IF EXISTS DATOS_PERSONA_AUX02; 
DROP VIEW IF EXISTS DATOS_PERSONA_AUX03; 
DROP VIEW IF EXISTS DATOS_PERSONA; 
DROP VIEW IF EXISTS DATOS_PRODUCTO_AUX01; 
DROP VIEW IF EXISTS DATOS_PRODUCTO; 
DROP VIEW IF EXISTS DATOS_PRODUCTO_VIP; 
DROP VIEW IF EXISTS DATOS_PRODUCTO_OFERTA; 
DROP VIEW IF EXISTS DATOS_PRODUCTO_INDEX; 
DROP VIEW IF EXISTS DATOS_BUSQUEDA_CATEGORIA_AUX01; 
DROP VIEW IF EXISTS DATOS_BUSQUEDA_CATEGORIA; 
DROP VIEW IF EXISTS DATOS_PUBLICACIONES_AUX01; 
DROP VIEW IF EXISTS DATOS_PUBLICACIONES; 
DROP VIEW IF EXISTS DATOS_COMPRAS; 

/* DROPS TABLES */
DROP TABLE IF EXISTS CONTIENE;
DROP TABLE IF EXISTS CREA;
DROP TABLE IF EXISTS REALIZA;
DROP TABLE IF EXISTS GESTIONA;
DROP TABLE IF EXISTS PERMUTA;
DROP TABLE IF EXISTS PREGUNTA;
DROP TABLE IF EXISTS FACTURA;
DROP TABLE IF EXISTS COMPRA;
DROP TABLE IF EXISTS FAVORITO;
DROP TABLE IF EXISTS USUARIOTEL;
DROP TABLE IF EXISTS PUBLICACIONIMG;
DROP TABLE IF EXISTS USUARIO;
DROP TABLE IF EXISTS PUBLICACION;
DROP TABLE IF EXISTS CATEGORIA;
DROP TABLE IF EXISTS DENUNCIA;
DROP TABLE IF EXISTS HISTORIAL;
DROP TABLE IF EXISTS NOTIFICACION;

/* CREATE TABLES */
CREATE TABLE USUARIO(
	ID 				SERIAL 			NOT NULL,
	CEDULA			VARCHAR(10)		NOT NULL,
	USUARIO			VARCHAR(20)		NOT NULL,
	PASSWORD		VARCHAR(50)		NOT NULL,
	PNOMBRE			VARCHAR(20)		NOT NULL,
	SNOMBRE			VARCHAR(20),
	PAPELLIDO		VARCHAR(20)		NOT NULL,
	SAPELLIDO		VARCHAR(20),
	FNACIMIENTO		DATETIME		NOT NULL,
	EMAIL			VARCHAR(50)		NOT NULL,
	CALLE			VARCHAR(50),
	NUMERO			INT,
	ESQUINA			VARCHAR(50),
	CPOSTAL			INT				DEFAULT 0,
	LOCALIDAD		VARCHAR(50),
	DEPARTAMENTO	VARCHAR(50),
	GEOX			VARCHAR(15),		
	GEOY			VARCHAR(15),
	TIPO			VARCHAR(10)		DEFAULT 'COMUN',
	ESTADO			VARCHAR(50)		DEFAULT 'CONFIRMAR EMAIL',
	ACTIVACION		VARCHAR(100)	DEFAULT 1,
	ROL				VARCHAR(50)		DEFAULT 'CLIENTE',
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	UNIQUE			(CEDULA),
	UNIQUE			(USUARIO),
	UNIQUE			(EMAIL),
	INDEX			(CEDULA),
	INDEX			(USUARIO),
	CHECK			(TIPO='COMUN' AND TIPO='VIP'),
	CHECK			(ESTADO='CONFIRMAR EMAIL' AND ESTADO='ACTIVADO' AND ESTADO='BANEADO' AND ESTADO='BLOQUEADO' AND ESTADO='DESHABILITADO' AND ESTADO='MANTENIMIENTO'),
	CHECK			(ROL='CLIENTE' AND ROL='ADMINISTRADOR' AND ROL='MODERADOR')
);

CREATE TABLE USUARIOTEL(
	ID 				BIGINT(20)		UNSIGNED NOT NULL,
	TELEFONO		VARCHAR(10)		NOT NULL,
	PRIMARY KEY		(ID,TELEFONO),
	FOREIGN KEY		(ID) REFERENCES USUARIO(ID),
	UNIQUE			(TELEFONO)
);

CREATE TABLE CATEGORIA(
	ID 				SERIAL 			NOT NULL,
	TITULO 			VARCHAR(50) 	NOT NULL,
	PADRE			BIGINT(20)		UNSIGNED NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID)
);

CREATE TABLE PUBLICACION(
	ID 				SERIAL 			NOT NULL,
	IDCATEGORIA		BIGINT(20)		UNSIGNED NOT NULL,
	TITULO			VARCHAR(50) 	NOT NULL,
	DESCRIPCION 	TEXT 			NOT NULL,
	IMGDEFAULT 		VARCHAR(50)		DEFAULT 'noimage',
	PRECIO			DOUBLE(10,2) 	DEFAULT 1,
	OFERTA			BOOLEAN 		DEFAULT 0,
	DESCUENTO		INT 			DEFAULT 0,
	FOFERTA			DATETIME,
	ESTADOP 		VARCHAR(10) 	DEFAULT 'PUBLICADA',
	ESTADOA 		VARCHAR(10) 	DEFAULT 'NUEVO',
	CANTIDAD		INT 			NOT NULL,
	VISTO 			INT 			DEFAULT 0,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	INDEX			(TITULO),
	FOREIGN KEY		(IDCATEGORIA) REFERENCES CATEGORIA(ID),
	CHECK			(ESTADOP='PUBLICADA' AND ESTADOP='BORRADOR' AND ESTADOP='CANCELADA' AND ESTADOP='BANEADA'),
	CHECK			(ESTADOA='NUEVO' AND ESTADOA='USADO')
);

CREATE TABLE PUBLICACIONIMG(
	ID 				BIGINT(20)		UNSIGNED NOT NULL,
	IMAGENES		VARCHAR(50)		DEFAULT 'DEFAULT.JPG',
	PRIMARY KEY		(ID,IMAGENES),
	FOREIGN KEY		(ID) REFERENCES PUBLICACION(ID)
);

CREATE TABLE DENUNCIA(
	ID 				SERIAL 			NOT NULL,
	FECHA			DATETIME 		NOT NULL,
	TIPO			VARCHAR(15) 	NOT NULL,
	IDOBJETO		BIGINT(20)		UNSIGNED NOT NULL,
	COMENTARIO 		VARCHAR(150),
	ESTADO 			VARCHAR(10) 	DEFAULT 'ACTIVA',
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	INDEX			(IDOBJETO),
	CHECK			(TIPO='PUBLICACION' AND TIPO='COMENTARIO' AND TIPO='COMPRA' AND TIPO='CATEGORIAS' AND TIPO='USUARIO'),
	CHECK			(ESTADO='ACTIVA' AND ESTADO='CERRADA' AND ESTADO='EN PROCESO')
);

CREATE TABLE HISTORIAL(
	ID 				SERIAL 			NOT NULL,
	USUARIO 		VARCHAR(15) 	NOT NULL,
	ACCION			VARCHAR(15) 	NOT NULL,
	DESCRIPCION		TEXT			NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	INDEX			(USUARIO)
);

CREATE TABLE FAVORITO(
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION 	BIGINT(20)		UNSIGNED NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID)
);

CREATE TABLE COMPRA(
	ID 				SERIAL 			NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION 	BIGINT(20)		UNSIGNED NOT NULL,
	FECHACOMPRA 	TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONCRETADO 		BOOLEAN			DEFAULT 0,
	FECHACONCRETADO DATETIME,
	CANTIDAD 		INT 			DEFAULT 1,
	TOTAL 			DOUBLE(10,2)	NOT NULL,
	COMISION 		DOUBLE(10,2)	NOT NULL,
	CALIFICACION 	INT,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDUSUARIO,IDPUBLICACION,FECHACOMPRA),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(CALIFICACION=1 AND CALIFICACION=2 AND CALIFICACION=3 AND CALIFICACION=5 AND CALIFICACION=5)
);

CREATE TABLE FACTURA(
	ID 				SERIAL 			NOT NULL,
	IDCOMPRA		BIGINT(20)		UNSIGNED NOT NULL,
	FECHAC 			DATETIME 		NOT NULL,
	FECHAV 			DATETIME 		NOT NULL,
	ESTADO 			VARCHAR(15) 	NOT NULL,
	SUBTOTAL 		DOUBLE(10,2) 	NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	CHECK			(ESTADO='PENDIENTE' AND ESTADO='PAGA' AND ESTADO='VENCIDA')
);

CREATE TABLE PREGUNTA(
	ID 				SERIAL			NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION 	BIGINT(20)		UNSIGNED NOT NULL,
	MENSAJE 		VARCHAR(150) 	NOT NULL,
	FECHAM 			TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	RESPUESTA 		VARCHAR(150),
	FECHAR 			DATETIME,
	ESTADO			VARCHAR(15) 	DEFAULT 'ACTIVO',
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(ESTADO='ACTIVO' AND ESTADO='BANEADO')
);

CREATE TABLE PERMUTA(
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION 	BIGINT(20)		UNSIGNED NOT NULL,
	ESTADO 			VARCHAR(15) 	DEFAULT 'ACTIVA',
	FECHAP 			DATETIME 		NOT NULL,
	ACEPTADA 		BOOLEAN			DEFAULT 0,
	FECHAC 			DATETIME,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(ESTADO='ACTIVA' AND ESTADO='CERRADA')
);

CREATE TABLE GESTIONA(
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDDENUNCIA 		BIGINT(20)		UNSIGNED NOT NULL,
	FECHA 			DATETIME 		NOT NULL,
	DESCRIPCION 	TEXT,
	HTML 			TEXT,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDUSUARIO,IDDENUNCIA),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDDENUNCIA) REFERENCES DENUNCIA(ID)
);

CREATE TABLE REALIZA (
	IDDENUNCIA 		BIGINT(20)		UNSIGNED NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDDENUNCIA,IDUSUARIO),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDDENUNCIA) REFERENCES DENUNCIA(ID)
);

CREATE TABLE CREA (
	ID 				SERIAL 			NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION	BIGINT(20)		UNSIGNED NOT NULL,
	FECHA 			DATETIME 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID)
);

CREATE TABLE CONTIENE (
	ID 				SERIAL 			NOT NULL,
	IDPUBLICACION	BIGINT(20)		UNSIGNED NOT NULL,
	IDCATEGORIA 	BIGINT(20)		UNSIGNED NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDPUBLICACION,IDCATEGORIA),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	FOREIGN KEY		(IDCATEGORIA) REFERENCES CATEGORIA(ID)
);

CREATE TABLE NOTIFICACION(
	ID 				SERIAL 			NOT NULL,
	USUARIO 		VARCHAR(15) 	NOT NULL,
	DESCRIPCION		TEXT			NOT NULL,
	LINK			TEXT			NOT NULL,
	TIPO 			VARCHAR(15) 	NOT NULL,
	PUBLICACION		VARCHAR(15) 	NOT NULL,
	FECHA 			DATETIME 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	VISTO			BOOLEAN			DEFAULT 0,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	CHECK			(TIPO='PREGUNTA' AND TIPO='RESPUESTA' AND TIPO='COMPRA' AND TIPO='VENTA' AND TIPO='CONFIRMADOC' AND TIPO='CALIFICACIONC' AND TIPO='CONFIRMADOV' AND TIPO='CALIFICACIONV' AND TIPO='BANEADO' AND TIPO='FINALIZADO'),
	INDEX			(USUARIO)
);

/* VISTAS */
CREATE VIEW DATOS_PERSONA_AUX01 AS 
SELECT U.ID,SUM(CO.CANTIDAD) AS VENTAS
FROM USUARIO U
LEFT JOIN COMPRA CO ON U.ID=CO.IDUSUARIO
GROUP BY U.ID;

CREATE VIEW DATOS_PERSONA_AUX02 AS
SELECT CR.IDUSUARIO,ROUND(AVG(CO.CALIFICACION)) AS NOTA,COUNT(CO.CALIFICACION) AS CALIFICACION
FROM CREA CR, COMPRA CO
WHERE CR.IDPUBLICACION=CO.IDPUBLICACION
GROUP BY CR.IDUSUARIO;

CREATE VIEW DATOS_PERSONA_AUX03 AS
SELECT U.ID,CALIFICACION,NOTA
FROM USUARIO U
LEFT JOIN DATOS_PERSONA_AUX02 TT ON U.ID=TT.IDUSUARIO
GROUP BY U.ID;

CREATE VIEW DATOS_PERSONA AS
SELECT U.ID,U.PNOMBRE,U.PAPELLIDO,COUNT(CR.IDPUBLICACION) AS PUBLICACIONES,VENTAS,CALIFICACION,NOTA
FROM USUARIO U
	LEFT JOIN CREA CR ON U.ID=CR.IDUSUARIO
	LEFT JOIN DATOS_PERSONA_AUX01 TT ON U.ID=TT.ID
	LEFT JOIN DATOS_PERSONA_AUX03 TT2 ON U.ID=TT2.ID
GROUP BY U.ID;

CREATE VIEW DATOS_PRODUCTO_AUX01 AS
SELECT IDPUBLICACION,COUNT(ID) as PREGUNTAS 
FROM PREGUNTA 
GROUP BY IDPUBLICACION;

CREATE VIEW DATOS_PRODUCTO AS
SELECT P.ID,P.VISTO,SUM(CO.CANTIDAD) AS VENTAS,CM.PREGUNTAS
FROM PUBLICACION P
	LEFT JOIN COMPRA CO ON P.ID=CO.IDPUBLICACION
    LEFT JOIN DATOS_PRODUCTO_AUX01 CM ON P.ID=CM.IDPUBLICACION
GROUP BY P.ID;

CREATE VIEW DATOS_PRODUCTO_VIP AS
SELECT U.ID AS USUARIO,P.* 
FROM USUARIO U, CREA C, PUBLICACION P
WHERE U.ID=C.IDUSUARIO
AND C.IDPUBLICACION=P.ID
AND U.TIPO="VIP";

CREATE VIEW DATOS_PRODUCTO_OFERTA AS
SELECT P.ID,P.IMGDEFAULT,P.PRECIO,P.TITULO,C.FECHA
FROM CREA C, PUBLICACION P
WHERE P.OFERTA="1"
AND C.IDPUBLICACION=P.ID
ORDER BY RAND()
LIMIT 8;

CREATE VIEW DATOS_PRODUCTO_INDEX AS 
SELECT U.ID AS USUARIO,U.PNOMBRE,U.PAPELLIDO,P.ID,U.TIPO,P.IMGDEFAULT,P.PRECIO,P.TITULO,C.FECHA
FROM USUARIO U, CREA C, PUBLICACION P
WHERE U.ID=C.IDUSUARIO
AND C.IDPUBLICACION=P.ID
ORDER BY U.TIPO DESC, RAND();

CREATE VIEW DATOS_BUSQUEDA_CATEGORIA_AUX01 AS 
SELECT U.*,P.IDCATEGORIA
FROM DATOS_PRODUCTO_INDEX U
	LEFT JOIN PUBLICACION P ON U.ID=P.ID
GROUP BY U.ID;

CREATE VIEW DATOS_BUSQUEDA_CATEGORIA AS 
SELECT TT.*,CATEGORIA.TITULO AS CATTITULO,CATEGORIA.ID AS CATID
FROM CATEGORIA
LEFT JOIN DATOS_BUSQUEDA_CATEGORIA_AUX01 AS TT ON CATEGORIA.ID = TT.IDCATEGORIA;

CREATE VIEW DATOS_PUBLICACIONES_AUX01 AS
SELECT FAVORITO.IDPUBLICACION,COUNT(FAVORITO.IDUSUARIO) AS 'FAV' 
FROM FAVORITO 
GROUP BY FAVORITO.IDPUBLICACION;

CREATE VIEW DATOS_PUBLICACIONES AS
SELECT PUBLICACION.*,DATOS_PUBLICACIONES_AUX01.FAV
FROM PUBLICACION
LEFT JOIN DATOS_PUBLICACIONES_AUX01
ON PUBLICACION.ID = DATOS_PUBLICACIONES_AUX01.IDPUBLICACION;

CREATE VIEW DATOS_COMPRAS AS
SELECT COMPRA.*,PUBLICACION.TITULO,USUARIO.ID AS IDVENDEDOR,USUARIO.CEDULA,USUARIO.PNOMBRE,USUARIO.SNOMBRE,USUARIO.PAPELLIDO,USUARIO.SAPELLIDO,USUARIO.EMAIL,USUARIO.CALLE, USUARIO.NUMERO, USUARIO.ESQUINA, USUARIO.CPOSTAL, USUARIO.LOCALIDAD, USUARIO.DEPARTAMENTO, USUARIO.GEOX, USUARIO.GEOY,U2.ID AS IDCOMPRADOR,U2.CEDULA AS CEDULACOMPRADOR,U2.PNOMBRE AS PNOMBRECOMPRADOR,U2.PAPELLIDO AS PAPELLIDOCOMPRADOR 
FROM COMPRA, USUARIO, PUBLICACION, CREA, USUARIO U2 
WHERE COMPRA.IDPUBLICACION=PUBLICACION.ID AND COMPRA.IDUSUARIO=U2.ID AND PUBLICACION.ID=CREA.IDPUBLICACION AND USUARIO.ID=CREA.IDUSUARIO;

CREATE VIEW DATOS_CATEGORIAS_AUX01 AS
SELECT CATEGORIA.*,COUNT(PUBLICACION.ID) as CANTIDAD
FROM CATEGORIA, PUBLICACION 
WHERE CATEGORIA.ID = PUBLICACION.IDCATEGORIA 
GROUP BY PUBLICACION.IDCATEGORIA;

CREATE VIEW DATOS_CATEGORIAS AS
SELECT CATEGORIA.*,DC.CANTIDAD
FROM CATEGORIA
LEFT JOIN DATOS_CATEGORIAS_AUX01 DC ON CATEGORIA.ID = DC.ID;

CREATE VIEW DATOS_VENTAS AS
SELECT COMPRA.ID AS 'IDCOMPRA',COMPRA.IDUSUARIO AS 'IDCOMPRADOR',COMPRA.FECHACOMPRA,COMPRA.CONCRETADO,COMPRA.IDPUBLICACION,PUBLICACION.TITULO,CREA.IDUSUARIO AS 'IDVENDEDOR' 
FROM COMPRA,CREA,PUBLICACION 
WHERE COMPRA.IDPUBLICACION=CREA.IDPUBLICACION AND PUBLICACION.ID=CREA.IDPUBLICACION

INSERT INTO CATEGORIA (ID,TITULO) VALUES 
	('1','Categorias Padre');
INSERT INTO CATEGORIA (ID,TITULO,PADRE) VALUES 
	('2','Accesorios para Vehículos','1'),
	('3','Accesorios Autos y Camionetas','2'),
	('4','Accesorios para Motos','2'),
	('5','Audio para Autos','2'),
	('6','Llantas','2'),
	('7','Neumáticos','2'),
	('8','Repuestos Autos y Camionetas','2'),
	('9','Repuestos para Motos','2'),
	('10','Service Programado','2'),
	('11','Tuning','2'),
	('12','Alimentos y Bebidas','1'),
	('13','Bebidas Alcohólicas','12'),
	('14','Bebidas Analcohólicas','12'),
	('15','Comestibles','12'),
	('16','Animales y Mascotas','1'),
	('17','Aves','16'),
	('18','Conejos','16'),
	('19','Equinos','16'),
	('20','Gatos','16'),
	('21','Libros y Manuales de Animales','16'),
	('22','Peces','16'),
	('23','Perros','16'),
	('24','Roedores','16'),
	('25','Arte y Antigüedades','1'),
	('26','Adornos de Vitrina','25'),
	('27','Antigüedades','25'),
	('28','Artesanías','25'),
	('29','Cristal y Vidrio','25'),
	('30','Cuadros y Láminas','25'),
	('31','Filatelia','25'),
	('32','Juguetes Antiguos','25'),
	('33','Autos, Motos y Otros','1'),
	('34','Autos de Colección','33'),
	('35','Autos y Camionetas','33'),
	('36','Camiones','33'),
	('37','Maquinaria Agrícola','33'),
	('38','Maquinaria de Construcción','33'),
	('39','Motos','33'),
	('40','Náutica','33'),
	('41','Bebés','1'),
	('42','Andadores y Vehículos de Bebés','41'),
	('43','Artículos de Bebés para Baño','41'),
	('44','Artículos para Maternidad','41'),
	('45','Chupetes y Mordillos','41'),
	('46','Comida para Bebés','41'),
	('47','Corralitos','41'),
	('48','Cuarto del Bebé','41'),
	('49','Higiene y Cuidado del Bebé','41'),
	('50','Juegos y Juguetes para Bebés','41'),
	('51','Lactancia y Alimentación','41'),
	('52','Paseo del Bebé','41'),
	('53','Ropa y Calzado para Bebés','41'),
	('54','Salud del Bebé','41'),
	('55','Seguridad para Bebés','41'),
	('56','Cámaras y Accesorios','1'),
	('57','Accesorios para Cámaras','56'),
	('58','Baterías, Cargadores y Pilas','56'),
	('59','Cámaras Analógicas','56'),
	('60','Cámaras Antiguas o Colección','56'),
	('61','Cámaras Digitales','56'),
	('62','Cámaras Instantáneas','56'),
	('63','Laboratorios y Mini Labs','56'),
	('64','Memorias Digitales','56'),
	('65','Telescopios y Binoculares','56'),
	('66','Video Cámaras','56'),
	('67','Celulares y Telefonía','56'),
	('68','Accesorios para Celulares','56'),
	('69','Celulares y Smartphones','1'),
	('70','Handies','69'),
	('71','Radiofrecuencia','69'),
	('72','Repuestos para Celulares','69'),
	('73','Smartband','69'),
	('74','Smartwatch','69'),
	('75','Telefonía Fija','69'),
	('76','Teléfonos Inalámbricos','69'),
	('77','Coleccionables','1'),
	('78','Afiches, Posters y Carteles','77'),
	('79','Animé','77'),
	('80','Colecciones Diversas','77'),
	('81','Encendedores y Fósforos','77'),
	('82','Filatelia','77'),
	('83','Historietas y Comics','77'),
	('84','Latas, Botellas y Afines','77'),
	('85','Militaria y Afines','77'),
	('86','Modelismo','77'),
	('87','Monedas y Billetes','77'),
	('88','Muñecos y Accesorios','77'),
	('89','Papeles Impresos y Afines','77'),
	('90','Tarjetas Telefónicas','77'),
	('91','Computación','1'),
	('92','Apple','91'),
	('93','Cartuchos, Toner y Papeles','91'),
	('94','CDs y DVDs Vírgenes','91'),
	('95','Computadoras y Servidores','91'),
	('96','Discos Rígidos y Removibles','91'),
	('97','Fuentes y UPS','91'),
	('98','Gabinetes','91'),
	('99','Grabadoras de CDs y DVDs','91'),
	('100','Impresoras y Repuestos','91'),
	('101','iPad y Tablets','91'),
	('102','Memorias RAM','91'),
	('103','Monitores y Proyectores','91'),
	('104','Motherboards','91'),
	('105','Mouses','91'),
	('106','Multimedia','91'),
	('107','Netbooks y Accesorios','91'),
	('108','Notebooks y Accesorios','91'),
	('109','Palmtops y Handhelds','91'),
	('110','Pen Drives','91'),
	('111','Periféricos y Accesorios de PC','91'),
	('112','Placas de Video y Editoras','91'),
	('113','Procesadores','91'),
	('114','Redes','91'),
	('115','Resistencias','91'),
	('116','Scanners','91'),
	('117','Software','91'),
	('118','Consolas y Videojuegos','1'),
	('119','Juegos para PC','118'),
	('120','Lentes de Realidad Virtual','118'),
	('121','Maquinitas','118'),
	('122','Nintendo','118'),
	('123','PlayStation','118'),
	('124','Sega','118'),
	('125','Xbox','118'),
	('126','Deportes y Fitness','1'),
	('127','Acuáticos','126'),
	('128','Aerobics y Fitness','126'),
	('129','Artes Marciales','126'),
	('130','Básquetbol','126'),
	('131','Bicicletas y Ciclismo','126'),
	('132','Billar y Pool','126'),
	('133','Boxeo','126'),
	('134','Calzado','126'),
	('135','Camping','126'),
	('136','Extremos','126'),
	('137','Fútbol','126'),
	('138','Golf','126'),
	('139','Hockey','126'),
	('140','Lentes Deportivos y de Sol','126'),
	('141','Patín','126'),
	('142','Pesca','126'),
	('143','Rugby','126'),
	('144','Skateboarding','126'),
	('145','Suplementos Alimenticios','126'),
	('146','Tenis y Paddle','126'),
	('147','Electrodomésticos y Aires Ac.','1'),
	('148','Artefactos para el Hogar','147'),
	('149','Calefones y Termotanques','147'),
	('150','Campanas y Extractores','147'),
	('151','Climatización','147'),
	('152','Cocción','147'),
	('153','Cuidado Personal','147'),
	('154','Electrodomésticos de Cocina','147'),
	('155','Lavado y Secado de Ropa','147'),
	('156','Lavavajillas','147'),
	('157','Máquinas de Coser','147'),
	('158','Microondas y Repuestos','147'),
	('159','Refrigeración','147'),
	('160','Electrónica, Audio y Video','1'),
	('161','Accesorios para Audio y Video','160'),
	('162','Audio para Autos','160'),
	('163','Audio para el Hogar','160'),
	('164','Audio Portable','160'),
	('165','Audio Profesional y DJs','160'),
	('166','Calculadoras y Agendas','160'),
	('167','Drones','160'),
	('168','DVD y Video','160'),
	('169','Fotocopiadoras','160'),
	('170','GPS','160'),
	('171','iPod','160'),
	('172','MP3, MP4 y MP5 Players','160'),
	('173','Pilas, Baterías y Cargadores','160'),
	('174','Proyectores y Pantallas','160'),
	('175','Seguridad y Vigilancia','160'),
	('176','Televisores','160'),
	('177','Video Cámaras','160'),
	('178','Herramientas y Construcción','1'),
	('179','Construcción','178'),
	('180','Herramientas','178'),
	('181','Mobiliario para Baños','178'),
	('182','Mobiliario para Cocinas','178'),
	('183','Pisos, Paredes y Aberturas','178'),
	('184','Hogar, Muebles y Jardín','1'),
	('185','Baño','184'),
	('186','Cocina y Bazar','184'),
	('187','Comedor','184'),
	('188','Decoración','184'),
	('189','Dormitorio','184'),
	('190','Escritorio','184'),
	('191','Iluminación para el Hogar','184'),
	('192','Jardín y Exterior','184'),
	('193','Lavadero y Limpieza','184'),
	('194','Living','184'),
	('195','Industrias y Oficinas','1'),
	('196','Equipamiento para Oficinas','195'),
	('197','Industria Agrícola','195'),
	('198','Industria Automotriz','195'),
	('199','Industria Gastronómica','195'),
	('200','Industria Textil','195'),
	('201','Seguridad Industrial','195'),
	('202','Tanques y Contenedores','195'),
	('203','Inmuebles','1'),
	('204','Apartamentos','203'),
	('205','Campos','203'),
	('206','Casas','203'),
	('207','Cocheras','203'),
	('208','Habitaciones','203'),
	('209','Llave de Negocio','203'),
	('210','Locales','203'),
	('211','Oficinas','203'),
	('212','Quintas','203'),
	('213','Terrenos','203'),
	('214','Instrumentos Musicales','1'),
	('215','Amplificadores','214'),
	('216','Bajos','214'),
	('217','Baterías y Percusión','214'),
	('218','Consolas de Sonido','214'),
	('219','Efectos de Sonido','214'),
	('220','Guitarras','214'),
	('221','Instrumentos de Cuerda','214'),
	('222','Instrumentos de Viento','214'),
	('223','Micrófonos','214'),
	('224','Parlantes','214'),
	('225','Teclados, Pianos y Órganos','214'),
	('226','Joyas y Relojes','1'),
	('227','Joyas','226'),
	('228','Relojes','226'),
	('229','Juegos y Juguetes','1'),
	('230','Autos de Juguete','229'),
	('231','Disfraces y Cotillón','229'),
	('232','Juegos de Aire Libre y Agua','229'),
	('233','Juegos de Mesa','229'),
	('234','Juegos de Salón','229'),
	('235','Juegos Electrónicos','229'),
	('236','Juguetes','229'),
	('237','Muñecas y Accesorios','229'),
	('238','Muñecos y Accesorios','229'),
	('239','Vehículos para Niños','229'),
	('240','Música, Libros y Películas','1'),
	('241','Libros','240'),
	('242','Música','240'),
	('243','Películas','240'),
	('244','Revistas','240'),
	('245','Series','240'),
	('246','Ropa, Calzados y Accesorios','1'),
	('247','Accesorios de Moda','246'),
	('248','Bermudas y Shorts','246'),
	('249','Blusas','246'),
	('250','Buzos y Canguros','246'),
	('251','Calzados','246'),
	('252','Calzas y Leggings','246'),
	('253','Camisas','246'),
	('254','Camperas','246'),
	('255','Carteras, Mochilas y Equipajes','246'),
	('256','Chalecos','246'),
	('257','Championes','246'),
	('258','Chaquetas y Blazers','246'),
	('259','Chombas','246'),
	('260','Enteritos','246'),
	('261','Gabardinas y Pilots','246'),
	('262','Lentes','246'),
	('263','Pantalones','246'),
	('264','Poleras y Polerones','246'),
	('265','Polleras','246'),
	('266','Ponchos','246'),
	('267','Remeras y Musculosas','246'),
	('268','Ropa Deportiva','246'),
	('269','Ropa Interior y De Dormir','246'),
	('270','Ropa y Calzado para Bebés','246'),
	('271','Saquitos','246'),
	('272','Sweaters y Cardigans','246'),
	('273','Tapados','246'),
	('274','Trajes','246'),
	('275','Trajes de Baño','246'),
	('276','Uniformes','246'),
	('277','Vestidos','246'),
	('278','Salud y Belleza','1'),
	('279','Cuidado de la Piel','278'),
	('280','Cuidado de la Salud','278'),
	('281','Cuidado de Manos','278'),
	('282','Cuidado del Cabello','278'),
	('283','Cuidado del Cuerpo','278'),
	('284','Maquillaje','278'),
	('285','Medicamentos','278'),
	('286','Perfumes y Fragancias','278'),
	('287','Vitaminas','278'),
	('288','Servicios','1'),
	('289','Belleza y Cuidado Personal','288'),
	('290','Clases y Cursos','288'),
	('291','Fiestas y Eventos','288'),
	('292','Hogar','288'),
	('293','Imprenta','288'),
	('294','Mantenimiento de Vehículos','288'),
	('295','Medicina y Salud','288'),
	('296','Mudanzas y Traslados','288'),
	('297','Oficios','288'),
	('298','Profesionales','288'),
	('299','Servicio Técnico','288'),
	('300','Servicios para Mascotas','288'),
	('301','Viajes y Turismo','288'),
	('302','Otras categorías','1'),
	('303','Adultos','302'),
	('304','Artículos de Mercería','302'),
	('305','Cumpleaños y Fiestas','302'),
	('306','Esoterismo','302'),
	('307','Fuegos Artificiales','302'),
	('308','Productos para Tatuajes','302'),
	('309','Seguros de Viaje y Vida','302'),
	('310','TV Cable','302'),
	('311','Útiles Escolares','302');

INSERT INTO USUARIO(CEDULA,USUARIO,PASSWORD,PNOMBRE,SNOMBRE,PAPELLIDO,SAPELLIDO,FNACIMIENTO,EMAIL,CALLE,NUMERO,ESQUINA,CPOSTAL,LOCALIDAD,DEPARTAMENTO,GEOX,GEOY,ESTADO,ACTIVACION) VALUES
	('34190881','jarce','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Jael ','Arapey','Arce ','Ybarra','1963-04-21','jarce@gmail.com','Av. Gral. Rivera','4573','Santiago de Anca','11400','Malvin Nuevo','Montevideo','-34.891700','-56.113456','ACTIVADO','0'),
	('19918890','ahurtado','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Arapey','Silvio','Hurtado','Brito','1947-05-09','ahurtado@gmail.com','Garzon','646','Justino Muniz','37000','Melo','Cerro largo','-32.377925','-54.170704','ACTIVADO','0'),
	('72940202','zfajardo','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Zofía','Clímaco','Fajardo','Tovar','1983-03-13','zfajardo@gmail.com','Gral Juan Antonio Lavalleja ','1224','Wilson Ferreira Alduante','80100','Libertad','San José','-34.639277','-56.620507','ACTIVADO','0'),
	('54790312','hmaya','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Herminda','Josías',' Maya','Tovar','1949-11-25','hmaya@gmail.com','Ansina','6818','Federico Garcia Lorca','15800','Ciudad de la Costa','Canelones','-34.852552','-56.048759','ACTIVADO','0'),
	('32206929','acamacho','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Ann','Zofía','Camacho','Ordóñez','1993-08-26','acamacho3@gmail.com','Guayabos','1775','Gaboto','11200','Cordón','Montevideo','-34.903645','-56.177682','ACTIVADO','0'),
	('11295947','srenteria','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Silvio','Ann','Rentería','Montemayor','1951-09-27','srentia@gmail.com','Joaquin Suarez','5556','AV. Argentina','15300','Parque del Plata','Canelones','-34.755289','-55.706514','ACTIVADO','0'),
	('53917507','jtorres','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Josías','Herminda','Torres','Ontiveros','1961-03-15','jtorres@gmail.com','Guipúzcoa',' 402','Solano García','11300','Punta Carreta','Montevideo','-34.924050','-56.156384','ACTIVADO','0'),
	('16210700','cgarcia','f7c3bc1d808e04732adf679965ccc34ca7ae3441','Clímaco','Jael ','García','Balderas','1950-01-27','cgarcia@gmail.com','Del Monte','2869','Av. Transversal','15800','Ciudad de la Costa','Canelones','-34.821007','-55.943328','ACTIVADO','0');
INSERT INTO USUARIO(CEDULA,USUARIO,PASSWORD,PNOMBRE,PAPELLIDO,FNACIMIENTO,EMAIL,ESTADO,ACTIVACION) VALUES 
	('51652357','gabobuceo','4e4800c9e622ec10c62c4bf2ca9aa88136d88bdf','Gabriel','Fernandez','1990-11-28','emgabo@gmail.com','ACTIVADO','0');

INSERT INTO USUARIOTEL VALUES 
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='34190881'),'495131497'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='19918890'),'291766058'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='72940202'),'493160386'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='54790312'),'297377925'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='32206929'),'495379841'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='11295947'),'299593321'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='53917507'),'498270023'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='16210700'),'299758321'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='34190881'),'094941073'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='19918890'),'095213190'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='72940202'),'091823275'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='54790312'),'093095314'),
	((SELECT ID FROM USUARIO WHERE USUARIO.CEDULA='32206929'),'099426475');

INSERT INTO PUBLICACION (ID, IDCATEGORIA, TITULO, DESCRIPCION, IMGDEFAULT, PRECIO, OFERTA, DESCUENTO, FOFERTA, ESTADOP, ESTADOA, CANTIDAD, VISTO, BAJA) VALUES
	(1, 228, 'Relogio Masculino', '&lt;p&gt;zxcxzcxczxcz&lt;/p&gt;\r\n', '315737fdbaa4efcb8e935dbdc8eddf33', 32.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 30, 3, 0),
	(2, 255, 'CARTERA BOLSO KORIUM CON DOBLE CIERRE FRONTAL ', '&lt;p&gt;Cartera tipo bolso Korium con doble cierre frontal y cierre central. Material sint&amp;eacute;tico s&amp;iacute;mil cuero.&lt;/p&gt;\r\n', '273a2311c486376604393b73d8d0c12f', 890.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 6, 1, 0),
	(3, 255, 'Cartera Bolso Korium Tramada con Rafia', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '3b20b15cb14ede7dd082d11634607eee', 890.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 1, 0),
	(4, 255, 'CARTERA KORIUM CLÁSICA CON MANIJA A MEDIDA', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '531262b335faba33437d97a88adb3476', 990.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
	(5, 247, 'GORRO UMBRO NEGRO CON LOGO FRONTAL ', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Este gorro es ideal para la temporada de oto&amp;ntilde;o invierno, complementando un look sport casual para tu tiempo libre o para todos los d&amp;iacute;as.&lt;/p&gt;\r\n', '904c564d07fb0c069ef01c8c48b951e7', 360.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 1, 0),
	(6, 255, 'Mochila Clasica Jansport Superbreak Verde', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '5eb09118d0c8c2b5cb3b7dbef1a44b21', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
	(7, 255, 'Mochila Clasica Jansport Superbreak Azul', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '7002e7b58907181472922676d0f2e1f2', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
	(8, 255, 'Mochila Clasica Jansport Superbreak Rosada', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '3a11ee90230a0555988b27fe2208063e', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
	(9, 255, 'Mochila Clasica Jansport Superbreak Violeta', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '56befbe854d16d3d3b740d10bbf7595a', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
	(10, 108, 'Notebook Asus S510uf-bq091t I7 W10 GEFORCE MX130 U', '&lt;p&gt;El ASUS VivoBook S ofrece la combinaci&amp;oacute;n ideal de belleza y rendimiento. Con su marco NanoEdge, acabado de metal pulido, procesador Intel&amp;reg; y gr&amp;aacute;fica NVIDIA, el VivoBook S es un port&amp;aacute;til pensado para los agitados estilos de vida de hoy en d&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;Garant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nPart Number 90NB0IK1-M03490&amp;nbsp;&lt;br /&gt;\r\nMarca Asus&amp;nbsp;&lt;br /&gt;\r\nCPU Intel&amp;reg; Core&amp;trade; i7-8550U Processor, 1.8 GHz (8M Cache, up to 4GHz)&amp;nbsp;&lt;br /&gt;\r\nMemoria 8 GB DDR4 2 slot memoria max. 16 gb&amp;nbsp;&lt;br /&gt;\r\nDisco Duro SATA 1TB 5400RPM 2.5&amp;#39; HDD&amp;nbsp;&lt;br /&gt;\r\nPantalla 15,6&amp;#39;//Ultra Slim 250nits// FHD 1920X1080 16:9 // AntiGlade // NTSC:45% // Wide View&amp;nbsp;&lt;br /&gt;\r\nResoluci&amp;oacute;n FHD 1920X1080&amp;nbsp;&lt;br /&gt;\r\nTarj. Video Intel UHD 620&amp;nbsp;&lt;br /&gt;\r\nCamara Web VGA web camera (Fixed type)&amp;nbsp;&lt;br /&gt;\r\nAudio Built-in speaker&amp;nbsp;&lt;br /&gt;\r\nBuilt-in microphone&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Sonic Master&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Bater&amp;iacute;a 42WHrs, 3S1P, 3-cell Li-ion&amp;nbsp;&lt;br /&gt;\r\nCard Reader SDXC&amp;nbsp;&lt;br /&gt;\r\nBluetooth 4.2&amp;nbsp;&lt;br /&gt;\r\nWifi Integrado 802.11 AC&amp;nbsp;&lt;br /&gt;\r\nUsb 2x USB 2.0&amp;nbsp;&lt;br /&gt;\r\n1x USB 3.0&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x USB3.1 Type C (gen 1)&amp;quot;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Hdmi 1.4&amp;nbsp;&lt;br /&gt;\r\nOtros Puertos I/0 1x Headphone-out &amp;amp; Audio-in Combo Jack&amp;nbsp;&lt;br /&gt;\r\n1x RJ45 LAN Jack for LAN insert&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x VGA Port (D-Sub)&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Teclado Chiclet espa&amp;ntilde;ol&amp;nbsp;&lt;br /&gt;\r\nMedidas (mm.) 36.1(W) x 24.3(D) x 1.79 ~ 1.79 (H) cm&amp;nbsp;&lt;br /&gt;\r\nPeso (kgs.) 1.7 KGS con bater&amp;iacute;a&amp;nbsp;&lt;br /&gt;\r\nColor GOLD METAL&amp;nbsp;&lt;br /&gt;\r\nSistema Operativo Windows 10 home ( 64 bits)&amp;nbsp;&lt;br /&gt;\r\nGarant&amp;iacute;a 1 a&amp;ntilde;o en Centro Autorizado de Servicio&lt;/p&gt;\r\n', '2ff7cae74ac678e34c17d5698abf36d0', 32400.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 2, 1, 0),
	(11, 108, 'Notebook Hp Stream 11.6 Dual Core 4GB Ram 32Gb SSD', '&lt;p&gt;Ideal para la inform&amp;aacute;tica b&amp;aacute;sica, ya sea en casa o mientras viaja, disfruta de la navegaci&amp;oacute;n web, las redes sociales, el chat, las videollamadas, usa aplicaciones de oficina, correos electr&amp;oacute;nicos y descarga de aplicaciones.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nProcesador Intel Dual Core N2840 - 2.58GHz&lt;br /&gt;\r\nPantalla LED HD 11.6&amp;quot; 1366 x 768&lt;br /&gt;\r\nMemoria RAM 4GB DDR3L 1333MHz&lt;br /&gt;\r\nDisco S&amp;oacute;lido SSD 32GB&lt;br /&gt;\r\nS.O. Windows 10&lt;br /&gt;\r\nGr&amp;aacute;ficos Intel HD Graphic&lt;br /&gt;\r\nWebCam, micr&amp;oacute;fono&lt;br /&gt;\r\nHDMI, USB 3.0, USB 2.0&lt;br /&gt;\r\nLector de tarjetas de memoria&lt;br /&gt;\r\nBater&amp;iacute;a de 3 celdas&lt;br /&gt;\r\nPeso: 1.23 Kg&lt;/p&gt;\r\n', 'd795ac99ca3516bc28c38eb519031bac', 8950.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(12, 137, 'Pelota de fútbol Topper Ultra Azul', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b5ab5bfbb231c14615f83d2ed7580b55', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(13, 137, 'Pelota de Futbol Topper Ultra VIII Roja', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b756d15507a508c4f5565a10fe03a2fd', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(14, 137, 'Pelota Neo Trainer 5 Umbro', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Esta pelota es ideal para practicar el deporte que m&amp;aacute;s te gusta.&lt;/p&gt;\r\n', '2496b899d43cdea1a7902868ad3aa993', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(15, 108, 'Notebook HP Quadcore 2.4Ghz 4GB 500GB 15.6 Win 10', '&lt;p&gt;Factory Refurbished. Modelo 15-ba015wm.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;6 meses&lt;br /&gt;\r\nN&amp;uacute;mero de parte HP 1NT85UA.&lt;br /&gt;\r\nColor negro.&lt;br /&gt;\r\nMicrosoft Windows 10 Home 64-bit en ingl&amp;eacute;s pre-instalado.&lt;br /&gt;\r\nProcesador AMD QuadCore E2-7110 2.0GHz (hasta 2.4 Ghz).&lt;br /&gt;\r\nMemoria 4GB DDR4-2133 SDRAM.&lt;br /&gt;\r\nGrabadora SuperMulti DVD burner.&lt;br /&gt;\r\nDisco Duro 500GB 5400rpm.&lt;br /&gt;\r\nPantalla 15.6&amp;quot; diagonal HD SVA BrightView WLED-backlit (1366 x 768).&lt;br /&gt;\r\nVideo AMD Radeon R2 Graphics.&lt;br /&gt;\r\nSonido DTS Studio Sound con parlantes est&amp;eacute;reo.&lt;br /&gt;\r\nRed LAN 10/100. 802.11n Wireless LAN.&lt;br /&gt;\r\nWebcam con micr&amp;oacute;fono digital integrado&lt;br /&gt;\r\nTeclado en ingl&amp;eacute;s completo con teclado num&amp;eacute;rico.&lt;br /&gt;\r\nBater&amp;iacute;a de 4 celdas 41Whr de litio ion.&lt;br /&gt;\r\nLector de micro SD.&lt;/p&gt;\r\n\r\n&lt;p&gt;Puertos disponibles:&lt;/p&gt;\r\n\r\n&lt;p&gt;1 HDMI&lt;br /&gt;\r\n2 USB 2.0&lt;br /&gt;\r\n1 USB 3.0&lt;br /&gt;\r\n1 RJ-45 (LAN)&lt;br /&gt;\r\n1 Headphone-out/microphone-in combo jack&lt;/p&gt;\r\n', '38a9d0d1586b08023a31414ed045c359', 11960.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
	(16, 161, 'Auriculares de vincha GORSUN', '&lt;ul&gt;\r\n&lt;li&gt;Inal&amp;aacute;mbricos.&lt;/li&gt;\r\n&lt;li&gt;Calidad de sonido superior.&lt;/li&gt;\r\n&lt;li&gt;Alta administraci&amp;oacute;n de buffer.&lt;/li&gt;\r\n&lt;li&gt;Reproduce tarjetas Micro SD.&lt;/li&gt;\r\n&lt;li&gt;Plegables y pr&amp;aacute;cticos para transportar.&lt;/li&gt;\r\n&lt;li&gt;Estereo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '572d5b93d2d4bbbe0dedaaf07e992aeb', 1100.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 2, 0),
	(17, 161, 'Auriculares de vincha XION', '&lt;ul&gt;\r\n&lt;li&gt;Bluetooth&lt;/li&gt;\r\n&lt;li&gt;Con bater&amp;iacute;as recargables&lt;/li&gt;\r\n&lt;li&gt;Micr&amp;oacute;fono&lt;/li&gt;\r\n&lt;li&gt;Con botones de control para operar su dispositivo.&lt;/li&gt;\r\n&lt;li&gt;Compatibles con IOS y Android&lt;/li&gt;\r\n&lt;li&gt;Est&amp;eacute;reo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '4a1a639231cf8f83efc86f396146baec', 1390.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(18, 161, 'Auriculares i7S TWS Bluetooth', '&lt;p&gt;Auriculares inalambricos que se conectan a trav&amp;eacute;s de bluetooth (4.2).&lt;/p&gt;\r\n\r\n&lt;p&gt;Ideales y c&amp;oacute;modos para escuchar m&amp;uacute;sica mientras haces deportes, tareas de la casa;&lt;br /&gt;\r\nmientras conduces los puedes usar como manos libres.&lt;/p&gt;\r\n\r\n&lt;p&gt;Detalles:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;Micr&amp;oacute;fono y bot&amp;oacute;n multinacional incluido para recibir llamadas&lt;/li&gt;\r\n&lt;li&gt;Tiempo de bater&amp;iacute;a 2-3 horas&lt;/li&gt;\r\n&lt;li&gt;Alcance 10 mts&lt;/li&gt;\r\n&lt;li&gt;Cargador Inalambrico&lt;/li&gt;\r\n&lt;li&gt;Conexi&amp;oacute;n Bluetooth 4.2&lt;/li&gt;\r\n&lt;li&gt;Parlantes Estero 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Compatible:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;iOS&lt;/li&gt;\r\n&lt;li&gt;Android&lt;/li&gt;\r\n&lt;li&gt;Windows&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Contenido:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;Par de auriculares&lt;/li&gt;\r\n&lt;li&gt;Caja de carga&lt;/li&gt;\r\n&lt;li&gt;Manual&lt;/li&gt;\r\n&lt;li&gt;Cable micro USB&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '63acacf572b8dfff9626473c67944fd8', 690.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 1, 0),
	(19, 161, 'Parlante Bluetooth ROCA', '&lt;p&gt;Escucha la m&amp;uacute;sica que quieres, donde quieras con este practico parlante port&amp;aacute;til!&lt;/p&gt;\r\n', 'f29d1589f88d93125ba678a99b24ae64', 540.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(20, 68, 'Brazalete hasta 4 pulgadas', '&lt;p&gt;Ideal para tener tu dispositivo de hasta 4 pulgadas seguro mientras haces actividades.&lt;/p&gt;\r\n', 'd753a93a4d27c85a17398687c1e18679', 300.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(21, 68, 'Cable de datos MICRO USB', '&lt;ul&gt;\r\n&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '816994e1a25e51a8754f12caac349d64', 190.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 1, 0),
	(22, 68, 'Cable de datos TIPO-C', '&lt;ul&gt;\r\n&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 'ebad02c778900d80810b2dcd46241802', 250.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 50, 1, 0),
	(23, 228, 'Relogio Masculino', '&lt;p&gt;zxcxzcxczxcz&lt;/p&gt;\r\n', '315737fdbaa4efcb8e935dbdc8eddf33', 32.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 30, 3, 0),
	(24, 255, 'CARTERA BOLSO KORIUM CON DOBLE CIERRE FRONTAL ', '&lt;p&gt;Cartera tipo bolso Korium con doble cierre frontal y cierre central. Material sint&amp;eacute;tico s&amp;iacute;mil cuero.&lt;/p&gt;\r\n', '273a2311c486376604393b73d8d0c12f', 890.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 6, 1, 0),
	(25, 255, 'Cartera Bolso Korium Tramada con Rafia', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '3b20b15cb14ede7dd082d11634607eee', 890.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 1, 0),
	(26, 255, 'CARTERA KORIUM CLÁSICA CON MANIJA A MEDIDA', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '531262b335faba33437d97a88adb3476', 990.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
	(27, 247, 'GORRO UMBRO NEGRO CON LOGO FRONTAL ', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Este gorro es ideal para la temporada de oto&amp;ntilde;o invierno, complementando un look sport casual para tu tiempo libre o para todos los d&amp;iacute;as.&lt;/p&gt;\r\n', '904c564d07fb0c069ef01c8c48b951e7', 360.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 1, 1, 0),
	(28, 255, 'Mochila Clasica Jansport Superbreak Verde', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '5eb09118d0c8c2b5cb3b7dbef1a44b21', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
	(29, 255, 'Mochila Clasica Jansport Superbreak Azul', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '7002e7b58907181472922676d0f2e1f2', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
	(30, 255, 'Mochila Clasica Jansport Superbreak Rosada', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '3a11ee90230a0555988b27fe2208063e', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 5, 1, 0),
	(31, 255, 'Mochila Clasica Jansport Superbreak Violeta', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '56befbe854d16d3d3b740d10bbf7595a', 1590.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 10, 1, 0),
	(32, 108, 'Notebook Asus S510uf-bq091t I7 W10 GEFORCE MX130 U', '&lt;p&gt;El ASUS VivoBook S ofrece la combinaci&amp;oacute;n ideal de belleza y rendimiento. Con su marco NanoEdge, acabado de metal pulido, procesador Intel&amp;reg; y gr&amp;aacute;fica NVIDIA, el VivoBook S es un port&amp;aacute;til pensado para los agitados estilos de vida de hoy en d&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;Garant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nPart Number 90NB0IK1-M03490&amp;nbsp;&lt;br /&gt;\r\nMarca Asus&amp;nbsp;&lt;br /&gt;\r\nCPU Intel&amp;reg; Core&amp;trade; i7-8550U Processor, 1.8 GHz (8M Cache, up to 4GHz)&amp;nbsp;&lt;br /&gt;\r\nMemoria 8 GB DDR4 2 slot memoria max. 16 gb&amp;nbsp;&lt;br /&gt;\r\nDisco Duro SATA 1TB 5400RPM 2.5&amp;#39; HDD&amp;nbsp;&lt;br /&gt;\r\nPantalla 15,6&amp;#39;//Ultra Slim 250nits// FHD 1920X1080 16:9 // AntiGlade // NTSC:45% // Wide View&amp;nbsp;&lt;br /&gt;\r\nResoluci&amp;oacute;n FHD 1920X1080&amp;nbsp;&lt;br /&gt;\r\nTarj. Video Intel UHD 620&amp;nbsp;&lt;br /&gt;\r\nCamara Web VGA web camera (Fixed type)&amp;nbsp;&lt;br /&gt;\r\nAudio Built-in speaker&amp;nbsp;&lt;br /&gt;\r\nBuilt-in microphone&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Sonic Master&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Bater&amp;iacute;a 42WHrs, 3S1P, 3-cell Li-ion&amp;nbsp;&lt;br /&gt;\r\nCard Reader SDXC&amp;nbsp;&lt;br /&gt;\r\nBluetooth 4.2&amp;nbsp;&lt;br /&gt;\r\nWifi Integrado 802.11 AC&amp;nbsp;&lt;br /&gt;\r\nUsb 2x USB 2.0&amp;nbsp;&lt;br /&gt;\r\n1x USB 3.0&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x USB3.1 Type C (gen 1)&amp;quot;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Hdmi 1.4&amp;nbsp;&lt;br /&gt;\r\nOtros Puertos I/0 1x Headphone-out &amp;amp; Audio-in Combo Jack&amp;nbsp;&lt;br /&gt;\r\n1x RJ45 LAN Jack for LAN insert&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x VGA Port (D-Sub)&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Teclado Chiclet espa&amp;ntilde;ol&amp;nbsp;&lt;br /&gt;\r\nMedidas (mm.) 36.1(W) x 24.3(D) x 1.79 ~ 1.79 (H) cm&amp;nbsp;&lt;br /&gt;\r\nPeso (kgs.) 1.7 KGS con bater&amp;iacute;a&amp;nbsp;&lt;br /&gt;\r\nColor GOLD METAL&amp;nbsp;&lt;br /&gt;\r\nSistema Operativo Windows 10 home ( 64 bits)&amp;nbsp;&lt;br /&gt;\r\nGarant&amp;iacute;a 1 a&amp;ntilde;o en Centro Autorizado de Servicio&lt;/p&gt;\r\n', '2ff7cae74ac678e34c17d5698abf36d0', 32400.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 2, 1, 0),
	(33, 108, 'Notebook Hp Stream 11.6 Dual Core 4GB Ram 32Gb SSD', '&lt;p&gt;Ideal para la inform&amp;aacute;tica b&amp;aacute;sica, ya sea en casa o mientras viaja, disfruta de la navegaci&amp;oacute;n web, las redes sociales, el chat, las videollamadas, usa aplicaciones de oficina, correos electr&amp;oacute;nicos y descarga de aplicaciones.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nProcesador Intel Dual Core N2840 - 2.58GHz&lt;br /&gt;\r\nPantalla LED HD 11.6&amp;quot; 1366 x 768&lt;br /&gt;\r\nMemoria RAM 4GB DDR3L 1333MHz&lt;br /&gt;\r\nDisco S&amp;oacute;lido SSD 32GB&lt;br /&gt;\r\nS.O. Windows 10&lt;br /&gt;\r\nGr&amp;aacute;ficos Intel HD Graphic&lt;br /&gt;\r\nWebCam, micr&amp;oacute;fono&lt;br /&gt;\r\nHDMI, USB 3.0, USB 2.0&lt;br /&gt;\r\nLector de tarjetas de memoria&lt;br /&gt;\r\nBater&amp;iacute;a de 3 celdas&lt;br /&gt;\r\nPeso: 1.23 Kg&lt;/p&gt;\r\n', 'd795ac99ca3516bc28c38eb519031bac', 8950.00, 0, 0, NULL, 'PUBLICADA', 'NUEVO', 20, 1, 0),
	(34, 137, 'Pelota de fútbol Topper Ultra Azul', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b5ab5bfbb231c14615f83d2ed7580b55', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(35, 137, 'Pelota de Futbol Topper Ultra VIII Roja', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b756d15507a508c4f5565a10fe03a2fd', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(36, 137, 'Pelota Neo Trainer 5 Umbro', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Esta pelota es ideal para practicar el deporte que m&amp;aacute;s te gusta.&lt;/p&gt;\r\n', '2496b899d43cdea1a7902868ad3aa993', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(37, 108, 'Notebook HP Quadcore 2.4Ghz 4GB 500GB 15.6 Win 10', '&lt;p&gt;Factory Refurbished. Modelo 15-ba015wm.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;6 meses&lt;br /&gt;\r\nN&amp;uacute;mero de parte HP 1NT85UA.&lt;br /&gt;\r\nColor negro.&lt;br /&gt;\r\nMicrosoft Windows 10 Home 64-bit en ingl&amp;eacute;s pre-instalado.&lt;br /&gt;\r\nProcesador AMD QuadCore E2-7110 2.0GHz (hasta 2.4 Ghz).&lt;br /&gt;\r\nMemoria 4GB DDR4-2133 SDRAM.&lt;br /&gt;\r\nGrabadora SuperMulti DVD burner.&lt;br /&gt;\r\nDisco Duro 500GB 5400rpm.&lt;br /&gt;\r\nPantalla 15.6&amp;quot; diagonal HD SVA BrightView WLED-backlit (1366 x 768).&lt;br /&gt;\r\nVideo AMD Radeon R2 Graphics.&lt;br /&gt;\r\nSonido DTS Studio Sound con parlantes est&amp;eacute;reo.&lt;br /&gt;\r\nRed LAN 10/100. 802.11n Wireless LAN.&lt;br /&gt;\r\nWebcam con micr&amp;oacute;fono digital integrado&lt;br /&gt;\r\nTeclado en ingl&amp;eacute;s completo con teclado num&amp;eacute;rico.&lt;br /&gt;\r\nBater&amp;iacute;a de 4 celdas 41Whr de litio ion.&lt;br /&gt;\r\nLector de micro SD.&lt;/p&gt;\r\n\r\n&lt;p&gt;Puertos disponibles:&lt;/p&gt;\r\n\r\n&lt;p&gt;1 HDMI&lt;br /&gt;\r\n2 USB 2.0&lt;br /&gt;\r\n1 USB 3.0&lt;br /&gt;\r\n1 RJ-45 (LAN)&lt;br /&gt;\r\n1 Headphone-out/microphone-in combo jack&lt;/p&gt;\r\n', '38a9d0d1586b08023a31414ed045c359', 11960.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 1, 0),
	(38, 161, 'Auriculares de vincha GORSUN', '&lt;ul&gt;\r\n&lt;li&gt;Inal&amp;aacute;mbricos.&lt;/li&gt;\r\n&lt;li&gt;Calidad de sonido superior.&lt;/li&gt;\r\n&lt;li&gt;Alta administraci&amp;oacute;n de buffer.&lt;/li&gt;\r\n&lt;li&gt;Reproduce tarjetas Micro SD.&lt;/li&gt;\r\n&lt;li&gt;Plegables y pr&amp;aacute;cticos para transportar.&lt;/li&gt;\r\n&lt;li&gt;Estereo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '572d5b93d2d4bbbe0dedaaf07e992aeb', 1100.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 2, 0),
	(39, 161, 'Auriculares de vincha XION', '&lt;ul&gt;\r\n&lt;li&gt;Bluetooth&lt;/li&gt;\r\n&lt;li&gt;Con bater&amp;iacute;as recargables&lt;/li&gt;\r\n&lt;li&gt;Micr&amp;oacute;fono&lt;/li&gt;\r\n&lt;li&gt;Con botones de control para operar su dispositivo.&lt;/li&gt;\r\n&lt;li&gt;Compatibles con IOS y Android&lt;/li&gt;\r\n&lt;li&gt;Est&amp;eacute;reo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '4a1a639231cf8f83efc86f396146baec', 1390.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(40, 161, 'Auriculares i7S TWS Bluetooth', '&lt;p&gt;Auriculares inalambricos que se conectan a trav&amp;eacute;s de bluetooth (4.2).&lt;/p&gt;\r\n\r\n&lt;p&gt;Ideales y c&amp;oacute;modos para escuchar m&amp;uacute;sica mientras haces deportes, tareas de la casa;&lt;br /&gt;\r\nmientras conduces los puedes usar como manos libres.&lt;/p&gt;\r\n\r\n&lt;p&gt;Detalles:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;Micr&amp;oacute;fono y bot&amp;oacute;n multinacional incluido para recibir llamadas&lt;/li&gt;\r\n&lt;li&gt;Tiempo de bater&amp;iacute;a 2-3 horas&lt;/li&gt;\r\n&lt;li&gt;Alcance 10 mts&lt;/li&gt;\r\n&lt;li&gt;Cargador Inalambrico&lt;/li&gt;\r\n&lt;li&gt;Conexi&amp;oacute;n Bluetooth 4.2&lt;/li&gt;\r\n&lt;li&gt;Parlantes Estero 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Compatible:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;iOS&lt;/li&gt;\r\n&lt;li&gt;Android&lt;/li&gt;\r\n&lt;li&gt;Windows&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Contenido:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;Par de auriculares&lt;/li&gt;\r\n&lt;li&gt;Caja de carga&lt;/li&gt;\r\n&lt;li&gt;Manual&lt;/li&gt;\r\n&lt;li&gt;Cable micro USB&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '63acacf572b8dfff9626473c67944fd8', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 50, 1, 0),
	(41, 161, 'Parlante Bluetooth ROCA', '&lt;p&gt;Escucha la m&amp;uacute;sica que quieres, donde quieras con este practico parlante port&amp;aacute;til!&lt;/p&gt;\r\n', 'f29d1589f88d93125ba678a99b24ae64', 540.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(42, 68, 'Brazalete hasta 4 pulgadas', '&lt;p&gt;Ideal para tener tu dispositivo de hasta 4 pulgadas seguro mientras haces actividades.&lt;/p&gt;\r\n', 'd753a93a4d27c85a17398687c1e18679', 300.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(43, 68, 'Cable de datos MICRO USB', '&lt;ul&gt;\r\n&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '816994e1a25e51a8754f12caac349d64', 190.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 50, 1, 0),
	(44, 68, 'Cable de datos TIPO-C', '&lt;ul&gt;\r\n&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 'ebad02c778900d80810b2dcd46241802', 250.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 50, 1, 0),
	(45, 228, 'Relogio Masculino', '&lt;p&gt;zxcxzcxczxcz&lt;/p&gt;\r\n', '315737fdbaa4efcb8e935dbdc8eddf33', 32.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 30, 3, 0),
	(46, 255, 'CARTERA BOLSO KORIUM CON DOBLE CIERRE FRONTAL ', '&lt;p&gt;Cartera tipo bolso Korium con doble cierre frontal y cierre central. Material sint&amp;eacute;tico s&amp;iacute;mil cuero.&lt;/p&gt;\r\n', '273a2311c486376604393b73d8d0c12f', 890.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 6, 1, 0),
	(47, 255, 'Cartera Bolso Korium Tramada con Rafia', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '3b20b15cb14ede7dd082d11634607eee', 890.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 1, 0),
	(48, 255, 'CARTERA KORIUM CLÁSICA CON MANIJA A MEDIDA', '&lt;p&gt;Cartera tipo bolso Korium con cierre de material textil con detalles de tramado de rafia alrededor.&lt;/p&gt;\r\n', '531262b335faba33437d97a88adb3476', 990.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 1, 0),
	(49, 247, 'GORRO UMBRO NEGRO CON LOGO FRONTAL ', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Este gorro es ideal para la temporada de oto&amp;ntilde;o invierno, complementando un look sport casual para tu tiempo libre o para todos los d&amp;iacute;as.&lt;/p&gt;\r\n', '904c564d07fb0c069ef01c8c48b951e7', 360.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 1, 1, 0),
	(50, 255, 'Mochila Clasica Jansport Superbreak Verde', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '5eb09118d0c8c2b5cb3b7dbef1a44b21', 1590.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 5, 1, 0),
	(51, 255, 'Mochila Clasica Jansport Superbreak Azul', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '7002e7b58907181472922676d0f2e1f2', 1590.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 5, 1, 0),
	(52, 255, 'Mochila Clasica Jansport Superbreak Rosada', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '3a11ee90230a0555988b27fe2208063e', 1590.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 5, 1, 0),
	(53, 255, 'Mochila Clasica Jansport Superbreak Violeta', '&lt;p&gt;La mochila Jansport SuperBreak es un modelo cl&amp;aacute;sico ideal para el uso diario. La mochila est&amp;aacute; disponible en varios colores, perfectos para cada estilo.&lt;/p&gt;\r\n', '56befbe854d16d3d3b740d10bbf7595a', 1590.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 1, 0),
	(54, 108, 'Notebook Asus S510uf-bq091t I7 W10 GEFORCE MX130 U', '&lt;p&gt;El ASUS VivoBook S ofrece la combinaci&amp;oacute;n ideal de belleza y rendimiento. Con su marco NanoEdge, acabado de metal pulido, procesador Intel&amp;reg; y gr&amp;aacute;fica NVIDIA, el VivoBook S es un port&amp;aacute;til pensado para los agitados estilos de vida de hoy en d&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;Garant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nPart Number 90NB0IK1-M03490&amp;nbsp;&lt;br /&gt;\r\nMarca Asus&amp;nbsp;&lt;br /&gt;\r\nCPU Intel&amp;reg; Core&amp;trade; i7-8550U Processor, 1.8 GHz (8M Cache, up to 4GHz)&amp;nbsp;&lt;br /&gt;\r\nMemoria 8 GB DDR4 2 slot memoria max. 16 gb&amp;nbsp;&lt;br /&gt;\r\nDisco Duro SATA 1TB 5400RPM 2.5&amp;#39; HDD&amp;nbsp;&lt;br /&gt;\r\nPantalla 15,6&amp;#39;//Ultra Slim 250nits// FHD 1920X1080 16:9 // AntiGlade // NTSC:45% // Wide View&amp;nbsp;&lt;br /&gt;\r\nResoluci&amp;oacute;n FHD 1920X1080&amp;nbsp;&lt;br /&gt;\r\nTarj. Video Intel UHD 620&amp;nbsp;&lt;br /&gt;\r\nCamara Web VGA web camera (Fixed type)&amp;nbsp;&lt;br /&gt;\r\nAudio Built-in speaker&amp;nbsp;&lt;br /&gt;\r\nBuilt-in microphone&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Sonic Master&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Bater&amp;iacute;a 42WHrs, 3S1P, 3-cell Li-ion&amp;nbsp;&lt;br /&gt;\r\nCard Reader SDXC&amp;nbsp;&lt;br /&gt;\r\nBluetooth 4.2&amp;nbsp;&lt;br /&gt;\r\nWifi Integrado 802.11 AC&amp;nbsp;&lt;br /&gt;\r\nUsb 2x USB 2.0&amp;nbsp;&lt;br /&gt;\r\n1x USB 3.0&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x USB3.1 Type C (gen 1)&amp;quot;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Hdmi 1.4&amp;nbsp;&lt;br /&gt;\r\nOtros Puertos I/0 1x Headphone-out &amp;amp; Audio-in Combo Jack&amp;nbsp;&lt;br /&gt;\r\n1x RJ45 LAN Jack for LAN insert&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;1x VGA Port (D-Sub)&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Teclado Chiclet espa&amp;ntilde;ol&amp;nbsp;&lt;br /&gt;\r\nMedidas (mm.) 36.1(W) x 24.3(D) x 1.79 ~ 1.79 (H) cm&amp;nbsp;&lt;br /&gt;\r\nPeso (kgs.) 1.7 KGS con bater&amp;iacute;a&amp;nbsp;&lt;br /&gt;\r\nColor GOLD METAL&amp;nbsp;&lt;br /&gt;\r\nSistema Operativo Windows 10 home ( 64 bits)&amp;nbsp;&lt;br /&gt;\r\nGarant&amp;iacute;a 1 a&amp;ntilde;o en Centro Autorizado de Servicio&lt;/p&gt;\r\n', '2ff7cae74ac678e34c17d5698abf36d0', 32400.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 2, 1, 0),
	(55, 108, 'Notebook Hp Stream 11.6 Dual Core 4GB Ram 32Gb SSD', '&lt;p&gt;Ideal para la inform&amp;aacute;tica b&amp;aacute;sica, ya sea en casa o mientras viaja, disfruta de la navegaci&amp;oacute;n web, las redes sociales, el chat, las videollamadas, usa aplicaciones de oficina, correos electr&amp;oacute;nicos y descarga de aplicaciones.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;1 a&amp;ntilde;o&lt;br /&gt;\r\nProcesador Intel Dual Core N2840 - 2.58GHz&lt;br /&gt;\r\nPantalla LED HD 11.6&amp;quot; 1366 x 768&lt;br /&gt;\r\nMemoria RAM 4GB DDR3L 1333MHz&lt;br /&gt;\r\nDisco S&amp;oacute;lido SSD 32GB&lt;br /&gt;\r\nS.O. Windows 10&lt;br /&gt;\r\nGr&amp;aacute;ficos Intel HD Graphic&lt;br /&gt;\r\nWebCam, micr&amp;oacute;fono&lt;br /&gt;\r\nHDMI, USB 3.0, USB 2.0&lt;br /&gt;\r\nLector de tarjetas de memoria&lt;br /&gt;\r\nBater&amp;iacute;a de 3 celdas&lt;br /&gt;\r\nPeso: 1.23 Kg&lt;/p&gt;\r\n', 'd795ac99ca3516bc28c38eb519031bac', 8950.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(56, 137, 'Pelota de fútbol Topper Ultra Azul', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b5ab5bfbb231c14615f83d2ed7580b55', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(57, 137, 'Pelota de Futbol Topper Ultra VIII Roja', '&lt;p&gt;Topper ofrece una variedad de accesorios para el d&amp;iacute;a a d&amp;iacute;a y para practicar tu deporte favorito.&lt;/p&gt;\r\n', 'b756d15507a508c4f5565a10fe03a2fd', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(58, 137, 'Pelota Neo Trainer 5 Umbro', '&lt;p&gt;Umbro es una marca deportiva que ofrece productos para todas tus necesidades. Esta pelota es ideal para practicar el deporte que m&amp;aacute;s te gusta.&lt;/p&gt;\r\n', '2496b899d43cdea1a7902868ad3aa993', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(59, 108, 'Notebook HP Quadcore 2.4Ghz 4GB 500GB 15.6 Win 10', '&lt;p&gt;Factory Refurbished. Modelo 15-ba015wm.&lt;br /&gt;\r\nGarant&amp;iacute;a:&amp;nbsp;&amp;nbsp; &amp;nbsp;6 meses&lt;br /&gt;\r\nN&amp;uacute;mero de parte HP 1NT85UA.&lt;br /&gt;\r\nColor negro.&lt;br /&gt;\r\nMicrosoft Windows 10 Home 64-bit en ingl&amp;eacute;s pre-instalado.&lt;br /&gt;\r\nProcesador AMD QuadCore E2-7110 2.0GHz (hasta 2.4 Ghz).&lt;br /&gt;\r\nMemoria 4GB DDR4-2133 SDRAM.&lt;br /&gt;\r\nGrabadora SuperMulti DVD burner.&lt;br /&gt;\r\nDisco Duro 500GB 5400rpm.&lt;br /&gt;\r\nPantalla 15.6&amp;quot; diagonal HD SVA BrightView WLED-backlit (1366 x 768).&lt;br /&gt;\r\nVideo AMD Radeon R2 Graphics.&lt;br /&gt;\r\nSonido DTS Studio Sound con parlantes est&amp;eacute;reo.&lt;br /&gt;\r\nRed LAN 10/100. 802.11n Wireless LAN.&lt;br /&gt;\r\nWebcam con micr&amp;oacute;fono digital integrado&lt;br /&gt;\r\nTeclado en ingl&amp;eacute;s completo con teclado num&amp;eacute;rico.&lt;br /&gt;\r\nBater&amp;iacute;a de 4 celdas 41Whr de litio ion.&lt;br /&gt;\r\nLector de micro SD.&lt;/p&gt;\r\n\r\n&lt;p&gt;Puertos disponibles:&lt;/p&gt;\r\n\r\n&lt;p&gt;1 HDMI&lt;br /&gt;\r\n2 USB 2.0&lt;br /&gt;\r\n1 USB 3.0&lt;br /&gt;\r\n1 RJ-45 (LAN)&lt;br /&gt;\r\n1 Headphone-out/microphone-in combo jack&lt;/p&gt;\r\n', '38a9d0d1586b08023a31414ed045c359', 11960.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 1, 0),
	(60, 161, 'Auriculares de vincha GORSUN', '&lt;ul&gt;\r\n&lt;li&gt;Inal&amp;aacute;mbricos.&lt;/li&gt;\r\n&lt;li&gt;Calidad de sonido superior.&lt;/li&gt;\r\n&lt;li&gt;Alta administraci&amp;oacute;n de buffer.&lt;/li&gt;\r\n&lt;li&gt;Reproduce tarjetas Micro SD.&lt;/li&gt;\r\n&lt;li&gt;Plegables y pr&amp;aacute;cticos para transportar.&lt;/li&gt;\r\n&lt;li&gt;Estereo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '572d5b93d2d4bbbe0dedaaf07e992aeb', 1100.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 10, 2, 0),
	(61, 161, 'Auriculares de vincha XION', '&lt;ul&gt;\r\n&lt;li&gt;Bluetooth&lt;/li&gt;\r\n&lt;li&gt;Con bater&amp;iacute;as recargables&lt;/li&gt;\r\n&lt;li&gt;Micr&amp;oacute;fono&lt;/li&gt;\r\n&lt;li&gt;Con botones de control para operar su dispositivo.&lt;/li&gt;\r\n&lt;li&gt;Compatibles con IOS y Android&lt;/li&gt;\r\n&lt;li&gt;Est&amp;eacute;reo 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '4a1a639231cf8f83efc86f396146baec', 1390.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(62, 161, 'Auriculares i7S TWS Bluetooth', '&lt;p&gt;Auriculares inalambricos que se conectan a trav&amp;eacute;s de bluetooth (4.2).&lt;/p&gt;\r\n\r\n&lt;p&gt;Ideales y c&amp;oacute;modos para escuchar m&amp;uacute;sica mientras haces deportes, tareas de la casa;&lt;br /&gt;\r\nmientras conduces los puedes usar como manos libres.&lt;/p&gt;\r\n\r\n&lt;p&gt;Detalles:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;Micr&amp;oacute;fono y bot&amp;oacute;n multinacional incluido para recibir llamadas&lt;/li&gt;\r\n&lt;li&gt;Tiempo de bater&amp;iacute;a 2-3 horas&lt;/li&gt;\r\n&lt;li&gt;Alcance 10 mts&lt;/li&gt;\r\n&lt;li&gt;Cargador Inalambrico&lt;/li&gt;\r\n&lt;li&gt;Conexi&amp;oacute;n Bluetooth 4.2&lt;/li&gt;\r\n&lt;li&gt;Parlantes Estero 2.0&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Compatible:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;iOS&lt;/li&gt;\r\n&lt;li&gt;Android&lt;/li&gt;\r\n&lt;li&gt;Windows&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Contenido:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n&lt;li&gt;Par de auriculares&lt;/li&gt;\r\n&lt;li&gt;Caja de carga&lt;/li&gt;\r\n&lt;li&gt;Manual&lt;/li&gt;\r\n&lt;li&gt;Cable micro USB&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '63acacf572b8dfff9626473c67944fd8', 690.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 50, 1, 0),
	(63, 161, 'Parlante Bluetooth ROCA', '&lt;p&gt;Escucha la m&amp;uacute;sica que quieres, donde quieras con este practico parlante port&amp;aacute;til!&lt;/p&gt;\r\n', 'f29d1589f88d93125ba678a99b24ae64', 540.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(64, 68, 'Brazalete hasta 4 pulgadas', '&lt;p&gt;Ideal para tener tu dispositivo de hasta 4 pulgadas seguro mientras haces actividades.&lt;/p&gt;\r\n', 'd753a93a4d27c85a17398687c1e18679', 300.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 20, 1, 0),
	(65, 68, 'Cable de datos MICRO USB', '&lt;ul&gt;\r\n&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', '816994e1a25e51a8754f12caac349d64', 190.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 50, 1, 0),
	(66, 68, 'Cable de datos TIPO-C', '&lt;ul&gt;\r\n&lt;li&gt;1 metro o 2 metros&lt;/li&gt;\r\n&lt;li&gt;2 amperes&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 'ebad02c778900d80810b2dcd46241802', 250.00, 0, 0, NULL, 'PUBLICADA', 'USADO', 50, 1, 0);

INSERT INTO PUBLICACIONIMG (ID, IMAGENES) VALUES
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
	(22, 'ebad02c778900d80810b2dcd46241802'),
	(23,'315737fdbaa4efcb8e935dbdc8eddf33'),
	(24,'273a2311c486376604393b73d8d0c12f'),
	(24,'2deb96b3b400f3c81046aba4c29a62f6'),
	(24,'697c4bb34f48226222dc0982b6144ef3'),
	(25,'27f144863894407c52a1e57ccad7731e'),
	(25,'3b20b15cb14ede7dd082d11634607eee'),
	(25,'ad9589605e3e90fc9615bfcec5faa317'),
	(25,'d0a23ce84a1f55cf349d3f13cbd2501d'),
	(26,'3035f97fa9a3ae8f5dd5b06d0400c5da'),
	(26,'531262b335faba33437d97a88adb3476'),
	(26,'7d8dc93d3fc0fc42e31ff75078c4edd2'),
	(26,'bb4970292db5798df13b112d972acec4'),
	(26,'e82425b3a16697cbf370681ed668cf92'),
	(27,'904c564d07fb0c069ef01c8c48b951e7'),
	(27,'b966fe64886491293ed435cbfa753739'),
	(28,'5eb09118d0c8c2b5cb3b7dbef1a44b21'),
	(28,'83b24303818da6b93ed966462364c006'),
	(29,'7002e7b58907181472922676d0f2e1f2'),
	(29,'a44d580c1bbaf65e985c19b10e97be73'),
	(30,'2da02eb7435948f37810b8916842c49a'),
	(30,'3a11ee90230a0555988b27fe2208063e'),
	(31,'086cb7a5926734760a53aeb5fcd8117a'),
	(31,'56befbe854d16d3d3b740d10bbf7595a'),
	(32,'2ff7cae74ac678e34c17d5698abf36d0'),
	(33,'0e47a04bb62699c7d2d76c66f3805544'),
	(33,'31791b8614f355023e468606826b26cf'),
	(33,'d795ac99ca3516bc28c38eb519031bac'),
	(34,'1035659bdae90dc64c8688b940ac42fc'),
	(34,'b5ab5bfbb231c14615f83d2ed7580b55'),
	(35,'6604c89eea07ec6fc8ca5fa40e443011'),
	(35,'b756d15507a508c4f5565a10fe03a2fd'),
	(36,'0f28799cd7296596b94acf151a131f2c'),
	(36,'2496b899d43cdea1a7902868ad3aa993'),
	(37,'38a9d0d1586b08023a31414ed045c359'),
	(38,'572d5b93d2d4bbbe0dedaaf07e992aeb'),
	(38,'aa6bb48513cdedd8c26b52e2891cfb30'),
	(38,'d9ef5db5da36f59ba8616555b86841f7'),
	(38,'f3473771156bfd27e8c1220f543c5255'),
	(39,'2ebcd0353b25f5a356924e64da6de79d'),
	(39,'4a1a639231cf8f83efc86f396146baec'),
	(39,'f9161e73611ac35872443e293158efb7'),
	(40,'2df6f411253fa2c8ca1f8f9db563da3c'),
	(40,'38cc87d3e2fbaf035ad040ca4e0294d0'),
	(40,'63acacf572b8dfff9626473c67944fd8'),
	(40,'9bca5fb8f36e86888c3863ff50543b41'),
	(41,'39096bbbd69de17d1a5e34971862d247'),
	(41,'f29d1589f88d93125ba678a99b24ae64'),
	(42,'448d828ce33edffaf759fa72c732d091'),
	(42,'492da95e8e12aec6676f3538f5b6402c'),
	(42,'5a26642fbae4c509682415432a7e6888'),
	(42,'d753a93a4d27c85a17398687c1e18679'),
	(43,'816994e1a25e51a8754f12caac349d64'),
	(43,'898837f9257cad824d19912ae4212529'),
	(44,'d95cd61cfb3b345c417a174b317a56ef'),
	(44,'ebad02c778900d80810b2dcd46241802'),
	(45,'315737fdbaa4efcb8e935dbdc8eddf33'),
	(46,'273a2311c486376604393b73d8d0c12f'),
	(46,'2deb96b3b400f3c81046aba4c29a62f6'),
	(46,'697c4bb34f48226222dc0982b6144ef3'),
	(47,'27f144863894407c52a1e57ccad7731e'),
	(47,'3b20b15cb14ede7dd082d11634607eee'),
	(47,'ad9589605e3e90fc9615bfcec5faa317'),
	(47,'d0a23ce84a1f55cf349d3f13cbd2501d'),
	(48,'3035f97fa9a3ae8f5dd5b06d0400c5da'),
	(48,'531262b335faba33437d97a88adb3476'),
	(48,'7d8dc93d3fc0fc42e31ff75078c4edd2'),
	(48,'bb4970292db5798df13b112d972acec4'),
	(48,'e82425b3a16697cbf370681ed668cf92'),
	(49,'904c564d07fb0c069ef01c8c48b951e7'),
	(49,'b966fe64886491293ed435cbfa753739'),
	(50,'5eb09118d0c8c2b5cb3b7dbef1a44b21'),
	(50,'83b24303818da6b93ed966462364c006'),
	(51,'7002e7b58907181472922676d0f2e1f2'),
	(51,'a44d580c1bbaf65e985c19b10e97be73'),
	(52,'2da02eb7435948f37810b8916842c49a'),
	(52,'3a11ee90230a0555988b27fe2208063e'),
	(53,'086cb7a5926734760a53aeb5fcd8117a'),
	(53,'56befbe854d16d3d3b740d10bbf7595a'),
	(54,'2ff7cae74ac678e34c17d5698abf36d0'),
	(55,'0e47a04bb62699c7d2d76c66f3805544'),
	(55,'31791b8614f355023e468606826b26cf'),
	(55,'d795ac99ca3516bc28c38eb519031bac'),
	(56,'1035659bdae90dc64c8688b940ac42fc'),
	(56,'b5ab5bfbb231c14615f83d2ed7580b55'),
	(57,'6604c89eea07ec6fc8ca5fa40e443011'),
	(57,'b756d15507a508c4f5565a10fe03a2fd'),
	(58,'0f28799cd7296596b94acf151a131f2c'),
	(58,'2496b899d43cdea1a7902868ad3aa993'),
	(59,'38a9d0d1586b08023a31414ed045c359'),
	(60,'572d5b93d2d4bbbe0dedaaf07e992aeb'),
	(60,'aa6bb48513cdedd8c26b52e2891cfb30'),
	(60,'d9ef5db5da36f59ba8616555b86841f7'),
	(60,'f3473771156bfd27e8c1220f543c5255'),
	(61,'2ebcd0353b25f5a356924e64da6de79d'),
	(61,'4a1a639231cf8f83efc86f396146baec'),
	(61,'f9161e73611ac35872443e293158efb7'),
	(62,'2df6f411253fa2c8ca1f8f9db563da3c'),
	(62,'38cc87d3e2fbaf035ad040ca4e0294d0'),
	(62,'63acacf572b8dfff9626473c67944fd8'),
	(62,'9bca5fb8f36e86888c3863ff50543b41'),
	(63,'39096bbbd69de17d1a5e34971862d247'),
	(63,'f29d1589f88d93125ba678a99b24ae64'),
	(64,'448d828ce33edffaf759fa72c732d091'),
	(64,'492da95e8e12aec6676f3538f5b6402c'),
	(64,'5a26642fbae4c509682415432a7e6888'),
	(64,'d753a93a4d27c85a17398687c1e18679'),
	(65,'816994e1a25e51a8754f12caac349d64'),
	(65,'898837f9257cad824d19912ae4212529'),
	(66,'d95cd61cfb3b345c417a174b317a56ef'),
	(66,'ebad02c778900d80810b2dcd46241802');

INSERT INTO crea (ID, IDUSUARIO, IDPUBLICACION) VALUES
	(1,9,1),
	(2,1,2),
	(3,8,3),
	(4,4,4),
	(5,5,5),
	(6,9,6),
	(7,8,7),
	(8,7,8),
	(9,3,9),
	(10,7,10),
	(11,2,11),
	(12,5,12),
	(13,5,13),
	(14,6,14),
	(15,4,15),
	(16,6,16),
	(17,4,17),
	(18,3,18),
	(19,4,19),
	(20,2,20),
	(21,2,21),
	(22,4,22),
	(23,6,23),
	(24,8,24),
	(25,3,25),
	(26,1,26),
	(27,5,27),
	(28,4,28),
	(29,1,29),
	(30,8,30),
	(31,8,31),
	(32,1,32),
	(33,8,33),
	(34,9,34),
	(35,3,35),
	(36,6,36),
	(37,4,37),
	(38,1,38),
	(39,2,39),
	(40,7,40),
	(41,1,41),
	(42,8,42),
	(43,4,43),
	(44,5,44),
	(45,5,45),
	(46,2,46),
	(47,7,47),
	(48,2,48),
	(49,6,49),
	(50,3,50),
	(51,6,51),
	(52,1,52),
	(53,1,53),
	(54,5,54),
	(55,7,55),
	(56,7,56),
	(57,8,57),
	(58,3,58),
	(59,5,59),
	(60,2,60),
	(61,9,61),
	(62,3,62),
	(63,1,63),
	(64,4,64),
	(65,2,65),
	(66,6,66);