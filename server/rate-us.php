<?php

date_default_timezone_set('America/Sao_Paulo');

require_once('lib/functions.php');
if(!validRequest()) {
	http_response_code(401); 
	die;
}

$resposta = array();

try{

	$id_order = $_POST['id_order'];
	$comment = '';
        if(isset($_POST['comment']) && !empty($_POST['comment']) && $_POST['comment'] != 'undefined') {
           $comment = $_POST['comment'];
        }
        $rate_order_question_1 = isset($_POST['rate_0']) ? $_POST['rate_0'] : null;
        $rate_order_question_2 = isset($_POST['rate_1']) ? $_POST['rate_1'] : null;
        $rate_order_question_3 = isset($_POST['rate_2']) ? $_POST['rate_2'] : null;
	include_once('conexao.php');
	include('class/RateOrder.php');

	$query = $con->prepare("SELECT * FROM `rate_order` WHERE `rate_order_order_id` = ? LIMIT 1");
	$query->execute(array($id_order));
	$query->setFetchMode(PDO::FETCH_CLASS, 'RateOrder');
	$num_rows = $query->rowCount();
	$row = $query->fetch();

	if($num_rows > 0){

		$query = $con->prepare("UPDATE `rate_order` SET `rate_order_question_1` = ?, `rate_order_question_2` = ?, `rate_order_question_3` = ?, `rate_order_desc` = ? WHERE `rate_order_order_id` = ?");
	        $query->execute(array($rate_order_question_1, $rate_order_question_2, $rate_order_question_3, $comment, $id_order));

		$resposta["error"] = false;
		$resposta["message"] = true;

	} else{

               $sql = "INSERT INTO `rate_order` (`rate_order_question_1`,`rate_order_question_2`,`rate_order_question_3`,
			`rate_order_desc`,`rate_order_order_id`)
			VALUES(?, ?, ?, ?, ?)";
			
	       $query = $con->prepare($sql);
	       $query->execute(array($rate_order_question_1, $rate_order_question_2, $rate_order_question_3, $comment, $id_order));

		$resposta["error"] = false;
		$resposta["message"] = true;
	}

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);