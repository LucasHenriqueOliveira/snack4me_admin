<?php
$resposta = array();

try{
	include_once('conexao.php');
	
	$coupon = $_POST['coupon'];
	$id_event = $_POST['id_event'];
	
	include('class/Coupon.php');
	$sql = 'SELECT c.coupon_number, c.coupon_tax, c.coupon_event_id FROM `coupon` as c 
	WHERE c.coupon_number = ? AND c.coupon_sin_used = "N"';
	$query = $con->prepare($sql);
	$query->execute(array($coupon));
	$query->setFetchMode(PDO::FETCH_CLASS, 'Coupon');
	$num_rows = $query->rowCount();
	$row = $query->fetch();
	
	if($num_rows > 0){
		
		if($row->getCouponEventId() == ''){
			$resposta["error"] = false;
			$resposta["response"] = $row->getCouponTax();
			$resposta["status"] = 2;
		} else{
			if($row->getCouponEventId() == $id_event){
				$resposta["error"] = false;
				$resposta["response"] = $row->getCouponTax();
				$resposta["status"] = 2;
			} else{
			  $message["pt"] = 'Cupom '.$coupon.' não é válido para este evento.';
			  $message["en"] = 'Coupon '.$coupon.' is not valid for this event.';
			  $message["es"] = 'El cupón '.$coupon.' no es válido para este evento.';

				$resposta["error"] = false;
				$resposta["message"] = $message;
				$resposta["status"] = 1;
			}
		}
		
	} else{
	  $message["pt"] = 'Cupom '.$coupon.' não encontrado.';
    $message["en"] = 'Coupon '.$coupon.' not found.';
    $message["es"] = 'El cupón '.$coupon.' no se encontró.';

		$resposta["error"] = false;
		$resposta["message"] = $message;
		$resposta["status"] = 1;
	}

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = "Ocorreu um erro na busca do desconto.";
	$resposta["status"] = 1;
}
echo json_encode($resposta);