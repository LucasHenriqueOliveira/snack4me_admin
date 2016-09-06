<?php

try{
	$con = new PDO('mysql:host=127.0.0.1;dbname=anjtr452_snack4me_hotel','anjtr452_snack4','Snack4meHotel');
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$con->exec("SET CHARACTER SET utf8");
} catch(PDOException $e){
	echo $e->getMessage();
	die();
}