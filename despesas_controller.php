<?php
	
	require "despesas_model.php";
	require "despesas_service.php";
	require "conexao.php";

	session_start();

	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir' ) {
		if($_POST['despesa'] == '' || $_POST['tipo'] == '' || $_POST['data'] == '' || $_POST['valor'] == ''){
			header('Location: home.php?inclusao=2');
		}
		else {

			$despesa = new Despesa();
			$despesa->__set('despesa', $_POST['despesa']);
			$despesa->__set('id_tipo', $_POST['tipo']);
			$despesa->__set('id_user', $_SESSION['id']);
			$despesa->__set('data_despesa', $_POST['data']);
			$despesa->__set('valor', $_POST['valor']);

			$conexao = new Conexao();

			$despesasService = new DespesasService($conexao, $despesa);
			$despesasService->inserir();

			header('Location: home.php?inclusao=1');
		}
	
	} else if($acao == 'recuperar') {

		$despesa = new Despesa();
		$despesa->__set('id_user', $_SESSION['id']);

		$conexao = new Conexao();
		
		$despesasService = new DespesasService($conexao, $despesa);
		$despesas = $despesasService->recuperar();

	
	} else if($acao == 'pesquisar') {

		$tipoDespesa = $_POST['tipo'];
		switch($tipoDespesa){
			case 1:
				$tipoDespesa = 'Alimentacao';
				break;
			case 2:
				$tipoDespesa = 'Educacao';
				break;
			case 3:
				$tipoDespesa = 'Lazer';
				break;
			case 4:
				$tipoDespesa = 'Transporte';
				break;
			case 5:
				$tipoDespesa = 'Saude';
				break;
			case 6:
				$tipoDespesa = 'Outros';
				break;
		}

		$dataAno = strval($_POST['ano']);
		$dataMes = strval($_POST['mes']);
		$dataDia = strval($_POST['dia']);
		$dataFormat = $dataAno . '-' . $dataMes . '-' . $dataDia;

		$despesa = new Despesa();
		$despesa->__set('despesa', $_POST['descricao']);
		$despesa->__set('id_tipo', $tipoDespesa);
		$despesa->__set('id_user', $_SESSION['id']);
		$despesa->__set('data_despesa', $dataFormat);
		$despesa->__set('valor', $_POST['valor']);

		$conexao = new Conexao();

		$despesasService = new DespesasService($conexao, $despesa);
		$despesas = $despesasService->pesquisar($dataAno, $dataMes, $dataDia);

	} else if($acao == 'atualizar') {
		//ALTERAR TIPO DESPESA PARA RESPETIVO ID
		if($_POST['campobd'] == 'id_tipo'){
			
			switch($_POST['valor']){
				case 'Alimentacao':
					$_POST['valor'] = 1;
					break;
				case 'Alimentaçao':
					$_POST['valor'] = 1;
					break;
				case 'Alimentação':
					$_POST['valor'] = 1;
					break;
				case 'alimentacao':
					$_POST['valor'] = 1;
					break;
				case 'alimentaçao':
					$_POST['valor'] = 1;
					break;
				case 'alimentação':
					$_POST['valor'] = 1;
					break;

				case 'Educacao':
					$_POST['valor'] = 2;
					break;
				case 'Educaçao':
					$_POST['valor'] = 2;
					break;
				case 'Educação':
					$_POST['valor'] = 2;
					break;
				case 'educacao':
					$_POST['valor'] = 2;
					break;
				case 'educaçao':
					$_POST['valor'] = 2;
					break;
				case 'Educação':
					$_POST['valor'] = 2;
					break;

				case 'Lazer':
					$_POST['valor'] = 3;
					break;
				case 'lazer':
					$_POST['valor'] = 3;
					break;

				case 'Transporte':
					$_POST['valor'] = 4;
					break;
				case 'transporte':
					$_POST['valor'] = 4;
					break;

				case 'Saude':
					$_POST['valor'] = 5;
					break;
				case 'Saúde':
					$_POST['valor'] = 5;
					break;
				case 'saude':
					$_POST['valor'] = 5;
					break;
				case 'saúde':
					$_POST['valor'] = 5;
					break;

				case 'Outros':
					$_POST['valor'] = 6;
					break;
				case 'outros':
					$_POST['valor'] = 6;
					break;
			}
		}

		$despesa = new Despesa();
		$despesa->__set('id', $_POST['id']);
		$despesa->__set($_POST['campobd'], $_POST['valor']);

		$conexao = new Conexao();

		$despesasService = new DespesasService($conexao, $despesa);
		$despesasService->atualizar($_POST['campobd']);

		header('Location: consulta.php');

	} else if($acao == 'remover') {

		$despesa = new Despesa();
		$despesa->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$despesasService = new DespesasService($conexao, $despesa);
		$despesasService->remover();

		header('Location: consulta.php');
	
	}

?>