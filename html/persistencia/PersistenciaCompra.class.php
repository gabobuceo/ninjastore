<?php

class PersistenciaCompra
{
	public function agregar($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$idPublicacion=trim($obj->getIdPublicacion());
		$cantidad=trim($obj->getCantidad());
		$total=trim($obj->getTotal());
		$comision=trim($obj->getComision());
		$sql = "INSERT INTO COMPRA (IDUSUARIO, IDPUBLICACION, CANTIDAD, TOTAL, COMISION) VALUES (:IDUSUARIO, :IDPUBLICACION, :CANTIDAD, :TOTAL, :COMISION)";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDUSUARIO" => $idUsuario,
							":IDPUBLICACION" => $idPublicacion,
							":CANTIDAD" => $cantidad,
							":TOTAL" => $total,
							":COMISION" => $comision));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}

	public function consTodos( $conex){

		$sql = "SELECT * FROM VWPUBLICACION";

		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	
	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM VWPUBLICACION WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
	public function consVendidos($obj, $conex){
		$idPublicacion= $obj->getIdPublicacion();
		/*print_r($idPublicacion);*/
		$sql = "SELECT * FROM DATOS_PRODUCTO WHERE ID=:IDPUBLICACION";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDPUBLICACION" => $idPublicacion));
		$resultados=$result->fetchAll();
		//Obtiene el registro de la tabla Usuario

		return $resultados;
	}
}

?>