<?php 

$resposta = array();

try{
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_MAGIC_QUOTES);
	$uuid = filter_var($_POST['uuid'], FILTER_SANITIZE_MAGIC_QUOTES);
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$token = '';
	$date = date('Y-m-d H:i:s');
	
	if(!isset($email)){
		$resposta["error"] = true;
		$resposta["message"] = "Enter a valid email.";
		echo json_encode($resposta);
		die;
	}
	
	if(!isset($name)){
		$resposta["error"] = true;
		$resposta["message"] = "Enter a name.";
		echo json_encode($resposta);
		die;
	}
	
	if(isset($uuid)){
		$token = base64_encode($uuid);
	}

	include_once('conexao.php');
	include('class/Customer.php');
	
	$query = $con->prepare("SELECT `customer_id`, `customer_name` FROM `customer` WHERE `customer_email` = ? LIMIT 1");
	$query->execute(array($email));
	$num_rows = $query->rowCount();
	
	if($num_rows > 0){
		$resposta["error"] = true;
		$resposta["message"] = "E-mail already registered.";
	} else{
		
		$query2 = $con->prepare('INSERT INTO customer(customer_name, customer_email, customer_password, customer_token, customer_device_id, customer_registration_date, customer_type)  VALUES(?,?,?,?,?,?,?)');
		$query2->execute(array($name, $email, SHA1($password), $token, $uuid, $date, 2));
		$num_rows2 = $query2->rowCount();
		
		if($num_rows2 > 0){
			$input = "email=" . $email . "&name=" . $name;
			$arr = array("/" => "#", "\\" => "&");
			$ve = rtrim(strtr(base64_encode(gzdeflate($input, 9)), $arr), '=');
				
			include ('lib/utilities.php');
			$assunto = "Cadastro na Snack4me";
			$mensagem = "Prezado(a) <strong>". $name . "</strong>, bem-vindo a Snack4me. <br /><br />
			Nós precisamos verificar o seu email. Para completar esse processo por favor clique no link abaixo ou copie e cole no seu navegador. <br /><br />" ;
			$mensagem .= "Link de verificação: <a href='http://www.snack4me.com/#/check-email/".$ve."' target='_blank'>http://www.snack4me.com/#/check-email/" . $ve . "</a> <br /><br />";
			$mensagem .= "Obrigado<br /><a href='http://www.snack4me.com' target='_blank'><img src='http://www.snack4me.com/hotel/images/logo_small.png' title='Snack4me'></a><br /><br />";
			$mensagem .= "<span style='font-size:9px;color:#d5d5d5'>Favor não responder o email.</span><br />";
				
			$envia_email = enviarEmail($name, $email, $assunto, $mensagem);

			$resposta["error"] = false;
			$customer["customer_id"] = $con->lastInsertId();
			$customer["email"] = $email;
			$customer["XSRF"] = $token;
			$customer["uuid"] = $uuid; 
			$resposta["response"] = $customer; 
				
		} else{
			$resposta["error"] = true;
			$resposta["message"] = "Error! Please try again.";
		}
	}

} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);