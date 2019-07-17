<?php
session_start();
require_once ('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados

// -------- GET DATA ----
$idusuario = $_POST['idusumod'];
$baja = $_POST['bajausu'];
try {          
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Usuario($idusuario,'','','','','','','','','','','','','','','','','','','','','',$baja); 
    if ($c->baja($conex)!= TRUE){
        $commiteo->Rollbackeo($conex);
        $_SESSION['mobjetivo']="mitelefono";
        $_SESSION['mtipo']="alert-warning";
        $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo borrar el telefono";
        header('Location: ../view/mgmtusers.php?id='.$idusuario);
    }else{
        $commiteo->Commiteo($conex);
        $_SESSION['mobjetivo']="mitelefono";
        $_SESSION['mtipo']="alert-info";
        $_SESSION['mtexto']="<strong>!Telefono borrado! </strong>";
        header('Location: ../view/mgmtusers.php?id='.$idusuario);
    }
    
} catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="mitelefono";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header('Location: ../view/mgmtusers.php?id='.$idusuario);
}

?>