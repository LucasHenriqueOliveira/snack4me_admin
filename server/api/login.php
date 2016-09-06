<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$resposta = array();

try{

  $_POST = json_decode(file_get_contents('php://input'), true);

	$user = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_MAGIC_QUOTES);
  $token = base64_encode($_POST['email']);

	include_once('../conexao.php');
	include('../class/User.php');

	$query = $con->prepare("SELECT u.`user_id`, u.`user_name`, u.`user_login_default`, p.`profile_name`, p.`profile_id`
	      FROM `user` AS u
			  INNER JOIN profile AS p ON u.user_profile_id = p.profile_id
			  WHERE u.`user_name` = ? AND u.`user_password` = SHA1(?) AND u.`user_active` = 1 LIMIT 1");
	$query->execute(array($user, $password));
	$query->setFetchMode(PDO::FETCH_CLASS, 'User');
	$num_rows = $query->rowCount();
	$row = $query->fetch();

	if ($num_rows > 0){
		// O registro foi encontrado => o usuário é valido

		$userDelivery['id'] = $row->getUserId();
		$userDelivery['email'] = $row->getUserName();
		$userDelivery['profile_id'] = $row->getProfileId();
		$userDelivery['profile_name'] = $row->getProfileName();
		$userDelivery['login_default'] = $row->getUserLoginDefault();
		$userDelivery['token'] = $token;

		$resposta["error"] = false;
		$resposta["response"] = $userDelivery;

	} else {
		// Nenhum registro foi encontrado => o usuário é inválido
		$resposta["error"] = true;
		$resposta["message"] = "Usuário não encontrado.";
	}

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);