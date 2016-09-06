<?php

require_once('lib/functions.php');
if(!validRequest()) {
	http_response_code(401); 
	die;
}

/*
session_start();
$headerToken = $_SERVER['HTTP_ACCESS_TOKEN'];
$sessionToken = $_SESSION['XSRF'];

if(!isset($sessionToken) && $headerToken != $sessionToken){
	$resposta["error"] = false;
	$resposta["status"] = 3;
	$resposta["message"] = "Favor realizar novamente o login.";

	echo json_encode($resposta);
	die;
}
*/

$resposta = array();
$orders = array();

try{
	include_once('conexao.php');
	include('class/Order.php');
	
	$email = $_POST['email'];
	$id = $_POST['id'];
	
	$query = $con->prepare('SELECT o.order_customer_id, o.order_tracking_number,e.event_name,
			DATE_FORMAT(o.order_date, "%d/%m/%Y %H:%i") as order_date,
			o.order_price_total, s.status_name_pt, s.status_name_en, s.status_name_es, o.order_id
			FROM `order` as o INNER JOIN `event` as e ON o.order_event_id = e.event_id
			INNER JOIN `status` as s ON o.order_status_id = s.status_id
			INNER JOIN `customer` as c ON order_customer_id = c.customer_id
			WHERE c.customer_email = ? and c.customer_id = ? ORDER BY o.order_id DESC');
	$query->execute(array($email, $id));
	$num_rows = $query->rowCount();
	$query->setFetchMode(PDO::FETCH_CLASS, 'Order');
	
	if($num_rows > 0){
		$i = 0;
		while ($row = $query->fetch()){
			$date_time = explode(" ", $row->getOrderDate());

			$status['pt'] = $row->getStatusNamePT();
			$status['en'] = $row->getStatusNameEN();
			$status['es'] = $row->getStatusNameES();
	
			$order['number'] = $i;
			$order['num_order'] = $row->getOrderTrackingNumber();
			$order['event_name'] = $row->getEventName();
			$order['status'] = $status;
			$order['date'] = $date_time[0];
			$order['hour'] = $date_time[1];
			$order['price_total'] = $row->getOrderPriceTotal();
			$order['id'] = $row->getOrderId();
			$orders[] = $order;
			$i++;
		}
	
		$resposta["error"] = false;
		$resposta["response"] = $orders;
		$resposta["status"] = 2;
	} else{
	  $mensagem['pt'] = 'Nenhum pedido encontrado.';
	  $mensagem['en'] = 'Order not found.';

		$resposta["error"] = false;
		$resposta["message"] = $mensagem;
		$resposta["status"] = 1;
	}
} catch(PDOException $e){
	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);