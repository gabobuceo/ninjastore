<?PHP

CLASS PERSISTENCIACATEGORIA
{

// 	PUBLIC FUNCTION CONSTODOS( $CONEX)
// 	{		 
// 		$SQL = "SELECT * FROM CATEGORIA";
// 		$RESULT = $CONEX->PREPARE($SQL);
// 		$RESULT->EXECUTE();
// 		$RESULTADOS=$RESULT->FETCHALL();
// 		//OBTIENE EL REGISTRO DE LA TABLA USUARIO

// 		RETURN $RESULTADOS;
// 	}
	//SELECT ID FROM CATEGORIA WHERE ID NOT IN ( SELECT IDCATHIJO FROM HIJO )

	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_CATEGORIAS WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consBread($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_CATEGORIAS_PADRE WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}

	PUBLIC FUNCTION CONSTODOS( $CONEX)
	{
		$SQL="SELECT * FROM DATOS_CATEGORIAS";
		$RESULT = $CONEX->PREPARE($SQL);
		$RESULT->EXECUTE();
		$RESULTADOS=$RESULT->FETCHALL();
	
	RETURN $RESULTADOS;
	}
	
	PUBLIC FUNCTION CONSPADRES($CONEX)
	{		
		$SQL = "SELECT * FROM DATOS_CATEGORIAS WHERE PADRE='1'";
		$RESULT = $CONEX->PREPARE($SQL);
		$RESULT->EXECUTE();
		$RESULTADOS=$RESULT->FETCHALL();
		RETURN $RESULTADOS;
	}
		
	PUBLIC FUNCTION CONSHIJOS($OBJ, $CONEX)
	{
		$ID= TRIM($OBJ->GETIDPADRE());			
		//DIE(VAR_DUMP($IDPADRE));
		$SQL = "SELECT * FROM DATOS_CATEGORIAS WHERE PADRE=:ID";
		$RESULT = $CONEX->PREPARE($SQL);
		$RESULT->EXECUTE(ARRAY(":ID" => $ID));
		$RESULTADOS=$RESULT->FETCHALL();
		RETURN $RESULTADOS;
	}
}

?>