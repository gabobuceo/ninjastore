<?php
//session_start();
if (isset($_POST['cmbCatPadre']) and !empty($_POST['cmbCatPadre'])){
	$catPadre=strip_tags(trim($_POST['cmbCatPadre']));
	session_start();	
	$_SESSION["catPadre"]=$catPadre;
	header('Location: ../view/altaPublicacion.php');
}else{
	?>
		<script type="text/javascript">
			window.alert("Elija una categoria.");
		</script>
	<?php	
	header('Location: ../view/cppubnue.php');			
} 
//die(var_dump($catPadre));
// // if ($error) {
// 	?>
// 		<script type="text/javascript">
// 			window.alert("Elija una categoria.");
// 		</script>
// 	<?php
// 	$catPadre="";
// 	header('Location: ../view/cppubnue.php');
// }else {	  
// 	session_start();
// 	$_SESSION["catPadre"]=$catPadre;
// 	header('Location: ../view/altaPublicacion.php');
// } 
?>