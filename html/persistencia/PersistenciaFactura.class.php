<?php

/*
	CREATE TABLE FACTURA(
	ID 				SERIAL 			NOT NULL,
	IDCOMPRA		BIGINT(20)		UNSIGNED NOT NULL,
	IDUSUARIO		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION		BIGINT(20)		UNSIGNED NOT NULL,
	FECHAC 			DATETIME 		NOT NULL,
	FECHAV 			DATETIME 		NOT NULL,
	ESTADO 			VARCHAR(15) 	NOT NULL,
	SUBTOTAL 		DOUBLE(10,2) 	NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDCOMPRA,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDCOMPRA) REFERENCES COMPRA(ID),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(ESTADO='PENDIENTE' AND ESTADO='PAGA' AND ESTADO='VENCIDA')
);

private $id;
	private $idCompra;
	private $idUsuario;
	private $idPublicacion;
	private $fechac;
	private $fechav;
	private $estado;
	private $subtotal;
	private $baja;
*/

class PersistenciaFactura{
	public function agregar($obj, $conex){
		$idcompra=trim($obj->getIdCompra());
		$idusuario=trim($obj->getIdUsuario());
		$idpublicacion=trim($obj->getIdPublicacion());
		$subtotal=trim($obj->getSubtotal());
		$sql = "INSERT INTO FACTURA (IDCOMPRA, IDUSUARIO, IDPUBLICACION, FECHAV, SUBTOTAL) VALUES (:IDCOMPRA, :IDUSUARIO, :IDPUBLICACION, (SELECT DATE_ADD(NOW(), INTERVAL +30 DAY)), :SUBTOTAL)";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDCOMPRA" => $idcompra,
							":IDUSUARIO" => $idusuario,
							":IDPUBLICACION" => $idpublicacion,
							":SUBTOTAL" => $subtotal));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}
	
	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM FACTURA WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
}

?>