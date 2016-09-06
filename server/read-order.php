<?php

$resposta = array();
$products = array();

function separar_parametros($param) {
	return explode('&',$param);
}

function separar_valor($opcao) {
	return explode('=',$opcao);
}

try{
	include_once('conexao.php');
	include('class/Order.php');

	$ve = $_POST['ve'];
	$arr = array("#" => "/", "&" => "\\");

	$parametros = separar_parametros(gzinflate(base64_decode(strtr($ve,$arr))));
	foreach($parametros as $opcao) {
		$valor[] = separar_valor($opcao);
	}

	$order = $number = '';
	if(isset($valor[0][1])){
		$order = $valor[0][1];
	}

	if(isset($valor[1][1])){
		$number = $valor[1][1];
	}

	$query = $con->prepare('SELECT *,
			DATE_FORMAT(o.order_date, "%d/%m/%Y %H:%i") as order_date,
			o.order_tax_service, s.status_name_pt, s.status_name_en, s.status_name_es, o.order_local_order_id
			FROM `order` as o INNER JOIN `event` as e ON o.order_event_id = e.event_id
			INNER JOIN `status` as s ON o.order_status_id = s.status_id
			WHERE order_id = ? and order_tracking_number = ? LIMIT 1');
	$query->execute(array($order, $number));
	$query->setFetchMode(PDO::FETCH_CLASS, 'Order');
	$num_rows = $query->rowCount();

	if($num_rows > 0){
		$row = $query->fetch();
		$date_time = explode(" ", $row->getOrderDate());

    $status['pt'] = $row->getStatusNamePT();
    $status['en'] = $row->getStatusNameEN();
    $status['es'] = $row->getStatusNameES();

		$pedido['num_order'] = $row->getOrderTrackingNumber();
		$pedido['date'] = $date_time[0];
		$pedido['hour'] = $date_time[1];
		$pedido['event_name'] = $row->getEventName();
    $pedido['status_order'] = $status;
    $pedido['floor'] = $row->getOrderFloor();
		$pedido['seat'] = $row->getOrderApartment();

		include('class/Item.php');
    include('class/ItemTypeProduct.php');

		$query2 = $con->prepare('SELECT i.item_price_total,i.item_price_unit,i.item_quantity,
				p.product_name_pt, p.product_name_en, p.product_name_es,
        p.product_desc_pt, p.product_desc_en, p.product_desc_es
				FROM item as i INNER JOIN product as p ON i.item_product_id = p.product_id
				WHERE item_order_id = ?');
		$query2->execute(array($order));
		$query2->setFetchMode(PDO::FETCH_CLASS, 'Item');

		while ($row2 = $query2->fetch()){

      $query3 = $con->prepare('SELECT i.item_type_product_desc, i.item_type_product_type_product_id
                    FROM item_type_product as i
                    WHERE i.item_type_product_product_id = ? AND i.item_type_product_item_id = ?');
      $query3->execute(array($row2->getItemProductId(), $row2->getItemId()));

      $tipo_produtos = array();
      while ($row3 = $query3->fetch()){
         if($row3['item_type_product_type_product_id']) {
            $query4 = $con->prepare('SELECT t.type_product_name_pt, t.type_product_name_en, t.type_product_name_es
                          FROM type_product as t
                          WHERE t.type_product_id = ?');
            $query4->execute(array($row3['item_type_product_type_product_id']));
            $row4 = $query4->fetch();

            $tipo_produto_nome['pt'] = $row4['type_product_name_pt'];
            $tipo_produto_nome['en'] = $row4['type_product_name_en'];
            $tipo_produto_nome['es'] = $row4['type_product_name_es'];

            $tipo_produto['name'] = $tipo_produto_nome;
         }
         $tipo_produto['comment'] = $row3['item_type_product_desc'];
         $tipo_produto['id'] = $row3['item_type_product_type_product_id'];
         $tipo_produtos[] = $tipo_produto;
      }

      $produto['pt'] = $row2->getProductNamePT();
      $produto['en'] = $row2->getProductNameEN();
      $produto['es'] = $row2->getProductNameES();

      $produto_des['pt'] = $row2->getProductDescPT();
      $produto_des['en'] = $row2->getProductDescEN();
      $produto_des['es'] = $row2->getProductDescES();

      $product['name'] = $produto;
			$product['desc'] = $produto_des;
			$product['type'] = $tipo_produtos;
			$product['price_unit'] = $row2->getItemPriceUnit();
			$product['quantity'] = $row2->getItemQuantity();
			$product['price_total'] = $row2->getItemPriceTotal();
			$products[] = $product;
		}

		$query5 = $con->prepare('SELECT local_order_name_pt, local_order_name_en, local_order_name_es
                                  FROM local_order
                                  WHERE local_order_id = ?');
    $query5->execute(array($row->getOrderLocalOrderId()));
    $row5 = $query5->fetch();

    $local['pt'] = $row5['local_order_name_pt'];
    $local['en'] = $row5['local_order_name_es'];
    $local['es'] = $row5['local_order_name_en'];

		$pedido['local'] = $local;
    $pedido['products'] = $products;
    $pedido['price'] = $row->getOrderPrice();
    $pedido['discount'] = $row->getOrderPriceDiscount();
    $pedido['tax_service'] = $row->getOrderTaxService();
    $pedido['price_total'] = $row->getOrderPriceTotal();

    $resposta["error"] = false;
    $resposta["response"] = $pedido;
    $resposta["status"] = 2;

	} else{
		$mensagem['pt'] = 'Nenhum pedido encontrado.';
		$mensagem['es'] = 'No hay pedidos encontrados.';
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
