<?php
	if (isset($_GET['cod'])){		
		header('Location: view/mailactivate.php?cod='.$_GET['cod']);
	}else{
		header('Location: index.php');
	}
?>