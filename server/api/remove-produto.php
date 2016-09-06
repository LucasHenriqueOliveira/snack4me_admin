<?php
header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token, x-access-token, x-key');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$resposta = array();

try{

  $_POST = json_decode(file_get_contents('php://input'), true);

  $id = $_POST['id'];

	include_once('../conexao.php');

	$query = $con->prepare("UPDATE product SET product_active = 0 WHERE product_id = ?");
	$query->execute(array($id));

	$resposta["error"] = false;
  $resposta["message"] = 'Produto desativado com sucesso.';

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);