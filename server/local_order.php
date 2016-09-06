<?php 
date_default_timezone_set('America/Sao_Paulo');

$resposta = array();
$locals = array();
try{
	$id_event = $_GET['id_event'];
	
	include_once('conexao.php');
	include('class/LocalOrder.php');

	$query = $con->prepare('SELECT local_order_id, local_order_name_pt, local_order_name_en, local_order_name_es FROM local_order
			WHERE local_order_active = 1 AND local_order_event_id = ? 
                        ORDER BY local_order_name_pt ASC');
	$query->execute(array($id_event));
	$num_rows = $query->rowCount();
	$query->setFetchMode(PDO::FETCH_CLASS, 'LocalOrder'); 
	
	if($num_rows > 0){
		while ($row = $query->fetch()){
                        $name['pt'] = $row->getLocalOrderNamePT();
                        $name['en'] = $row->getLocalOrderNameEN();
                        $name['es'] = $row->getLocalOrderNameES();

			$local_order['id'] = $row->getLocalOrderId();
                        $local_order['name'] = $name;
                        $locals[] = $local_order;
		}
	}
	
	$resposta["error"] = false;
	$resposta["response"] = $locals;
	
} catch (Exception $e){
	
	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);