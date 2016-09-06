<?php
header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token, x-access-token, x-key');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


$resposta = array();

try{

  $event = $_GET['company'];

	include_once('../conexao.php');

	$query = $con->prepare("SELECT * FROM `category`");
	$query->execute(array($event));

	while ($row = $query->fetch()) {
	    $categoria['id'] = $row['category_id'];
	    $categoria['name'] = $row['category_name_pt'];
      $categorias[] = $categoria;
  }

	$resposta["error"] = false;
  $resposta["response"] = $categorias;

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);