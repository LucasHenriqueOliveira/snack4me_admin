<?php 
date_default_timezone_set('America/Sao_Paulo');

$resposta = array();
$eventos = array();
try{
	$latitude = $_REQUEST['lat'];
	$longitude = $_REQUEST['lon'];
	
	include_once('conexao.php');
	include('class/Event.php');

	$query = $con->query('SELECT *,
			( 6371 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance, city_name
			FROM event INNER JOIN city ON event_city_id = city_id
			WHERE event_sin_active = 1
			ORDER BY distance');
	$num_rows = $query->rowCount();
	$query->setFetchMode(PDO::FETCH_CLASS, 'Event'); 
	
	if($num_rows > 0){
		while ($row = $query->fetch()){

			$evento['id'] = $row->getEventId();
      $evento['name'] = $row->getEventName();
      $evento['distance'] = $row->getDistance();
      $evento['image'] = $row->getEventImage();
      $evento['city'] = $row->getCityName();
      $eventos[] = $evento;
		}
	}
	
	$resposta["error"] = false;
	$resposta["response"] = $eventos;
	
} catch (Exception $e){
	
	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);