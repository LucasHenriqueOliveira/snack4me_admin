<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Accept, Origin, Content-Type, Cookies, Token, x-access-token, x-key');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


$resposta = array();

try{

  $_POST = json_decode(file_get_contents('php://input'), true);

	$numero = $_POST['numero'];
	$categoria = $_POST['categoria'];
	$hora_fim = $_POST['hora_fim'] . ':00';
	$hora_inicio = $_POST['hora_inicio'] . ':00';
	$price = $_POST['price'];
	$nome_en = $_POST['nome_en'];
	$nome_es = $_POST['nome_es'];
	$nome_pt = $_POST['nome_pt'];
	$desc_en = $_POST['desc_en'];
	$desc_es = $_POST['desc_es'];
	$desc_pt = $_POST['desc_pt'];
	$fast = $_POST['fast'];
	$qtd_complemento = $_POST['qtd_complemento'];
	$event = 1;

	if($qtd_complemento > 0) {
	  $complement = 1;
	} else {
	  $complement = 0;
	}
	if($fast){
	  $fast = 1;
	} else {
	  $fast = 0;
	}

	include_once('../conexao.php');

  try{

    if($numero != ''){

      $con->beginTransaction();

      $sql = "INSERT INTO `product` (`product_number`,
                                  `product_name_pt`,
                                  `product_name_en`,
                                  `product_name_es`,
                                  `product_desc_pt`,
                                  `product_desc_en`,
                                  `product_desc_es`,
                                  `product_price`,
                                  `product_hour_initial`,
                                  `product_hour_final`,
                                  `product_category_id`,
                                  `product_event_id`,
                                  `product_inventory_qtd`,
                                  `product_inventory_current`,
                                  `product_inventory_maximum`,
                                  `product_inventory_minimum`,
                                  `product_complement`,
                                  `product_fast`)
      VALUES('" . $numero . "', '" . $nome_pt . "', '" . $nome_en . "', '" . $nome_es . "', '" . $desc_pt . "',
      '" . $desc_en . "', '" . $desc_es . "', '" . $price . "', '" . $hora_inicio . "', '" . $hora_fim . "', '" . $categoria . "',
      " . $event . ", 250, 250, 300, 10, " . $complement . " , " . $fast . ")";

      $query = $con->prepare($sql);
      $query->execute();

      $product_id = $con->lastInsertId();

      for($i = 0; $i < $qtd_complemento; $i++){
          $complemento_en = $_POST['complemento_en_' . $i];
          $complemento_es = $_POST['complemento_es_' . $i];
          $complemento_pt = $_POST['complemento_pt_' . $i];

          $sql2 = "INSERT INTO type_product (`type_product_name_pt`, `type_product_name_en`, `type_product_name_es`, `type_product_product_id`, `type_product_active`)
          VALUES('" . $complemento_pt . "', '" . $complemento_en . "', '" . $complemento_es . "', " . $product_id . ", 1)";

          $query2 = $con->prepare($sql2);
          $query2->execute();
      }
      $con->commit();

      $resposta["error"] = false;
      $resposta["message"] = 'Produto adicionado com sucesso.';
    }

  } catch (Exception $e){
      $con->rollBack();

      $resposta["error"] = true;
      $resposta["message"] = 'Erro ao cadastrar o produto.';
  }

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);