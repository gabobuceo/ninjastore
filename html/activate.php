<?php 
	session_start();
	if (isset($_GET['cod'])){
		$_SESSION['activationkey']=$_GET['cod'];		
		header('Location: view/mailactivate.php');
	}else{
		header('Location: index.php');
	}
?>

