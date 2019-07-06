<?php

class PersistenciaCompra{
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
	/*public function consTodos( $conex){
		$sql = "SELECT * FROM VWPUBLICACION";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();

		return $resultados;
	}*/
	public function consUno($obj, $conex){
		$id= trim($obj->getId());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consVendidos($obj, $conex){
		$idPublicacion= $obj->getIdPublicacion();
		$sql = "SELECT * FROM DATOS_PRODUCTO WHERE ID=:IDPUBLICACION";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDPUBLICACION" => $idPublicacion));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consVentas($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE IDVENDEDOR=:IDVENDEDOR";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDVENDEDOR" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consMaxID($conex){
		$sql = "SELECT MAX(ID) FROM COMPRA";
		$result = $conex->prepare($sql);
		$result->execute();
		$resultados=$result->fetchAll();
		return $resultados;
	}

	public function consComprasSinConfirmar($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE COMPRACONCRETA='0' AND IDUSUARIO=:IDUSUARIO ORDER BY ID DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDUSUARIO" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consComprasSinCalificar($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE COMPRACONCRETA='1' AND (IDCALVENDEDOR IS NULL OR IDCALCOMPRADOR IS NULL) AND IDUSUARIO=:IDUSUARIO ORDER BY ID DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDUSUARIO" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consComprasCerradas($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE COMPRACONCRETA='1' AND IDCALVENDEDOR IS NOT NULL AND IDCALCOMPRADOR IS NOT NULL AND IDUSUARIO=:IDUSUARIO ORDER BY ID DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDUSUARIO" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}

	public function confCompra($obj, $conex){
		$id=trim($obj->getId());
		$sql = "UPDATE COMPRA SET COMPRACONCRETA='1', FECHACOMPRACONCRETADO=NOW() WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}

	public function confVenta($obj, $conex){
		$id=trim($obj->getId());
		$sql = "UPDATE COMPRA SET VENTACONCRETA='1', FECHAVENTACONCRETADO=NOW() WHERE ID=:ID";
		$result = $conex->prepare($sql);
		$result->execute(array(":ID" => $id));
		if($result){
          return(true);
        }else{
          return(false);
        }
	}
	public function consVentasSinConfirmar($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE VENTACONCRETA='0' AND IDVENDEDOR=:IDVENDEDOR ORDER BY ID DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDVENDEDOR" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consVentasSinCalificar($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE VENTACONCRETA='1' AND (IDCALVENDEDOR IS NULL OR IDCALCOMPRADOR IS NULL) AND IDVENDEDOR=:IDVENDEDOR ORDER BY ID DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDVENDEDOR" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consVentasCerradas($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE VENTACONCRETA='1' AND IDCALVENDEDOR IS NOT NULL AND IDCALCOMPRADOR IS NOT NULL AND IDVENDEDOR=:IDVENDEDOR ORDER BY ID DESC";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDVENDEDOR" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}
	public function consCompras($obj, $conex){
		$idUsuario=trim($obj->getIdUsuario());
		$sql = "SELECT * FROM DATOS_COMPRAS WHERE IDCOMPRADOR=:IDCOMPRADOR";
		$result = $conex->prepare($sql);
		$result->execute(array(":IDCOMPRADOR" => $idUsuario));
		$resultados=$result->fetchAll();
		return $resultados;
	}


}

?>