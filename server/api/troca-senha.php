<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token, x-access-token, x-key');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$resposta = array();

try{
  $_POST = json_decode(file_get_contents('php://input'), true);

	$id = filter_var($_POST['id'], FILTER_SANITIZE_MAGIC_QUOTES);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_MAGIC_QUOTES);
	$new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_MAGIC_QUOTES);

	include_once('../conexao.php');
	include('../class/User.php');

	$query = $con->prepare('SELECT u.`user_id`, u.`user_name` FROM `user` AS u
			 WHERE u.`user_id` = ? AND u.`user_password` = SHA1(?) AND u.`user_active` = 1 LIMIT 1');
	$query->execute(array($id, $password));
	$query->setFetchMode(PDO::FETCH_CLASS, 'User');
	$num_rows = $query->rowCount();
	$row = $query->fetch();

	if($num_rows > 0){

		date_default_timezone_set('America/Sao_Paulo');
		$date_time = date("Y-m-d H:m:s");

		$sql2 = 'UPDATE `user` SET user_password = SHA1(?), user_login_default = ?, user_dth_update = ? WHERE user_id = ?';
		$query2 = $con->prepare($sql2);
		$query2->execute(array($new_password, 0, $date_time, $row->getUserId()));
		$num_rows2 = $query2->rowCount();

		if($num_rows2 > 0){

			$resposta["error"] = false;
			$resposta["message"] = "Alteração realizada com sucesso.";

		} else{
			$resposta["error"] = true;
			$resposta["message"] = "Erro ao alterar a senha.";
		}

	} else{
		// Nenhum registro foi encontrado => senha atual nao confere
		$resposta["error"] = true;
		$resposta["message"] = "Senha atual não confere.";
	}


} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);