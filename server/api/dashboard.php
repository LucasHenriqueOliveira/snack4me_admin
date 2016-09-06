<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token, x-access-token, x-key');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


$resposta = array();

try{

  $_POST = json_decode(file_get_contents('php://input'), true);

	$event = $_POST['company'];

	include_once('../conexao.php');

	$query = $con->prepare("SELECT count(*) as qtd_usuarios
	      FROM `user` AS u
			  WHERE u.`user_active` = 1 AND u.`user_profile_id` = 2");
	$query->execute();
	$row = $query->fetch();

	$dados['qtd_usuarios'] = $row['qtd_usuarios'];

	$query = $con->prepare("SELECT count(*) as qtd_produtos
  	      FROM `product` AS p
  			  WHERE p.`product_event_id` = ? AND p.`product_active` = 1");
  $query->execute(array($event));
  $row = $query->fetch();

  $dados['qtd_produtos'] = $row['qtd_produtos'];

  $query = $con->prepare("SELECT sum(order_price) as qtd_resultado
    	      FROM `order` AS o
    			  WHERE o.`order_event_id` = ? AND o.`order_date` <= LAST_DAY(CURDATE())
    			  AND o.`order_date` >= DATE_SUB(LAST_DAY(NOW()), INTERVAL DAY(LAST_DAY(NOW()))-1 DAY)");
    $query->execute(array($event));
    $row = $query->fetch();

    $dados['qtd_resultado'] = $row['qtd_resultado'];

	$resposta["error"] = false;
  $resposta["response"] = $dados;

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);