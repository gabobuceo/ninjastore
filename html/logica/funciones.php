<?php
//require_once('config.php');
function conectar(){
  if (!isset($conexion)) {
    try {
      static $conexion;
      $config = include('../config/config.php');
      $conexion = new PDO('mysql:host='.$config->bdhost.';port='.$config->bdport.';dbname='.$config->bdname, $config->bduser, $config->bdpass);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return($conexion);
    } catch (PDOException $e) {

      print "<p>Error: No puede conectarse con la base de datos.</p>".$e->getMessage();
      exit();
    }
  }
}


function desconectar($conexion)
{
	$conexion=null;
}

function salir() {
	session_unset();
	session_destroy();

}

function obtenerFechaSistema()
{
	//Seteo la hora con la zona horaria.
	date_default_timezone_set('America/Montevideo');
	setlocale(LC_TIME, 'spanish');	 
	return date("Y-m-d");
}

function calcularEdad($fecNac) {
	$hoy = obtenerFechaSistema();
	$fecNacFormateada = date("Y-m-d", strtotime($fecNac));
	$edad=round(((((strtotime($hoy)-strtotime($fecNacFormateada))/365)/24)/60)/60);
	if ($edad>=18) {
		$resultado=true;		
	}else{
		$resultado=false;
	}
	return $resultado;
}

function insertarCalificacion($calificaccion){
	if ($calificaccion == NULL) {
		$calificaccion=0;
	}
	for ($i=1; $i < 6; $i++) { 
		if ($i<=$calificaccion) {
			echo "<span class='fa fa-star checked'></span>";
		}else{
			echo "<span class='fa fa-star-o checked'></span>";
		}
	}
}
function cargarCategoriasHijos($id){
	$conex=conectar();
	require_once ('../clases/Categoria.class.php');
	if(session_id() == '') {
		session_start();
	}
	$cat= new Categoria('',$id);
	return $cat->consultaHijos($conex);
}
function cargarCategoriasPadres(){
	$conex=conectar();
	require_once ('../clases/Categoria.class.php');
	if(session_id() == '') {
		session_start();
	}
	$cat= new Categoria('');
	return $cat->consultaPadres($conex);
}
function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
  ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
      $version= $matches['version'][0];
    }else {
      $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern
  );
} 
function textovalido($texto){
  switch ($texto) {
    case null:
    $_SESSION['eee']="caso null";
    return false;
    break;
    case strlen($texto) < 4:
    $_SESSION['eee']="strlen";
    return false;
    break;
    default:
    $_SESSION['eee']="ok";
    return true;
    break;
  }
}

function cargarimgtn($imagen){
  echo "<img src='../imagenes/".$imagen."_tn.".$_SESSION['EXT']."' onerror=this.onerror=null;this.src='../static/img/noimage_tn.".$_SESSION['EXT']."' />";
}
function cargarimgdi($imagen){
  echo "<img src='../imagenes/".$imagen."_di.".$_SESSION['EXT']."' onerror=this.onerror=null;this.src='../static/img/noimage_di.".$_SESSION['EXT']."' />";
}
function cargarimg($imagen){
  echo "<img src='../imagenes/".$imagen.".".$_SESSION['EXT']."' onerror=this.onerror=null;this.src='../static/img/noimage.".$_SESSION['EXT']."' />";
}


?>    