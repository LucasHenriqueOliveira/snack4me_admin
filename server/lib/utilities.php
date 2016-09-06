<?php

function enviarEmail($nome_destinatario, $destinatario, $assunto, $mensagem, $tipo = false, $titulo = '') {
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
	
	require "$root/hotel/lib/phpmailer/class.smtp.php";
	require "$root/hotel/lib/phpmailer/class.phpmailer.php";
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP(); // Define que a mensagem será SMTP
	$mail->Host = "mail.snack4me.com"; // Endereço do servidor SMTP
	$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
	$mail->Username = 'noreply@snack4me.com'; // Usuário do servidor SMTP
	$mail->Password = 'Snack4me'; // Senha do servidor SMTP
	//$mail->Port = 25;
	
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "noreply@snack4me.com"; // Seu e-mail
	$mail->FromName = "Snack4me"; // Seu nome
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($destinatario, $nome_destinatario);
	//$mail->AddAddress('ciclano@site.net');
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
	
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
	
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	// $mail->Subject  = "Mensagem Teste"; // Assunto da mensagem
	$mail->Subject = $assunto; // Assunto da mensagem
	//$mail->Body = "Este é o corpo da mensagem de teste, em <b>HTML</b>! <br />";
	$mail->Body = $mensagem;
	//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n";
	
	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
	if($tipo){
		$path = "./orders/" . $titulo;
		chmod($path, 0777);
	
		$mail->AddAttachment($path);  // Insere um anexo
	}
	
	// Envia o e-mail
	$enviado = $mail->Send();
	
	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	
	// Exibe uma mensagem de resultado
	if ($enviado) {
		return true;
	} else {
		return false;
	}
}

