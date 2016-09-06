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

date_default_timezone_set('America/Sao_Paulo');
$resposta = array();
$arrItem = array();

try{
  include_once('conexao.php');

  $num_products = filter_var($_POST['num_products'], FILTER_SANITIZE_NUMBER_INT);
  $prod_qtd = array();
  $itens = 0;

  $products = ' AND (';
  for($i = 0; $i < $num_products; $i++){
    if($_POST['qtd_product_'.$i] > 0){
      $itens++;
      $products .= 'product_id = '.$_POST['id_product_'.$i] . ' OR ';
      $prod_qtd[$_POST['id_product_'.$i]] = $_POST['qtd_product_'.$i];
    }
  }
  $products = substr($products,0,-3);
  $products .= ')';

  $arrIdProducts = explode("|", $_POST['id_products']);
  $arrTypeProducts = explode("|", $_POST['type_products']);
  $arrCommentProducts = explode("|", $_POST['comment_products']);

  $id_event = filter_var($_POST['id_event'], FILTER_SANITIZE_NUMBER_INT);
  $seat = $_POST['seat'];
  $floor = $_POST['floor'];
  $coupon = '';
  $coupon_number = '';
  $coupon_tax = '';
  $coupon_id = null;
  $num_rows3 = 0;
  $id_user = filter_var($_POST['id_user'], FILTER_SANITIZE_NUMBER_INT);
  $email = $_POST['email'];
  $name = $_POST['name'];
  $order_tracking_number = $id_user . date('ymdHi');
  $local = $_POST["local"];
  $lang = $_POST["lang"];
  $schedule_time = '';
  $schedule = 0;

  if(isset($_POST["schedule"]) && !empty($_POST['schedule']) && $_POST['schedule'] != 'undefined'){
      $schedule = new DateTime($_POST["schedule"]);
      $now = new DateTime();
      $schedule_time = $schedule->format('H:i:s');
      $now = $now->format('H:i:s');
      $schedule = 1;

      if($schedule_time < $now){
        $resposta["error"] = true;
        $resposta["status"] = 1;
        $resposta["message"] = "Horário do agendamento deve ser maior ou igual que horário atual!";
        echo json_encode($resposta);
        die;
      }
  } else {
    $now = new DateTime();
    $schedule_time = $now = $now->format('H:i:s');
    $schedule = 0;
  }

  if(isset($_POST['coupon']) && !empty($_POST['coupon']) && $_POST['coupon'] != 'null'){
    $coupon = filter_var($_POST['coupon'], FILTER_SANITIZE_MAGIC_QUOTES);

    include('class/Coupon.php');
    $sql3 = 'SELECT c.coupon_number, c.coupon_tax, c.coupon_id, c.coupon_event_id FROM `coupon` as c WHERE c.coupon_number = ? AND coupon_sin_used="N"';

    $query3 = $con->prepare($sql3);
    $query3->execute(array($coupon));
    $num_rows3 = $query3->rowCount();
    $query3->setFetchMode(PDO::FETCH_CLASS, 'Coupon');

    if($num_rows3 > 0){
      $row3 = $query3->fetch();
      if($row3->getCouponEventId() == '' || $row3->getCouponEventId() == $id_event){
        $coupon_number = $row3->getCouponNumber();
        $coupon_tax = $row3->getCouponTax();
        $coupon_id = $row3->getCouponId();
      }
    }
  }

  include('class/Event.php');
  $sql2 = 'SELECT e.event_tax_service FROM `event` as e WHERE e.event_id = ?';

  $query2 = $con->prepare($sql2);
  $query2->execute(array($id_event));
  $query2->setFetchMode(PDO::FETCH_CLASS, 'Event');
  $row2 = $query2->fetch();

  $tax_service = $row2->getEventTaxService();

  include('class/Product.php');
  $sql = 'SELECT `product_id`,`product_name_pt`, `product_name_en`, `product_name_es`,`product_price` FROM product WHERE product_event_id = ?'. $products;
  $query = $con->prepare($sql);
  $query->execute(array($id_event));
  $num_rows = $query->rowCount();
  $query->setFetchMode(PDO::FETCH_CLASS, 'Product');

  if($num_rows > 0){
    $total = 0;
    $i = 0;
    $product[] = array();

    while ($row = $query->fetch()){
      /*
      $produto['id_produto'] = $row->getProductId();
      $produto['name'] = $row->getProductName();
      $produto['price'] = $row->getProductPrice();
      $produto['quantity'] = $prod_qtd[$row->getProductId()];
      $produto['subtotal_unit'] = number_format($row->getProductPrice() * $prod_qtd[$row->getProductId()],2);

      $produtos[] = $produto;
      */
      $subtotal += $row->getProductPrice() * $prod_qtd[$row->getProductId()];

      $product[$i]['id'] = $row->getProductId();
      $product[$i]['price'] = $row->getProductPrice();
      $product[$i]['quantity'] = $prod_qtd[$row->getProductId()];
      $product[$i]['subtotal'] = number_format($row->getProductPrice() * $prod_qtd[$row->getProductId()],2);
      $i++;
    }

    if($num_rows3 > 0){
      $discount = number_format($subtotal * $coupon_tax,2);
      $total = number_format($subtotal - $discount,2);
    } else{
      $discount = '0.00';
      $total = number_format($subtotal,2);
    }
    $subtotal = number_format($subtotal, 2);
    $date = date('Y-m-d H:i:s');

    try{
      $con->beginTransaction();

      $sql = "INSERT INTO `order`  (`order_customer_id`,
                            `order_customer_email`,
                            `order_tracking_number`,
                            `order_date`,
                            `order_apartment`,
                            `order_floor`,
                            `order_local_order_id`,
                            `order_price`,
                            `order_price_discount`,
                            `order_tax_service`,
                            `order_price_total`,
                            `order_coupon_id`,
                            `order_event_id`,
                            `order_schedule_date`,
                            `order_schedule`,
                            `order_status_id`)
      VALUES(" . $id_user . ", '" . $email . "', '" . $order_tracking_number . "', '" . $date . "', '" . $seat . "',
      '" . $floor . "', '" . $local . "', " . $subtotal . ",
      " . $discount . ", " . $tax_service . ", " . $total . ", '" . $coupon_id . "', " . $id_event . ", '" . $schedule_time . "' , '" . $schedule . "' ,1)";

      $query = $con->prepare($sql);
      $query->execute();

      $order_id = $con->lastInsertId();


      for($i = 0; $i < count($product); $i++){

        $sql = "INSERT INTO item (`item_order_id`, `item_product_id`,
        `item_price_unit`, `item_quantity`, `item_price_total`)
        VALUES(" . $order_id . ", " . $product[$i]['id'] . ",
        " . $product[$i]['price'] . ", " . $product[$i]['quantity'] . ", " . $product[$i]['subtotal'] . ")";

        $query = $con->prepare($sql);
        $query->execute();

        $item_id = $con->lastInsertId();

        $arrItem[$product[$i]['id']] = $item_id;

        // SUBTRAI A QUANTIDADE NO ESTOQUE
        $sql5 = "UPDATE product
                SET product_inventory_current = product_inventory_current - " . $product[$i]['quantity'] . "
            WHERE product_id = ?";
        $query5 = $con->prepare($sql5);
        $query5->execute(array($product[$i]['id']));

      }


      for($i = 0; $i < count($arrIdProducts); $i++){
        $type_product = 'null';

        if($arrTypeProducts[$i] != ''){
            $type_product = explode("*", $arrTypeProducts[$i]);
            
            for($a = 0; $a < count($type_product); $a++){
               $sql = "INSERT INTO item_type_product (`item_type_product_desc`, `item_type_product_item_id`,
                          `item_type_product_type_product_id`, `item_type_product_product_id`)
                          VALUES('" . $arrCommentProducts[$i] . "', " . $arrItem[$arrIdProducts[$i]] . ",
                          " . $type_product[$a] . ", " . $arrIdProducts[$i] . ")";
               
                  $query = $con->prepare($sql);
                  $query->execute();
            }

        } else {
          $sql = "INSERT INTO item_type_product (`item_type_product_desc`, `item_type_product_item_id`,
                          `item_type_product_type_product_id`, `item_type_product_product_id`)
                          VALUES('" . $arrCommentProducts[$i] . "', " . $arrItem[$arrIdProducts[$i]] . ",
                          " . $type_product . ", " . $arrIdProducts[$i] . ")";

                  $query = $con->prepare($sql);
                  $query->execute();
        } 

      }

      $con->commit();

      $input = "o=" . $order_id . "&n=" . $order_tracking_number;
      $arr = array("/" => "#", "\\" => "&");
      $ve = rtrim(strtr(base64_encode(gzdeflate($input, 9)), $arr), '=');

      try{
        include ('lib/utilities.php');

        $titulo = $order_tracking_number . ".pdf";
        $html = geraHTML($order_id, $lang);
        $bolPDF = geraPDF($titulo, $html);

        if($lang == 'pt') {

            $assunto = "Pedido realizado - " . $order_tracking_number;
            $message = "Prezado(a), a Snack4me agradece pelo pedido realizado. Você pode verificar o status do seu pedido fazendo login em sua conta. Confirmação do seu pedido está em anexo.<br /><br />";

            $message .= "Obrigado<br /><a href='http://www.snack4me.com' target='_blank'><img src='http://www.snack4me.com/hotel/images/logo_small.png' title='Snack4me'></a><br /><br />";
            $message .= "<span style='font-size:9px;color:#d5d5d5'>Favor não responder o email.</span><br />";
        
        } else if ($lang == 'es') {

            $assunto = "Order done - " . $order_tracking_number;
            $message = "Dear, the Snack4me appreciates the order placed. You can check the status of your order by logging into your account. Your order confirmation is attached.<br /><br />";

            $message .= "Thank you<br /><a href='http://www.snack4me.com' target='_blank'><img src='http://www.snack4me.com/hotel/images/logo_small.png' title='Snack4me'></a><br /><br />";
            $message .= "<span style='font-size:9px;color:#d5d5d5'>Please don't respond to email.</span><br />";
        
        } else {

            $assunto = "Order done - " . $order_tracking_number;
            $message = "Dear, the Snack4me appreciates the order placed. You can check the status of your order by logging into your account. Your order confirmation is attached.<br /><br />";

            $message .= "Thank you<br /><a href='http://www.snack4me.com' target='_blank'><img src='http://www.snack4me.com/hotel/images/logo_small.png' title='Snack4me'></a><br /><br />";
            $message .= "<span style='font-size:9px;color:#d5d5d5'>Please don't respond to email.</span><br />";
        }

        $envia_email = enviarEmail($name, $email, $assunto, $message, $tipo = $bolPDF, $titulo);

        $dados['id_order'] = $order_id;
        $dados['num_order'] = $order_tracking_number;
        $dados['ve'] = $ve;

        $resposta["error"] = false;
        $resposta["status"] = 2;
        $resposta["response"] = $dados;

      } catch (Exception $e){

        $assunto = "Erro no envio de email";
        $message = "Erro no envio de email do pedido ".$order_tracking_number."<br /><br />";
        $name = "Erro Sales";
        $email = "sales@snack4me.com";

        $envia_email = enviarEmail($name, $email, $assunto, $message);

        $dados['id_order'] = $order_id;
        $dados['num_order'] = $order_tracking_number;
        $dados['ve'] = $ve;

        $resposta["error"] = false;
        $resposta["status"] = 2;
        $resposta["response"] = $dados;
      }
    } catch (Exception $e){
      $con->rollBack();

      $resposta["error"] = true;
      $resposta["status"] = 1;
      $resposta["message"] = "Erro ao salvar dados do pedido!";
    }

  } else{
    $resposta["error"] = true;
    $resposta["status"] = 1;
    $resposta["message"] = 'Erro ao salvar dados do pedido.';
  }
} catch (Exception $e){

  $resposta["error"] = true;
  $resposta["message"] = $e->getMessage();
}

echo json_encode($resposta);