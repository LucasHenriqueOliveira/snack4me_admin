<?php

$resposta = array();
$isApp = false;

try{

	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_MAGIC_QUOTES);

	if(isset($_POST['uuid'])){
		$uuid = filter_var($_POST['uuid'], FILTER_SANITIZE_MAGIC_QUOTES);
		$token = base64_encode($uuid);
		$isApp = true;
	} else{
		$token = hash('sha256', uniqid(mt_rand() . $_SERVER['HTTP_USER_AGENT'], true));
		$isApp = false;
	}

	include_once('conexao.php');
	include('class/Customer.php');

	$query = $con->prepare("SELECT `customer_id`, `customer_email`, `customer_name`, `customer_type` FROM `customer` WHERE `customer_email` = ? AND `customer_password` = SHA1(?) LIMIT 1");
	$query->execute(array($email,$password));
	$query->setFetchMode(PDO::FETCH_CLASS, 'Customer');
	$num_rows = $query->rowCount();
	$row = $query->fetch();

	if($num_rows > 0){

		if(!$isApp){
			session_start();

			$_SESSION['id'] = $row->getCustomerId();
			$_SESSION['email'] = $row->getCustomerEmail();
			$_SESSION['name'] = $row->getCustomerName();
			$_SESSION['type'] = $row->getCustomerType();
			$_SESSION['XSRF'] = $token;
		} else{
			$query = $con->prepare("UPDATE `customer` SET `customer_token` = ?, `customer_device_id` = ? WHERE `customer_id` = ?");
			$query->execute(array($token, $uuid, $row->getCustomerId()));
		}

		$user['id'] = $row->getCustomerId();
		$user['email'] = $row->getCustomerEmail();
		$user['name'] = $row->getCustomerName();
		$user['type'] = $row->getCustomerType();
		$user['XSRF'] = $token;

		$resposta["error"] = false;
		$resposta["response"] = $user;

	} else{

		$resposta["error"] = true;
		$message["en"] = "User not found.";
		$message["pt"] = "Usuário não encontrado.";
		$resposta["message"] = $message;
	}

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);