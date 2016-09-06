<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token, x-access-token, x-key');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


$resposta = array();
$type = array();

try{

  $event = $_GET['company'];

	include_once('../conexao.php');

	$query = $con->prepare("SELECT *
	      FROM `product` AS p
			  WHERE p.`product_active` = 1 AND product_event_id = ? ORDER BY p.`product_number` ASC");
	$query->execute(array($event));

	while ($row = $query->fetch()) {
	    $product = $row;
	    if($product['product_complement'] == 1){

	      $query2 = $con->prepare("SELECT *
        	      FROM `type_product` AS p
        			  WHERE p.`type_product_active` = 1 AND p.type_product_product_id = ?");
        $query2->execute(array($product['product_id']));

        while ($row2 = $query2->fetch()) {
          $type[] = $row2;
        }
        $product['type_product'] = $type;
	    }

      $produtos[] = $product;
  }

	$resposta["error"] = false;
  $resposta["response"] = $produtos;

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);