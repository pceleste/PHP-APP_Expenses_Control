<?php

require_once "validador_acesso.php";

class Conexao{

	private $host = 'sql204.byetcluster.com';
	private $dbname = 'epiz_30592636_webpceldespesas';
	private $user = 'user';
	private $pass = 'pass';

	public function conectar(){
		try{
			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"
			);

			return $conexao;

		} catch(PDOException $e){
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
}
