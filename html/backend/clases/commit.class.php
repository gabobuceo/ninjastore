<?php

require_once('../persistencia/PersistenciaCommit.class.php');

class Commit
{
	public function AutoCommitOFF($conex){
		$pc=new PersistenciaCommit;
		return ($pc->AutoCommitOFF($conex));
	}
	public function AutoCommitON($conex){
		$pc=new PersistenciaCommit;
		return ($pc->AutoCommitON($conex));
	}
	public function Commiteo($conex){
		$pc=new PersistenciaCommit;
		return ($pc->Commiteo($conex));
	}
	public function Rollbackeo($conex){
		$pc=new PersistenciaCommit;
		return ($pc->Rollbackeo($conex));
	}
	public function TransactionStart($conex){
		$pc=new PersistenciaCommit;
		return ($pc->TransactionStart($conex));
	}
}
?>