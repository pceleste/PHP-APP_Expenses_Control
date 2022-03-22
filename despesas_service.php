<?php

require_once "validador_acesso.php";

//CRUD
class DespesasService{

	private $conexao;
	private $despesa;

	public function __construct(Conexao $conexao,Despesa $despesa){
		$this->conexao = $conexao->conectar();
		$this->despesa = $despesa;
	}

	public function inserir(){
		$query = 'insert into tb_despesas(despesa, id_tipo, id_user, valor, data_despesa)values(:despesa, :id_tipo, :id_user, :valor, :data_despesa)';
		$stmt = $this->conexao->prepare($query); // EVITAR SQL INJECTION
		//LIGAR :TAREFA COM A TAREFA EM QUESTÃO COM BINDVALUE
		$stmt->bindValue(':despesa', $this->despesa->__get('despesa'));
		$stmt->bindValue(':id_tipo', $this->despesa->__get('id_tipo'));
		$stmt->bindValue(':id_user', $this->despesa->__get('id_user'));
		$stmt->bindValue(':valor', $this->despesa->__get('valor'));
		$stmt->bindValue(':data_despesa', $this->despesa->__get('data_despesa'));
		$stmt->execute(); // executar query completa

	}

	public function recuperar(){
		$query = '
			select
				date_format(data_despesa, "%Y-%m-%d") as data, s.tipo, despesa, valor, t.id
			from
				tb_despesas as t
				left join tb_tipo as s on (t.id_tipo = s.id)
			where
				id_user = :id_user
			order by data desc
			';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_user', $this->despesa->__get('id_user'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ
	}

	public function pesquisar($ano, $mes, $dia){

		if($ano == '' && $mes == '' && $dia == '' && $this->despesa->__get('valor') == '' && $this->despesa->__get('id_tipo') == '' && $this->despesa->__get('despesa') == ''){
			header('Location: consulta.php');
		}

		if($this->despesa->__get('despesa') != ''){
			$query = '
				select
					date_format(data_despesa, "%Y-%m-%d") as data, s.tipo, despesa, valor, t.id
				from
					tb_despesas as t
					left join tb_tipo as s on (t.id_tipo = s.id)
				where id_user = :id_user AND (valor = :valor OR s.tipo = :tipo OR despesa LIKE "%":despesa"%" OR YEAR(data_despesa) = :ano OR MONTH(data_despesa) = :mes OR DAY(data_despesa) = :dia)
				order by data desc
				';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':valor', $this->despesa->__get('valor'));
			$stmt->bindValue(':tipo', $this->despesa->__get('id_tipo'));
			$stmt->bindValue(':id_user', $this->despesa->__get('id_user'));
			$stmt->bindValue(':despesa', $this->despesa->__get('despesa'));
			$stmt->bindValue(':ano', $ano);
			$stmt->bindValue(':mes', $mes);
			$stmt->bindValue(':dia', $dia);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ

		} else{
			//PARA EVITAR O ERRO DE TIPO LAZER!!!!!!!
			if($this->despesa->__get('id_tipo') == 'Lazer'){
				$query = '
				select
					date_format(data_despesa, "%Y-%m-%d") as data, s.tipo, despesa, valor, t.id
				from
					tb_despesas as t
					left join tb_tipo as s on (t.id_tipo = s.id)
				where id_user = :id_user AND (valor = :valor OR s.tipo LIKE "%":tipo OR despesa = :despesa OR YEAR(data_despesa) = :ano OR MONTH(data_despesa) = :mes OR DAY(data_despesa) = :dia)
				order by data desc
				';
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':valor', $this->despesa->__get('valor'));
				$stmt->bindValue(':tipo', $this->despesa->__get('id_tipo'));
				$stmt->bindValue(':id_user', $this->despesa->__get('id_user'));
				$stmt->bindValue(':despesa', $this->despesa->__get('despesa'));
				$stmt->bindValue(':ano', $ano);
				$stmt->bindValue(':mes', $mes);
				$stmt->bindValue(':dia', $dia);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ
			
			} else{
				$query = '
				select
					date_format(data_despesa, "%Y-%m-%d") as data, s.tipo, despesa, valor, t.id
				from
					tb_despesas as t
					left join tb_tipo as s on (t.id_tipo = s.id)
				where id_user = :id_user AND (valor = :valor OR s.tipo = :tipo OR despesa = :despesa OR YEAR(data_despesa) = :ano OR MONTH(data_despesa) = :mes OR DAY(data_despesa) = :dia)
				order by data desc
				';
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':valor', $this->despesa->__get('valor'));
				$stmt->bindValue(':tipo', $this->despesa->__get('id_tipo'));
				$stmt->bindValue(':id_user', $this->despesa->__get('id_user'));
				$stmt->bindValue(':despesa', $this->despesa->__get('despesa'));
				$stmt->bindValue(':ano', $ano);
				$stmt->bindValue(':mes', $mes);
				$stmt->bindValue(':dia', $dia);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ
			}
		}
	}



	public function atualizar($campo){

		$query = "update tb_despesas set ". $campo . " = :valor where id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':valor', $this->despesa->__get($campo));
		$stmt->bindValue(':id', $this->despesa->__get('id'));
		return $stmt->execute();
	}

	public function remover(){

		$query = 'delete from tb_despesas where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->despesa->__get('id'));
		return $stmt->execute();
	}


}

?>