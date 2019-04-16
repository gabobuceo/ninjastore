<?php 
	//$config = include('../config/config.php');
	class CN{
		private $conexion; private $total_consultas;

		public function conectar(){ 
			$config = include('../config/config.php');
			try {
				$conexion = new PDO('mysql:host='.$config->bdhost.';dbname='.$config->bdname, $config->bduser, $config->bdpass);
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return($conexion);
			} catch (PDOException $e) {
				print "<p>Error: No puede conectarse con la base de datos.</p> $e \n";
				exit();
			}
		}
		
		public function consulta($consulta,$cn){ 
			$this->total_consultas++;
			$resultado = $cn->prepare($consulta);
			$resultado->execute();
			return $resultado->fetchAll();
			/*if(!$resultado){ 
				echo "<div class='alert alert-danger' role='alert'><strong>MySQL Error!</strong>" . mysql_error() . "</div>";
				exit;
			}
			return $resultado;*/
		}/*
		public function fetch_array($consulta){
			return mysql_fetch_array($consulta);
		}
		public function num_rows($consulta){
			return mysql_num_rows($consulta);
		}
		public function num_fields($consulta){
			return mysql_num_fields($consulta);
		}
		public function fetch_field($consulta, $data){
			return mysql_fetch_field($consulta, $data);
		}
		public function getTotalConsultas(){
			return $this->total_consultas; 
		}
		*/
	}
?> 