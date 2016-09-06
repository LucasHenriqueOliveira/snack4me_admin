<?php

$ve = $_GET['ve'];
$delivery = $_GET['delivery'];
$order_delivery_date = date('Y-m-d H:i:s');

if(isset($delivery)){
	header('Location: http://www.snack4me.com/hotel/confirm-order.php?ve='.$ve.'&id='.$delivery.'&d='.$order_delivery_date);
} else{
	header('Location: http://www.snack4me.com/hotel/page/#/read-order/'.$ve);
}

die;
