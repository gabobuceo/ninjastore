<?php
require_once('../logica/funciones.php');
require_once('../clases/Pregunta.class.php');
// -------- GET DATA ----
session_start();
if (!isset($_SESSION['id'])) {
  $_SESSION['mobjetivo']="login.php";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>Debes estar logeado para poder enviar preguntas";
  header('Location: ../view/login.php');
}else{
  try {   
    /*
    print_r($_SESSION);
    echo "<br>";
    print_r($_GET);
    echo "<br>";
    print_r($_POST);
    echo "<br>";
    echo $_SESSION['id']."<br>".$_GET['idpublicacion']."<br>".$_POST['pregunta'];
    */
    $idpublicacion=$_GET['idpublicacion'];
    $conex = conectar();			
    $c= new Pregunta("",$_SESSION['id'],$idpublicacion,$_POST['pregunta']);
    $datos_c=$c->alta($conex);
    if (!empty($datos_c)){
      $_SESSION['mobjetivo']="publication.php";
      $_SESSION['mtipo']="alert-success";
      $_SESSION['mtexto']="<strong>!Felicidades! </strong>Pregunta realizada con éxito";
      header('Location: ../view/publication.php?id='.$idpublicacion);
    }else{
      $_SESSION['mobjetivo']="publication.php";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>La pregunta no fue ingresada";
      header('Location: ../view/publication.php?id='.$idpublicacion);
    }
  } catch (PDOException $e) {
    print "Error: ".$e->getMessage();
    exit();
  }
}
?>