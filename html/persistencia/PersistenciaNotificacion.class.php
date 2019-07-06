<?php
/*
NOTIFICACION(ID,USUARIO,DESCRIPCION,LINK,TIPO,FECHA,VISTO,BAJA)
CHECK	(TIPO='PREGUNTA' AND TIPO='RESPUESTA' AND TIPO='COMPRA' AND TIPO='VENTA' AND TIPO='CONFIRMADO' AND TIPO='CALIFICACION' AND TIPO='BANEADO' AND TIPO='FINALIZADO'),

getId()
getIdUsuario()
getDescripcion()
getLink()
getTipo()
getFecha()
getVisto()
getBaja()
*/
class PersistenciaNotificacion{
	public function agregarpregunta($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="PREGUNTA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarrespuesta($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="RESPUESTA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarcompra($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="COMPRA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarventa($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="VENTA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarconfirmadoc($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="CONFIRMADOC";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarcalificacionc($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="CALIFICACIONC";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarconfirmadov($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="CONFIRMADOV";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarcalificacionv($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="CALIFICACIONV";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarpermuta($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="PERMUTA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarpermutaaceptada($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="PERMUTA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarpermutacancelada($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="PERMUTA";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarbaneado($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="BANEADO";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function agregarfinalizado($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$descripcion=trim($obj->getDescripcion());
		$link=trim($obj->getLink());
		$publicacion=trim($obj->getPublicacion());
		$tipo="FINALIZADO";
		$sql = "INSERT INTO NOTIFICACION (USUARIO,DESCRIPCION,LINK,TIPO,PUBLICACION) VALUES (:USUARIO,:DESCRIPCION,:LINK,:TIPO,:PUBLICACION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario,
			":DESCRIPCION" => $descripcion,
			":LINK" => $link,
			":TIPO" => $tipo,
			":PUBLICACION" => $publicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function consTodos($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT NOTIFICACION.*,PUBLICACION.IMGDEFAULT FROM NOTIFICACION,PUBLICACION WHERE USUARIO=:USUARIO AND NOTIFICACION.PUBLICACION=PUBLICACION.ID ORDER BY NOTIFICACION.FECHA DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consTodosNoLeidos($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT NOTIFICACION.*,PUBLICACION.IMGDEFAULT FROM NOTIFICACION,PUBLICACION WHERE USUARIO=:USUARIO AND NOTIFICACION.PUBLICACION=PUBLICACION.ID AND NOTIFICACION.VISTO=0 ORDER BY NOTIFICACION.FECHA DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":USUARIO" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT NOTIFICACION.*,PUBLICACION.IMGDEFAULT FROM NOTIFICACION,PUBLICACION WHERE NOTIFICACION.ID=:ID AND NOTIFICACION.PUBLICACION=PUBLICACION.ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consMaxID($conex){
		$sql = "SELECT MAX(ID) FROM NOTIFICACION";

		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function notivisto($obj, $conex){
		$id= trim($obj->getId());
		$sql = "UPDATE NOTIFICACION SET VISTO=1 WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
}

?>