function geraHTML($order_id, $lang) {
	include('./conexao.php');
	include('./class/Order.php');
	include('./class/ItemTypeProduct.php');
	include('./class/TypeProduct.php');
	
	$query = $con->prepare('SELECT *,
			DATE_FORMAT(o.order_date, "%d/%m/%Y %H:%i") as order_date,
			DATE_FORMAT(o.order_schedule_date, "%H:%i") as order_schedule_date, order_schedule,
			o.order_tax_service, o.order_local_order_id
			FROM `order` as o INNER JOIN `event` as e ON o.order_event_id = e.event_id
			WHERE order_id = ? LIMIT 1');
	$query->execute(array($order_id));
	$query->setFetchMode(PDO::FETCH_CLASS, 'Order');
	$row = $query->fetch();
	$date_time = explode(" ", $row->getOrderDate());
	
	$input = "o=" . $order_id . "&n=" . $row->getOrderTrackingNumber();
	$arr = array("/" => "#", "\\" => "&");
	$ve = rtrim(strtr(base64_encode(gzdeflate($input, 9)), $arr), '=');
	$url = "http://www.snack4me.com/hotel/read.php?ve=".$ve;

        if($lang == 'pt') {
           $labelOrder = 'Pedido';
           $labelDate = 'Data do pedido';
           $labelHour = 'Horário do pedido';
           $labelFloor = 'Andar';
           $labelApartment = 'Apartamento';
           $labelProducts = 'Produtos';
           $labelPrice = 'Preço';
           $labelDiscount = 'Desconto';
           $labelTaxService = 'Taxa de Serviço';
        } else {
           $labelOrder = 'Order';
           $labelDate = 'Date of order';
           $labelHour = 'Time of the order';
           $labelFloor = 'Floor';
           $labelApartment = 'Room';
           $labelProducts = 'Products';
           $labelPrice = 'Price';
           $labelDiscount = 'Discount';
           $labelTaxService = 'Tax Service';
        }
	$html = '<!doctype html>
				<html> 
				    <head>
				    </head> 
				    <body>
				    	<table boder="0" width="100%">
							<tr>
								<td width="50%">
									<h2 id="logo"><img src="images/logo.png" width="200px" height="100px" title="Snack4me" class="logo" /></h2>
								</td>
								<td width="50%" style="text-align:right">
									<img src="http://chart.apis.google.com/chart?chs=150x150&cht=qr&chld=L|0&chl='.$url.'" alt="QR code"/>
								</td>
							</tr>
						</table>
						<div style="text-align:left;">
							<h2>'. $labelOrder .' Nº '.$row->getOrderTrackingNumber(). '</h2>
							<ul style="list-style-type: none;">
								<li><strong>'.$labelDate.':</strong> '. $date_time[0] .'</li>
								<li><strong>'.$labelHour.':</strong> '. $date_time[1] .'</li><br /><br />';
	
								$html .= '<li>'.$row->getEventName() . ' </li>';
								$html .= '<li><strong>'.$labelFloor.':</strong> '.$row->getOrderFloor() . '</li>';
								$html .= '<li><strong>'.$labelApartment.':</strong> '.$row->getOrderApartment() . '</li>';
					$html .= '</ul>
						</div>';
					$html .= '<div>';
					
						include('./class/Item.php');
						
						$query2 = $con->prepare('SELECT i.item_price_total,i.item_price_unit,i.item_quantity, i.item_product_id, i.item_id,
								p.product_name_pt, p.product_name_en, p.product_name_es, p.product_desc_pt, p.product_desc_en, p.product_desc_es
								FROM item as i INNER JOIN product as p ON i.item_product_id = p.product_id
								WHERE item_order_id = ?');
						$query2->execute(array($order_id));
						$query2->setFetchMode(PDO::FETCH_CLASS, 'Item');
						
						$html .= "<table width='100%' style='border:1px solid black;border-collapse: collapse;' border='1'>
						<tr>
						<th style='background: #f1f1f1;'>".$labelProducts."</th>
						<th style='background: #f1f1f1;'>".$labelPrice."</th>
						<th style='background: #f1f1f1;'>Qtd</th>
						<th style='background: #f1f1f1;'>Subtotal</th>
						</tr>";

						while ($row2 = $query2->fetch()){

              $type = '';
						  $query3 = $con->prepare('SELECT i.item_type_product_desc, i.item_type_product_type_product_id
                                                    FROM item_type_product as i
                                                    WHERE i.item_type_product_product_id = ? AND i.item_type_product_item_id = ?');
              $query3->execute(array($row2->getItemProductId(), $row2->getItemId()));

              while ($row3 = $query3->fetch()){

                if($lang == 'pt') {
                     $comment = 'obs.: ';
                } else if($lang == 'es') {
                     $comment = 'obs.: ';
                } else {
                     $comment = 'p.s.: ';
                }

                if($row3['item_type_product_type_product_id']) {

                  $query4 = $con->prepare('SELECT t.type_product_name_pt, t.type_product_name_en, t.type_product_name_es
                                                                        FROM type_product as t
                                                                        WHERE t.type_product_id = ?');
                  $query4->execute(array($row3['item_type_product_type_product_id']));
                  $row4 = $query4->fetch();

                  if($lang == 'pt') {
                       $type_prod = '- ' . $row4['type_product_name_pt'];
                  } else if($lang == 'es') {
                       $type_prod = '- ' . $row4['type_product_name_es'];
                  } else {
                       $type_prod = '- ' . $row4['type_product_name_en'];
                  }

                  $type .= $type_prod . '<br/>';
                  if($row3['item_type_product_desc']){
                    $type .= $comment . $row3['item_type_product_desc'] . '<br/>';
                  }

                } else {
                  if($row3['item_type_product_desc']){
                    $type .= $comment . $row3['item_type_product_desc'] . '<br/>';
                  }
                }
              }

              if($lang == 'pt') {
                  $prod = $row2->getProductNamePT();
                  $prod_desc = $row2->getProductDescPT();
              } else if($lang == 'es') {
                  $prod = $row2->getProductNameES();
                  $prod_desc = $row2->getProductDescES();
              } else {
                  $prod = $row2->getProductNameEN();
                  $prod_desc = $row2->getProductDescEN();
              }

							$html .= '<tr><td><strong>' . $prod . '</strong><br />' . $prod_desc . '<br />' . $type . '</td>
							<td style="text-align:center;">' . $row2->getItemPriceUnit() . '</td>
							<td style="text-align:center;">' . $row2->getItemQuantity() . ' </td>
							<td style="text-align:center;">' . $row2->getItemPriceTotal() . '</td>
							</tr>';
						}
						$html .= "<tr><td colspan='3' style='text-align: right'>Subtotal (R$)</td>
						<td style='text-align:center;'>".$row->getOrderPrice()."</td></tr>";
						$html .= "<tr><td colspan='3' style='text-align: right'>".$labelDiscount." (R$)</td>
						<td style='text-align:center;'>".$row->getOrderPriceDiscount()."</td></tr>";
						$html .= "<tr><td colspan='3' style='text-align: right'>".$labelTaxService." (R$)</td>
						<td style='text-align:center;'>".$row->getOrderTaxService()."</td></tr>";
						$html .= "<tr><td colspan='3' style='text-align: right'>Total (R$)</td>
						<td style='text-align:center;'>".$row->getOrderPriceTotal()."</td></tr>";
						$html .= "</table>";
					$html .= '</div>';

					if($row->getOrderLocalOrderId() > 0) {
					  $query5 = $con->prepare('SELECT local_order_name_pt, local_order_name_en, local_order_name_es
                                      FROM local_order
                                      WHERE local_order_id = ?');
            $query5->execute(array($row->getOrderLocalOrderId()));
            $row5 = $query5->fetch();

            if($lang == 'pt') {
                $local = 'Local para entrega: ' . $row5['local_order_name_pt'];
            } else if($lang == 'es') {
                $local = 'Lugar de entrega: ' . $row5['local_order_name_es'];
            } else {
                $local = 'Place for delivery: ' . $row5['local_order_name_en'];
            }

            $html .= '<p>' . $local . '.</p>';
					}
					
					if($row->getOrderSchedule() == 1){
					  if($lang == 'pt') {
						  $html .= '<p>Obs: O seu pedido foi agendado para ser entregue às ' . $row->getOrderScheduleDate() . '.</p>';
						} else {
						  $html .= '<p>Note: Your request is scheduled to be delivered to ' . $row->getOrderScheduleDate() . '.</p>';
						}
					}
					$html .= '</body> 
				</html>';
					
	return $html;
	
}

function geraPDF($titulo, $html) {
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	
	require_once "$root/hotel/lib/dompdf/dompdf_config.inc.php";
	
	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4", "portrail"); // Altera o papel para modo paisagem.
	$dompdf->load_html($html); // Carrega o HTML para a classe.
	$dompdf->render();
	$pdf = $dompdf->output(); // Cria o pdf
	$arquivo = "./orders/".$titulo; // Caminho onde será salvo o arquivo.

	if (file_put_contents($arquivo,$pdf)) { //Tenta salvar o pdf gerado
		return true; // Salvo com sucesso.
	} else {
		return false; // Erro ao salvar o arquivo
	}
}