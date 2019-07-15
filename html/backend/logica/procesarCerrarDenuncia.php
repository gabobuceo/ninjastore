<?php
session_start();
/*var_dump($_POST);
exit();
/*
CREATE TABLE GESTIONA(
	ID 	SERIAL NOT NULL,
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
*/
/*
CREATE TABLE DENUNCIA(
	ID 				SERIAL 			NOT NULL,
	FECHA			TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	TIPO			VARCHAR(15) 	NOT NULL,
	IDOBJETO		BIGINT(20)		UNSIGNED NOT NULL,
	COMENTARIO 		VARCHAR(150),
	ESTADO 			VARCHAR(10) 	DEFAULT 'ABIERTA',
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	INDEX			(IDOBJETO),
	CHECK			(TIPO='PUBLICACION' AND TIPO='COMENTARIO' AND TIPO='COMPRA' AND TIPO='CATEGORIAS' AND TIPO='USUARIO'),
	CHECK			(ESTADO='ABIERTA' AND ESTADO='CERRADA' AND ESTADO='EN PROCESO')
);
*/
$idgestion=$_POST['idgestion'];
$iddenuncia=$_POST['iddenuncia'];
/*$idobjeto=$_POST['idobjeto'];
$tipo=$_POST['tipo'];*/
$options=$_POST['options'];
$comentario=$_POST['comentario'];


require_once('../../logica/funciones.php');
require_once('../clases/Gestiona.class.php');
require_once('../clases/Denuncia.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados

try {          
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	$c= new Gestiona($idgestion,'','','',$comentario,$options);
	if ($c->resolverIncidencia($conex)!= TRUE){
		$commiteo->Rollbackeo($conex);
		$_SESSION['mobjetivo']="misdatos";
		$_SESSION['mtipo']="alert-warning";
		$_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";
		header("Location: ../view/mgmtreports.php?id=".$iddenuncia);	
	}else{
		$c= new Denuncia($iddenuncia);
		if ($c->resolverIncidencia($conex)!= TRUE){
			$commiteo->Rollbackeo($conex);
			$_SESSION['mobjetivo']="misdatos";
			$_SESSION['mtipo']="alert-warning";
			$_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";
			header("Location: ../view/mgmtreports.php?id=".$iddenuncia);	
		}else{
			$commiteo->Commiteo($conex);
			$commiteo->AutoCommitON($conex);
			$_SESSION['mobjetivo']="misdatos";
			$_SESSION['mtipo']="alert-info";
			$_SESSION['mtexto']="<strong>!Se creó la categoría con exito! </strong>";
			header("Location: ../view/mgmtreports.php?id=".$iddenuncia);	
		}
	}
} catch (PDOException $e) {
	$commiteo->Rollbackeo($conex);
	$_SESSION['mobjetivo']="mailactivate.php";
	$_SESSION['mtipo']="alert-danger";
	$_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
	header('Location: ../view/mgmtreports.php?id='.$iddenuncia);
}
?>