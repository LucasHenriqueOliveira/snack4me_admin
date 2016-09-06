<?php 

$resposta = array();
$isApp = false;

try{
	$email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
	$name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
	$type = filter_var($_REQUEST['type'], FILTER_SANITIZE_NUMBER_INT);
	
	if(isset($_REQUEST['uuid'])){
		$uuid = filter_var($_REQUEST['uuid'], FILTER_SANITIZE_MAGIC_QUOTES);
		$token = base64_encode($uuid);
		$isApp = true;
	} else{
		$token = hash('sha256', uniqid(mt_rand() . $_SERVER['HTTP_USER_AGENT'], true));
		$isApp = false;
	}

	include_once('conexao.php');
	include('class/Customer.php');
	
	$query = $con->prepare("SELECT `customer_id`, `customer_email`, `customer_name`, `customer_type` FROM `customer` WHERE `customer_email` = ? LIMIT 1");
	$query->execute(array($email));
	$query->setFetchMode(PDO::FETCH_CLASS, 'Customer');
	$num_rows = $query->rowCount();
	$row = $query->fetch();
	
	if($num_rows > 0){
		
		if(!$isApp){
			session_start();
		
			$_SESSION['id'] = $row->getCustomerId();
			$_SESSION['email'] = $row->getCustomerEmail();
			$_SESSION['name'] = $row->getCustomerName();
			$_SESSION['type'] = $row->getCustomerType();
			$_SESSION['XSRF'] = $token;
		} else{
			$query = $con->prepare("UPDATE `customer` SET `customer_token` = ?, `customer_device_id` = ? WHERE `customer_id` = ?");
			$query->execute(array($token, $uuid, $row->getCustomerId()));
		}
	
		$user['id'] = $row->getCustomerId();
		$user['email'] = $row->getCustomerEmail();
		$user['name'] = $row->getCustomerName();
		$user['type'] = $row->getCustomerType();
		$user['XSRF'] = $token;
		
		$resposta["error"] = false;
		$resposta["response"] = $user;
	
	} else{
		try{
			$date = date('Y-m-d H:i:s');
			
			$sql = "INSERT INTO `customer` (`customer_name`,`customer_email`,`customer_registration_date`,
			`customer_sin_valid`,`customer_valid_date`,`customer_type`)
			VALUES('" . $name . "', '" . $email . "', '" . $date . "',
			'S', '" . $date . "', " . $type . ")";
			
			$query = $con->prepare($sql);
			$query->execute();
			
			if(!$isApp){
				session_start();
			
				$_SESSION['id'] = $con->lastInsertId();
				$_SESSION['email'] = $email;
				$_SESSION['name'] = $name;
				$_SESSION['type'] = $type;
				$_SESSION['XSRF'] = $token;
			} else{
				$query = $con->prepare("UPDATE `customer` SET `customer_token` = ?, `customer_device_id` = ? WHERE `customer_id` = ?");
				$query->execute(array($token, $uuid, $con->lastInsertId()));
			}
			
			$user['id'] = $con->lastInsertId();
			$user['email'] = $email;
			$user['name'] = $name;
			$user['type'] = $type;
			$user['XSRF'] = $token;
			
			$resposta["error"] = false;
			$resposta["response"] = $user;
			
		} catch (Exception $e){
			
			$resposta["error"] = true;
			$resposta["message"] = "Error! User login by network social.";
		}
	}
} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = "Error! User login by network social.";
}
echo json_encode($resposta);