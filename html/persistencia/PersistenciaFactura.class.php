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
			$id=trim($obj->getId());
			$idcompra=trim($obj->getIdCompra());
			$idusuario=trim($obj->getIdUsuario());
			$idpublicacion=trim($obj->getIdPublicacion());
			$subtotal=trim($obj->getSubtotal());
			$vence=trim($obj->getFechav());
			echo "<hr>";
			var_dump($id);
			echo "<hr>";
			var_dump($idcompra);
			echo "<hr>";
			var_dump($idusuario);
			echo "<hr>";
			var_dump($idpublicacion);
			echo "<hr>";

			if (empty($id)) {
				echo "Vacio";
				$sql = "INSERT INTO FACTURA (IDCOMPRA, IDUSUARIO, IDPUBLICACION, FECHAV, SUBTOTAL) VALUES (:IDCOMPRA, :IDUSUARIO, :IDPUBLICACION, :FECHAV, :SUBTOTAL)";
				$result = $conex->prepare($sql);
				$result->execute(array(":IDCOMPRA" => $idcompra,
					":IDUSUARIO" => $idusuario,
					":IDPUBLICACION" => $idpublicacion,
					":FECHAV" => $vence,
					":SUBTOTAL" => $subtotal));
			}else{
				echo "con algo $id";
				$sql = "INSERT INTO FACTURA (ID, IDCOMPRA, IDUSUARIO, IDPUBLICACION, FECHAV, SUBTOTAL) VALUES (:ID,:IDCOMPRA, :IDUSUARIO, :IDPUBLICACION, :FECHAV, :SUBTOTAL)";
				$result = $conex->prepare($sql);
				$result->execute(array(":ID" => $id,
					":IDCOMPRA" => $idcompra,
					":IDUSUARIO" => $idusuario,
					":IDPUBLICACION" => $idpublicacion,
					":FECHAV" => $vence,
					":SUBTOTAL" => $subtotal));
			}
			if($result){
				return(true);
			}else{
				return(false);
			}
		}

		public function consUno($obj, $conex){
			$id= trim($obj->getId());
			$sql = "SELECT DATOS_COMPRAS.*,FACTURA.ID AS IDFACTURA,FACTURA.FECHAC,FACTURA.FECHAV,FACTURA.FECHAP,FACTURA.ESTADO,FACTURA.SUBTOTAL FROM FACTURA,DATOS_COMPRAS WHERE FACTURA.ID=:ID AND FACTURA.IDCOMPRA=DATOS_COMPRAS.ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":ID" => $id));
			$resultados=$result->fetchAll();
			return $resultados;
		}
		public function consTodos($obj, $conex){
			$idusuario= trim($obj->getIdUsuario());
			$sql = "SELECT FACTURA.*,PUBLICACION.TITULO FROM FACTURA, PUBLICACION WHERE IDUSUARIO=:IDUSUARIO AND FACTURA.IDPUBLICACION = PUBLICACION.ID GROUP BY FACTURA.ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":IDUSUARIO" => $idusuario));
			$resultados=$result->fetchAll();
			return $resultados;
		}
		public function consPendientes($obj, $conex){
			$idusuario= trim($obj->getIdUsuario());
			$sql = "SELECT FACTURA.*,PUBLICACION.TITULO FROM FACTURA, PUBLICACION WHERE ESTADO='PENDIENTE' AND IDUSUARIO=:IDUSUARIO AND FACTURA.IDPUBLICACION = PUBLICACION.ID GROUP BY FACTURA.ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":IDUSUARIO" => $idusuario));
			$resultados=$result->fetchAll();
			return $resultados;
		}
		public function consUnoFechas($obj, $conex){
			$id= trim($obj->getIdUsuario());
			$vence= trim($obj->getFechac());
			$vencefin= trim($obj->getFechav());
			$sql = "SELECT ID FROM FACTURA WHERE FECHAV >= :FECHAVO AND FECHAV <= :FECHAVD AND ESTADO='PENDIENTE'AND IDUSUARIO=:ID";
			$result = $conex->prepare($sql);
			$result->execute(array(":FECHAVO" => $vence,
				":FECHAVD" => $vencefin,
				":ID" => $id));
			$resultados=$result->fetchAll();
			return $resultados;
		}
	}

	?>