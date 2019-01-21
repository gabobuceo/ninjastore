<?php
	if (isset($_GET['cod'])){		
		header('Location: logica/procesarRecuperarCuenta.php?cod='.$_GET['cod']);
	}else{
		header('Location: index.php');
	}
?>