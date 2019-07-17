<?php

class PersistenciaPublicacion
{
	//param es un objeto de tipo Usuario
	//conex es una variable de tipo conexion
	public function agregar($obj, $conex)
	{
		$idCategoria = $obj->getIdCategoria();
		$titulo = $obj->getTitulo();
		$descripcion = $obj->getDescripcion();
		$imgdefault = $obj->getImgDef();
		$precio = $obj->getPrecio();
		$estadoP = $obj->getEstadoP();
		$estadoA = $obj->getEstadoA();
		$cantidad = $obj->getCantidad();		

		$sql = "INSERT INTO PUBLICACION (IDCATEGORIA, TITULO, DESCRIPCION, IMGDEFAULT, PRECIO, ESTADOP, ESTADOA, CANTIDAD) VALUES (:IDCATEGORIA, :TITULO, :DESCRIPCION, :IMGDEFAULT, :PRECIO, :ESTADOP, :ESTADOA, :CANTIDAD)";
//print_r ("DEBUG MODE ON <br />------------<br />titulo = $titulo<br />desc = $descripcion<br />precio = $precio<br />cantidad = $cantidad<br />estadoP = $estadoP<br />categoria = $idCategoria<br />estadoA = $estadoA");
		$result = $conex->prepare($sql);
		$result->execute(array(":IDCATEGORIA" => $idCategoria,
			":TITULO" => $titulo,
			":DESCRIPCION" => $descripcion,
			":IMGDEFAULT" => $imgdefault,
			":PRECIO" => $precio,
			":ESTADOP" => $estadoP,
			":ESTADOA" => $estadoA,
			":CANTIDAD" => $cantidad));
		if($result){
			return(true);
		}else{
			return(false);
		}
		//$temp = $result->fetch(PDO::FETCH_ASSOC);
		//Para saber si ocurrió un error
		//return $temp;
	}
	public function agregarcrea($obj, $conex)
	{
		$idpublicacion = $obj->getId();
		$idusuario = $obj->getIdUsuario();

		$sql = "INSERT INTO CREA (IDUSUARIO, IDPUBLICACION) VALUES (:IDUSUARIO, :IDPUBLICACION)";
//print_r ("DEBUG MODE ON <br />------------<br />titulo = $titulo<br />desc = $descripcion<br />precio = $precio<br />cantidad = $cantidad<br />estadoP = $estadoP<br />categoria = $idCategoria<br />estadoA = $estadoA");
		$result = $conex->prepare($sql);
		$result->execute(array(":IDUSUARIO" => $idusuario,
			":IDPUBLICACION" => $idpublicacion));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function consMaxID($conex)
	{
		$sql = "SELECT MAX(ID) FROM PUBLICACION";

		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consTodos( $conex)
	{

		$sql = "SELECT * FROM VWPUBLICACION";

		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consPublicados( $conex)
	{

		$sql = "SELECT * FROM VWPUBLICACION WHERE ESTADOP='PUBLICADA'";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();

		return $resultados;
	}
	public function consPublicadosFiltro($obj, $conex)
	{
		$titulo = $obj->getTitulo();
		$titulo = "%" . $titulo . "%";
		$sql = "SELECT * FROM VWPUBLICACION WHERE ESTADOP='PUBLICADA' and (TITULO LIKE :TITULO OR DESCRIPCION LIKE :TITULO)";
		$result = $conex->prepare($sql);
		$result->execute(array(":TITULO" => $titulo));
		$resultados=$result->fetchAll();

		return $resultados;
	}
	public function consPublicaciones($obj, $conex)
	{
		$idusuario = $obj->getIdUsuario();
		$sql = "CALL PROPRODUCTOS(:ID)";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $idusuario));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consUno($obj, $conex)
	{
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_PUBLICACIONES WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consFecha($obj, $conex)
	{
		$id= trim($obj->getId());
		$sql = "SELECT * FROM CREA WHERE IDPUBLICACION=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consTodasActivas($conex){
		$sql = "SELECT DATOS_PUBLICACIONES.*,CREA.FECHA FROM 
		CREA,DATOS_PUBLICACIONES WHERE CREA.IDPUBLICACION=DATOS_PUBLICACIONES.ID AND CREA.BAJA=0 AND ESTADOP!='BANEADA'";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		return $resultados;
		
	}
	public function consTodasBaneadas($conex){
		$sql = "SELECT DATOS_PUBLICACIONES.*,CREA.FECHA FROM 
		CREA,DATOS_PUBLICACIONES WHERE CREA.IDPUBLICACION=DATOS_PUBLICACIONES.ID AND CREA.BAJA=0 AND ESTADOP='BANEADA'";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consTodosUsuPublicadas($obj, $conex)
	{
		$id= trim($obj->getIdUsuario());
		$sql = "SELECT DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO AS CATEGORIA,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA,DATOS_PUBLICACIONES.ESTADOA FROM CREA,DATOS_PUBLICACIONES,CATEGORIA WHERE CREA.IDPUBLICACION=DATOS_PUBLICACIONES.ID AND CREA.BAJA=0 AND DATOS_PUBLICACIONES.ESTADOP='PUBLICADA' AND CATEGORIA.ID=DATOS_PUBLICACIONES.IDCATEGORIA AND CREA.IDUSUARIO=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consTodosUsuGuardadas($obj, $conex)
	{
		$id= trim($obj->getIdUsuario());
		$sql = "SELECT DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO AS CATEGORIA,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA,DATOS_PUBLICACIONES.ESTADOA FROM CREA,DATOS_PUBLICACIONES,CATEGORIA WHERE CREA.IDPUBLICACION=DATOS_PUBLICACIONES.ID AND CREA.BAJA=0 AND ( DATOS_PUBLICACIONES.ESTADOP='BORRADOR' OR DATOS_PUBLICACIONES.ESTADOP='BANEADA' ) AND CATEGORIA.ID=DATOS_PUBLICACIONES.IDCATEGORIA AND CREA.IDUSUARIO=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario
//(ESTADOP='PUBLICADA' AND ESTADOP='BORRADOR' AND ESTADOP='CANCELADA' AND ESTADOP='BANEADA'),
		return $resultados;
	}
	public function consTodosUsuCerradas($obj, $conex)
	{
		$id= trim($obj->getIdUsuario());
		$sql = "SELECT DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO AS CATEGORIA,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA,DATOS_PUBLICACIONES.ESTADOA FROM CREA,DATOS_PUBLICACIONES,CATEGORIA WHERE CREA.IDPUBLICACION=DATOS_PUBLICACIONES.ID AND CREA.BAJA=0 AND DATOS_PUBLICACIONES.ESTADOP='CANCELADA' AND CATEGORIA.ID=DATOS_PUBLICACIONES.IDCATEGORIA AND CREA.IDUSUARIO=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}

	public function modificar($obj, $conex){

		$id= trim($obj->getId());
		$titulo=$obj->getTitulo();
		$desc=$obj->getDescripcion();
		$precio = $obj->getPrecio();
		$cantidad = $obj->getCantidad();
		$categoria = $obj->getIdCategoria();
		$tipo = $obj->getEstadoA();
		$estado = $obj->getEstadoP();

		/*
		echo "DEBUG MODE ON <br />------------<br />id=$id<br />titulo = $titulo<br />desc = $desc<br />precio = $precio<br />cantidad = $cantidad<br />categoria = $categoria<br />img = $img<br />";
		exit();*/

		
		$sql = "UPDATE PUBLICACION SET TITULO=:TITULO ,DESCRIPCION=:DESCRIPCION, PRECIO=:PRECIO, CANTIDAD=:CANTIDAD, IDCATEGORIA=:IDCATEGORIA, ESTADOP=:ESTADOP, ESTADOA=:ESTADOA WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":TITULO" => $titulo,
			":DESCRIPCION" => $desc,
			":PRECIO" => $precio,
			":CANTIDAD" => $cantidad,
			":IDCATEGORIA" => $categoria,
			":ESTADOA" => $tipo,
			":ESTADOP" => $estado,
			":ID" => $id));
		
		

		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function modificarCantidad($obj, $conex)
	{
		$id= trim($obj->getId());
		$cantidad = $obj->getCantidad();

		$sql = "UPDATE PUBLICACION SET CANTIDAD=:CANTIDAD WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":CANTIDAD" => $cantidad,":ID" => $id));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function modificarCerrar($obj, $conex)
	{
		$id= trim($obj->getId());
		$sql = "UPDATE PUBLICACION SET CANTIDAD='0', ESTADOP='CANCELADA' WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function eliminar($obj, $conex)
	{
		$id= trim($obj->getId());
		$baja= trim($obj->getBaja());
		$sql = "UPDATE PUBLICACION SET BAJA=:BAJA WHERE ID=:ID";

		$result = $conex->prepare($sql);

		$result->execute(array(":ID"=>$id,
								":BAJA"=>$baja));

		return $result;
	}
	public function consCategorias($obj, $conex)
	{
		$idcategoria = $obj->getIdCategoria();
		$sql = "SELECT * FROM VWPUBLICACION WHERE IDCATEGORIA=:IDCATEGORIA AND ESTADOP='PUBLICADA'";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDCATEGORIA" => $idcategoria));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function modVisto($obj, $conex)
	{
		$id= trim($obj->getId());
		$visto = $obj->getVisto();

		$sql = "UPDATE PUBLICACION SET VISTO=:VISTO WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":VISTO" => $visto,":ID" => $id));
		if($result){
			return(true);
		}else{
			return(false);
		}
	}
	public function consVisto($obj, $conex)
	{
		$id= trim($obj->getId());
		$sql = "SELECT VISTO FROM PUBLICACION WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consPubliIndex( $conex)
	{

		$sql = "SELECT * FROM DATOS_PRODUCTO_INDEX LIMIT 12";

		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consPubliOfertas( $conex)
	{

		$sql = "SELECT * FROM DATOS_PRODUCTO_OFERTA";

		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consPubliBusc($obj, $conex)
	{
		$sql= trim($obj->getTitulo());
	/*	$sql = "SELECT PUBLICACION.* FROM PUBLICACION WHERE TITULO LIKE CONCAT('%',:TITULO,'%') 
				UNION ALL
				SELECT P.* FROM PUBLICACION P, CATEGORIA C WHERE C.ID = P.IDCATEGORIA
				AND (C.TITULO LIKE CONCAT('%',:TITULO,'%') )
		";
	*/	$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consPubliBuscCat($obj, $conex)
	{
		$id= trim($obj->getIdCategoria());
		$sql = "SELECT * FROM DATOS_BUSQUEDA_CATEGORIA WHERE CATID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consPubliVend($obj, $conex)
	{
		$id= trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_PRODUCTO_INDEX WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consPubliUsadas($obj, $conex)
	{
		$id= trim($obj->getIdUsuario());
		$sql = "SELECT DATOS_PRODUCTO_INDEX.* FROM DATOS_PUBLICACIONES,DATOS_PRODUCTO_INDEX WHERE DATOS_PUBLICACIONES.ID=DATOS_PRODUCTO_INDEX.ID AND DATOS_PUBLICACIONES.ESTADOA='USADO' AND DATOS_PRODUCTO_INDEX.USUARIO=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
}
?>