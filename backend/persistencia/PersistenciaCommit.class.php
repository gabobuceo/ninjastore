<?php

class PersistenciaCommit
{
	public function AutoCommitOFF($conex){
		$sql = "SET AUTOCOMMIT=OFF";
		$result = $conex->prepare($sql);
		$result->execute();
		return $result;
	}
	public function AutoCommitON($conex){
		$sql = "SET AUTOCOMMIT=ON";
		$result = $conex->prepare($sql);
		$result->execute();
		return $result;
	}
	public function Commiteo($conex){
		$sql = "COMMIT";
		$result = $conex->prepare($sql);
		$result->execute();
		return $result;
	}
	public function Rollbackeo($conex){
		$sql = "ROLLBACK";
		$result = $conex->prepare($sql);
		$result->execute();
		return $result;
	}
	public function TransactionStart($conex){
		$sql = "START TRANSACTION";
		$result = $conex->prepare($sql);
		$result->execute();
		return $result;
	}
}

?>