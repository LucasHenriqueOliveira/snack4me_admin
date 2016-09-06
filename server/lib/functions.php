<?php

function protocol_https(){
	return true;
}

function isSession(){
	session_start();
	$headerToken = $_SERVER['HTTP_ACCESS_TOKEN'];
	$sessionToken = $_SESSION['XSRF'];
	
	if(!isset($sessionToken) && $headerToken != $sessionToken){
		return false;
	} else{
		return true;
	}
}

function isToken($token, $uuid, $customer_id){
	
	if(isset($token) && isset($uuid)){
		include('../class/Customer.php');
		
		$query = $con->prepare("SELECT `customer_token`, `customer_device_id` FROM `customer` WHERE `customer_id` = ? LIMIT 1");
		$query->execute(array($customer_id));
		$num_rows = $query->rowCount();
		$query->setFetchMode(PDO::FETCH_CLASS, 'Customer');
		
		if($num_rows > 0){
			$row = $query->fetch();
			if($token == $row->getCustomerToken() && $uuid == $row->getCustomerDeviceId()){
				return true;
			} else{
				return false;
			}
		} else{
			return false;
		}
	} else{
		return false;
	}
	
}

function isDeviceId($uuid){
	
	if(isset($uuid)){
		return true;
	} else{
		return false;
	}
}

function isMobile(){
	require_once('Mobile_Detect.php');
	
	$detect = new Mobile_Detect;
	
	if ($detect->isMobile()) {
		return true;
	} else{
		return false;
	}
	
}

function validRequest($token = null, $uuid = null, $customer_id = null) {
	
	if(isToken($token, $uuid, $customer_id) && isDeviceId($uuid) && protocol_https() && isMobile()){
		return true;
	} else if(protocol_https() && isSession()){
		return true;
	} else{
		return false;
	}
}