<?php

class PersistenciaCategoria{

	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT DATOS_CATEGORIAS.*,CATEGORIA.TITULO AS TITULOPADRE FROM DATOS_CATEGORIAS,CATEGORIA WHERE CATEGORIA.ID=DATOS_CATEGORIAS.PADRE AND DATOS_CATEGORIAS.ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}

	public function consActivas($conex)
	{
		$sql = "SELECT DATOS_CATEGORIAS.*,CATEGORIA.TITULO AS TITULOPADRE FROM DATOS_CATEGORIAS,CATEGORIA WHERE CATEGORIA.ID=DATOS_CATEGORIAS.PADRE AND DATOS_CATEGORIAS.BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	public function consInactivas($conex)
	{
		$sql = "SELECT DATOS_CATEGORIAS.*,CATEGORIA.TITULO AS TITULOPADRE FROM DATOS_CATEGORIAS,CATEGORIA WHERE CATEGORIA.ID=DATOS_CATEGORIAS.PADRE AND DATOS_CATEGORIAS.BAJA=1";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	public function consTodos($conex)
	{
		$sql = "SELECT DATOS_CATEGORIAS.*,CATEGORIA.TITULO AS TITULOPADRE FROM DATOS_CATEGORIAS,CATEGORIA WHERE CATEGORIA.ID=DATOS_CATEGORIAS.PADRE";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	//Devuelve las categorias padre
	public function consPadres($conex)
	{
		$sql = "SELECT * FROM DATOS_CATEGORIAS WHERE PADRE=1 AND BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	//Devuelve las catorias padre y activas
	public function consPadresaActivas($conex)
	{
		$sql = "SELECT * FROM DATOS_CATEGORIAS WHERE PADRE=1 AND BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}
	public function consCatHijas($conex)
	{
		$sql = "SELECT * FROM DATOS_CATEGORIAS WHERE PADRE!=1 AND BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}



	public function consHijos($obj, $conex)
	{
		$idpadre= trim($obj->getidpadre());
		//die(var_dump($idpadre));
		$sql = "SELECT * FROM CATEGORIA WHERE PADRE=:PADRE AND BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute(array(":PADRE" => $idpadre));
		$resultados=$result->fetchall();
		return $resultados;
	}
	//Pasando ID de una categoria que devuelva el titulo
	public function consTitulo($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT TITULO FROM DATOS_CATEGORIAS WHERE ID=:ID AND BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}

	public function altaCat($obj, $conex)
	{
			$padre= trim($obj->getIdPadre());
			$titulo= trim($obj->getTitulo());
			$sql = "INSERT CATEGORIA SET TITULO=:TITULO,PADRE=:PADRE";
			$result = $conex->prepare($sql);
			$result->execute(array(":TITULO" => $titulo,
					":PADRE" => $padre));
					//Para saber si ocurrió un error
			if($result)
			{
				return(true);
			}
			else
			{
			return(false);
			}
	}

	public function modificarCat($obj, $conex)
	{
			$id= trim($obj->getId());
			$titulo= trim($obj->getTitulo());
			$sql = "UPDATE CATEGORIA SET TITULO=:TITULO WHERE ID=:ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":TITULO" => $titulo,					
									":ID" => $id));
					//Para saber si ocurrió un error
			if($result)
			{
				return(true);
			}
			else
			{
			return(false);
			}
	}
	public function modificarPad($obj, $conex)
	{
			$id= trim($obj->getId());
			$padre= trim($obj->getIdPadre());
			$sql = "UPDATE CATEGORIA SET PADRE=:PADRE WHERE ID=:ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":PADRE" => $padre,
					":ID" => $id));
					//Para saber si ocurrió un error
			if($result)
			{
				return(true);
			}
			else
			{
			return(false);
			}
	}
	public function bajaCat($obj, $conex)
	{
			$id= trim($obj->getId());
			$baja= trim($obj->getBaja());
			$sql = "UPDATE CATEGORIA SET BAJA=:BAJA, PADRE=1 WHERE ID=:ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":ID" => $id,
									":BAJA" => $baja));
			//Para saber si ocurrió un error
			if($result)
			{
				return(true);
			}
			else
			{
			return(false);
			}
	}
	public function activaCat($obj, $conex)
	{
			$id= trim($obj->getId());
			$sql = "UPDATE CATEGORIA SET BAJA=0 WHERE ID=:ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":ID" => $id));
			//Para saber si ocurrió un error
			if($result)
			{
				return(true);
			}
			else
			{
			return(false);
			}
	}
}
?>
