<?php

class Despesa {
	private $id;
	private $id_tipo;
	private $id_user;
	private $despesa;
	private $data_despesa;
	private $valor;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>