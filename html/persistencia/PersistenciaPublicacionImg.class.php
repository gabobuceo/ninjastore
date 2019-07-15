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
		if ($id=="") {
			$sql = "SELECT IMAGENES FROM PUBLICACIONIMG";
			$result = $conex->prepare($sql);
			$result->execute();
			$resultados=$result->fetchAll();
			return $resultados;
		}else{
			$sql = "SELECT IMAGENES FROM PUBLICACIONIMG WHERE ID=:id";
			$result = $conex->prepare($sql);
			$result->execute(array(":id" => $id));
			$resultados=$result->fetchAll();
			return $resultados;
		}
	}
}