<?PHP

CLASS PERSISTENCIACATEGORIA
{

	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM CATEGORIA WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}

	public function consActivas($conex)
	{
		$sql = "SELECT * FROM CATEGORIA WHERE BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	public function consInactivas($conex)
	{
		$sql = "SELECT * FROM CATEGORIA WHERE BAJA=1";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	public function consTodos($conex)
	{
		$sql = "SELECT * FROM CATEGORIA";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	//Devuelve las categorias padre
	public function consPadres($conex)
	{
		$sql = "SELECT * FROM CATEGORIA WHERE PADRE=1";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}

	//Devuelve las catorias padre y activas
	public function consPadresaActivas($conex)
	{
		$sql = "SELECT * FROM CATEGORIA WHERE PADRE=1 AND BAJA=0";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchall();
		return $resultados;
	}


	PUBLIC FUNCTION CONSHIJOS($OBJ, $CONEX)
	{
		$ID= TRIM($OBJ->GETIDPADRE());
		//DIE(VAR_DUMP($IDPADRE));
		$SQL = "SELECT * FROM CATEGORIA WHERE PADRE=:ID";
		$RESULT = $CONEX->PREPARE($SQL);
		$RESULT->EXECUTE(ARRAY(":ID" => $ID));
		$RESULTADOS=$RESULT->FETCHALL();
		RETURN $RESULTADOS;
	}
	//Pasando ID de una categoria que devuelva el titulo
	public function consTitulo($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT TITULO FROM CATEGORIA WHERE ID=:ID";
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
			$padre= trim($obj->getIdPadre());
			$titulo= trim($obj->getTitulo());
			$sql = "UPDATE CATEGORIA SET PADRE=:PADRE,TITULO=:TITULO WHERE ID=:ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":PADRE" => $padre,
					":TITULO" => $titulo,					
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
			$sql = "UPDATE CATEGORIA SET BAJA=1 WHERE ID=:ID";
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
