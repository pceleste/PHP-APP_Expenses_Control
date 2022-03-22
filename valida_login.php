<?php
	require "users_model.php";
	require "conexao.php";

	session_start();

	$user = new User();
	$user->__set('user', $_POST['user']);
	$user->__set('password', $_POST['password']);

	$conexao = new Conexao();
	$conexao = $conexao->conectar();

	//query para obter username
	$queryUser = "select nome from tb_users where nome = :user";
	$stmt = $conexao->prepare($queryUser); // EVITAR SQL INJECTION
	$stmt->bindValue(':user', $user->__get('user'));
	$stmt->execute();
	$stmt = $stmt->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ

	//query para obter password
	$queryPassword = "select password from tb_users where password = :password";
	$stmtpass = $conexao->prepare($queryPassword); // EVITAR SQL INJECTION
	$stmtpass->bindValue(':password', $user->__get('password'));
	$stmtpass->execute();
	$stmtpass = $stmtpass->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ

	//query para obter o id_user
	$queryId_user = "select id from tb_users where nome = :nome";
	$stmtid = $conexao->prepare($queryId_user); // EVITAR SQL INJECTION
	$stmtid->bindValue(':nome', $stmt[0]->nome);
	$stmtid->execute();
	$stmtid = $stmtid->fetchAll(PDO::FETCH_OBJ); // RETORNAR COMO OBJ

	$user->__set('id', $stmtid[0]->id);

	if($user->__get('user') == '' && $user->__get('password') == ''){
		echo 'LOGIN FAIL';
		$_SESSION['autenticado'] = 'NAO';
		header('Location: index.php?login=erro');
	} else{
		if($stmtpass[0]->password == $user->__get('password') && $stmt[0]->nome == $user->__get('user')){
			echo 'LOGIN SUCESSO';
			$_SESSION['autenticado'] = 'SIM';
			$_SESSION['login'] = 'SIM';
			$_SESSION['user'] = $user->__get('user');
			$_SESSION['id'] = $user->__get('id');
			header('Location: home.php');
		} else{
			echo 'LOGIN FAIL';
			$_SESSION['autenticado'] = 'NAO';
			header('Location: index.php?login=erro');
		}
	}

?>