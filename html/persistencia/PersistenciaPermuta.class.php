<?php

/*
CREATE TABLE PERMUTA(
	ID 						SERIAL			NOT NULL,
	IDPUBLICACIONORIGEN 	BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACIONDESTINO 	BIGINT(20)		UNSIGNED NOT NULL,
	ESTADO 					VARCHAR(15) 	DEFAULT 'ACTIVA',
	FECHAP 					TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	ACEPTADA 				BOOLEAN			DEFAULT 0,
	FECHAC 					DATETIME,
	BAJA					BOOLEAN			DEFAULT 0,
	PRIMARY KEY				(ID,IDPUBLICACIONORIGEN,IDPUBLICACIONDESTINO),
	FOREIGN KEY				(IDPUBLICACIONORIGEN) REFERENCES PUBLICACION(ID),
	FOREIGN KEY				(IDPUBLICACIONDESTINO) REFERENCES PUBLICACION(ID),
	CHECK					(ESTADO='ACTIVA' AND ESTADO='CERRADA')
);


CREATE VIEW DATOS_PERMUTAS AS
SELECT PERMUTA.*,UORIGEN.ID AS IDORIGEN,UORIGEN.USUARIO AS USUARIOORIGEN,PORIGEN.TITULO AS TITULOORIGEN,PORIGEN.DESCRIPCION AS DESCRIPCIONORIGEN,PORIGEN.PRECIO AS PRECIOORIGEN,UDESTINO.ID AS IDDESTINO,UDESTINO.USUARIO AS USUARIODESTINO,PDESTINO.TITULO AS TITULODESTINO,PDESTINO.DESCRIPCION AS DESCRIPCIONDESTINO,PDESTINO.PRECIO AS PRECIODESTINO FROM
PERMUTA, PUBLICACION PORIGEN, PUBLICACION PDESTINO,CREA CORIGEN, CREA CDESTINO, USUARIO UORIGEN, USUARIO UDESTINO
WHERE
PERMUTA.IDPUBLICACIONORIGEN=PORIGEN.ID AND
PERMUTA.IDPUBLICACIONDESTINO=PDESTINO.ID AND
PORIGEN.ID=CORIGEN.IDPUBLICACION AND
PDESTINO.ID=CDESTINO.IDPUBLICACION AND
CORIGEN.IDUSUARIO = UORIGEN.ID AND
CDESTINO.IDUSUARIO= UDESTINO.ID

	private $id;
	private $idPublicacionOrigen;
	private $idPublicacionDestino;
	private $estado;
	private $fechap;
	private $aceptada;
	private $fechac;
	private $baja;

*/
class PersistenciaPermuta{
	public function agregar($obj, $conex){
		$idpublicacionorigen=trim($obj->getIdPublicacionOrigen());
		$idpublicaciondestino=trim($obj->getIdPublicacionDestino());
		$sql = "INSERT INTO PERMUTA (IDPUBLICACIONORIGEN, IDPUBLICACIONDESTINO) VALUES (:IDPUBLICACIONORIGEN, :IDPUBLICACIONDESTINO)";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDPUBLICACIONORIGEN" => $idpublicacionorigen,
							":IDPUBLICACIONDESTINO" => $idpublicaciondestino));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}
	public function acept($obj, $conex){
		$id=trim($obj->getId());
		$sql = "UPDATE PERMUTA SET ACEPTADA='1', ESTADO='CERRADA' WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}
	public function cancel($obj, $conex){
		$id=trim($obj->getId());
		$sql = "UPDATE PERMUTA SET ACEPTADA='0', ESTADO='CERRADA' WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}
	
	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_PERMUTAS WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consTodos($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_PERMUTAS WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consAbiertasOrigen($obj, $conex){
		$idusuario= trim($obj->getIdPublicacionOrigen());
		$sql = "SELECT * FROM DATOS_PERMUTAS WHERE IDORIGEN=:ID AND ESTADO='ACTIVA'";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $idusuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consCerradasOrigen($obj, $conex){
		$idusuario= trim($obj->getIdPublicacionOrigen());
		$sql = "SELECT * FROM DATOS_PERMUTAS WHERE IDORIGEN=:ID AND ESTADO='CERRADA'";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $idusuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consAbiertasDestino($obj, $conex){
		$idusuario= trim($obj->getIdPublicacionOrigen());
		$sql = "SELECT * FROM DATOS_PERMUTAS WHERE IDDESTINO=:ID AND ESTADO='ACTIVA'";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $idusuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consCerradasDestino($obj, $conex){
		$idusuario= trim($obj->getIdPublicacionOrigen());
		$sql = "SELECT * FROM DATOS_PERMUTAS WHERE IDDESTINO=:ID AND ESTADO='CERRADA'";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $idusuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consMaxID($conex){
		$sql = "SELECT MAX(ID) FROM DATOS_PERMUTAS";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		return $resultados;
	}


}

?>