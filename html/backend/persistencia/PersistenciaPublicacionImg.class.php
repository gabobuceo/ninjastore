<?php
class PersistenciaPublicacionImg
{
	public function agregar($obj, $conex) {
		$id = $obj->getId();
		$imagen = $obj->getImagen();

		$sql = "INSERT INTO PUBLICACIONIMG (ID,IMAGENES) VALUES 
		(:id, :imagen)";
		$result = $conex->prepare($sql);		
		$result->execute(array(":id" => $id, ":imagen" => $imagen));
		if($result) {
			return(true);
		}else{
			return(false);
		}
	}
	public function eliminar($obj, $conex) {
		$ID = $obj->getId();      		
		$sql = "DELETE FROM PUBLICACIONIMG WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID"=>$ID));
		if($result) {
			return(true);
		}else{
			return(false);
		}
	}
	public function consTodos($obj, $conex){
		$id = $obj->getId();
		$sql = "SELECT * FROM PUBLICACIONIMG WHERE ID=:id";
		$result = $conex->prepare($sql);
		$result->execute(array(":id" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function baneoimg($obj, $conex) {
		$id = $obj->getId();
		$sql = "DELETE FROM PUBLICACIONIMG WHERE ID=:ID";
		$result = $conex->prepare($sql);		
		$result->execute(array(":ID" => $id));
		if($result) {
			$sql = "INSERT INTO PUBLICACIONIMG (ID,IMAGENES) VALUES (:ID,'noimage')";
			$result = $conex->prepare($sql);		
			$result->execute(array(":ID" => $id));
			if($result) {
				return(true);
			}else{
				return(false);
			}
		}else{
			return(false);
		}
	}
}