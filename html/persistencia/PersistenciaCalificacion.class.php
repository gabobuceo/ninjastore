<?php

/*
CREATE TABLE CALIFICACION(
	ID 				SERIAL 		NOT NULL,
	IDCOMPRA		BIGINT(20)	UNSIGNED NOT NULL,
	IDUSUARIO		BIGINT(20)	UNSIGNED NOT NULL,
	IDPUBLICACION	BIGINT(20)	UNSIGNED NOT NULL,
	FECHA 			TIMESTAMP 	NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CALIFICACION 	INT 		NOT NULL,
	MENSAJE 		TEXT 		NOT NULL,
	BAJA			BOOLEAN		DEFAULT 0,
	PRIMARY KEY		(ID,IDCOMPRA,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDCOMPRA) REFERENCES COMPRA(ID),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(CALIFICACION='1' AND CALIFICACION='2' AND CALIFICACION='3' AND CALIFICACION='4' AND CALIFICACION='5')
);


	private $id;
	private $idCompra;
	private $idUsuario;
	private $idPublicacion;
	private $fecha;
	private $calificacion;
	private $mensaje;
	private $baja;
*/

class PersistenciaCalificacion{
	public function agregar($obj, $conex){
		$idCompra=trim($obj->getIdCompra());
		$idUsuario=trim($obj->getIdUsuario());
		/*$idPublicacion=trim($obj->getIdPublicacion());
		$fecha=trim($obj->getFecha());*/
		$calificacion=trim($obj->getCalificacion());
		$mensaje=trim($obj->getMensaje());
		$sql = "INSERT INTO CALIFICACION (IDCOMPRA, IDUSUARIO, IDPUBLICACION, FECHA, CALIFICACION,MENSAJE) VALUES (:IDCOMPRA, :IDUSUARIO, (SELECT IDPUBLICACION FROM COMPRA WHERE ID=:IDCOMPRA), NOW(), :CALIFICACION,:MENSAJE)";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDCOMPRA" => $idCompra,
							":IDUSUARIO" => $idUsuario,
							":CALIFICACION" => $calificacion,
							":MENSAJE" => $mensaje));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}
	
	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
}

?>