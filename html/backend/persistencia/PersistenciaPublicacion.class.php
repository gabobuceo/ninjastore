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
		$sql = "SELECT * FROM PUBLICACION WHERE ID=:ID";
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
	public function consTodosUsu($obj, $conex)
	{
		$id= trim($obj->getIdUsuario());
		$estadop= trim($obj->getEstadoP());
		$sql = "SELECT * FROM VWPUBLICACION WHERE IDUSUARIO=:ID AND ESTADOP=:ESTADOP";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id,
								":ESTADOP" => $estadop));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}

	public function modificar($obj, $conex)
	{
		$id= trim($obj->getId());
		$nombre=$obj->getNombre();
		$apellido=$obj->getApellido();
		$categoria = $obj->getCategoria();
		$ci = $obj->getCedula();
		$correo = $obj->getCorreo();
		$celular = $obj->getCelular();
		$horario = $obj->getHorario();
		$fecNac = $obj->getFecNac();

		$sql = "UPDATE USUARIO SET NOMBRE=:NOMBRE,APELLIDO=:APELLIDO ,CATEGORIA=:CATEGORIA, CI=:CI, CORREO=:CORREO, CELULAR=:CELULAR,HORARIO=:HORARIO,FECNAC=:FECNAC WHERE ID=:ID";


		$result = $conex->prepare($sql);

		$result->execute(array(":nombre" => $nombre,":apellido" => $apellido,
			":categoria" => $categoria,":ci" => $ci,
			":correo" => $correo,":celular" => $celular,
			":horario" => $horario,
			":fecnac" => $fecNac,
			":id"=>$id));

		return $result;
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
		$sql = "delete from usuario where id=:id";

		$result = $conex->prepare($sql);

		$result->execute(array(":id"=>$id));

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

		$sql = "SELECT * FROM DATOS_PRODUCTO_INDEX";

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
}

?>