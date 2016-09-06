<?php

$resposta = array();
$cities = array();

try{
	include_once('conexao.php');
	include_once('class/Event.php');
	
	$query = $con->prepare('SELECT e.event_city_id, c.city_name
			FROM event e INNER JOIN city c ON e.event_city_id = c.city_id
			WHERE e.event_sin_active = 1
			GROUP BY e.event_city_id');
	$query->execute();
	$query->setFetchMode(PDO::FETCH_CLASS, 'Event');
	
	while ($row = $query->fetch()){
		$city['id_city'] = $row->getEventCityId();
		$city['name_city'] = $row->getCityName();
		$cities[] = $city;
	}
	
	$resposta["error"] = false;
	$resposta["response"] = $cities;
	
} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);