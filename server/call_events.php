<?php       

$resposta = array();
$events = array();

try{
	include_once('conexao.php');
	$city = $_REQUEST['city'];
	if ($city){
		$query = $con->prepare('SELECT *,city.city_name FROM event INNER JOIN city ON event.event_city_id = city.city_id WHERE event.event_city_id = ? AND event.event_sin_active = 1');
	    $query->bindParam(1, $city, PDO::PARAM_INT);
	    $query->execute();
	    
	    while ($row = $query->fetch()){
	    	$event['id'] = $row['event_id'];
	    	$event['name'] = $row['event_name'];
	    	$event['image'] = $row['event_image'];
	    	$event['name_city'] = $row['city_name'];
	    	$events[] = $event;
	    }
	    
	    $resposta["error"] = false;
		$resposta["response"] = $events;
	}       
    
} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);