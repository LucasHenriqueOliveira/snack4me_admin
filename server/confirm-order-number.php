<?php

date_default_timezone_set('America/Sao_Paulo');
$resposta = array();

try{
	include_once('conexao.php');
	include('class/Order.php');
	
	$id_delivery = $_GET['id'];
	$number = $_GET['number'];
  $date_email = date("d/m/Y");
  $time_email = date("H:m");

	$query = $con->prepare('SELECT `order_id`, `order_status_id` FROM `order`
			WHERE `order_tracking_number` = ? LIMIT 1');
	$query->execute(array($number));
	$query->setFetchMode(PDO::FETCH_CLASS, 'Order');
	$num_rows = $query->rowCount();
	$row = $query->fetch();
	
	if($num_rows > 0){

    if($row->getOrderStatusId() == 2){
      $resposta["error"] = true;
      $resposta["message"] = 'Pedido nº '.$number.' já entregue.';

    } else{
		
      include('class/User.php');

      $query = $con->prepare('SELECT `user_id` FROM `user`
          WHERE `user_id` = ? and `user_profile_id` = ? LIMIT 1');
      $query->execute(array($id_delivery, 1));
      $query->setFetchMode(PDO::FETCH_CLASS, 'User');
      $num_rows = $query->rowCount();

      if($num_rows > 0){
        $order_delivery_date = date('Y-m-d H:i:s');
        $query = $con->prepare("UPDATE `order` SET `order_status_id` = ?,
            `order_user_id_delivery` = ?, `order_delivery_date` = ?
            WHERE `order_tracking_number` = ?");
        $query->execute(array(2, $id_delivery, $order_delivery_date, $number));

        try{
          include('lib/utilities.php');
          $assunto = "Entrega de pedido - Snack4me";
          $message = "Prezado(a), o seu pedido de número ". $number ." foi entregue no dia ".$date_email." às ".$time_email.".<br /><br />" ;
          $message .= "Obrigado<br /><a href='http://www.snack4me.com' target='_blank'><img src='http://www.snack4me.com/hotel/images/logo_small.png' title='Snack4me'></a><br /><br />";
          $message .= "<span style='font-size:9px;color:#d5d5d5'>Favor não responder o email.</span><br />";

          $envia_email = enviarEmail('Cliente Snack4me', $row->getOrderCustomerEmail(), $assunto, $message);

        } catch (Exception $e){
          $assunto = "Erro no envio de confirmação de entrega";
          $message = "Erro no envio de confirmação de entrega nº ".$number."<br /><br />";
          $name = "Erro Entrega";
          $email = "sales@snack4me.com";

          $envia_email = enviarEmail($name, $email, $assunto, $message);
        }

        $resposta["error"] = false;
        $resposta["response"] = 'Order nº' .$number. ' delivered.';

      } else{
        $resposta["error"] = true;
        $resposta["message"] = 'Deliveryman not found.';
      }
    }
	} else{
		$resposta["error"] = true;
		$resposta["message"] = 'Order not found.';
	}

} catch(PDOException $e){
	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);