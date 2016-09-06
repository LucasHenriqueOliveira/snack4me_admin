<?php 
include_once('../class/Order.php');
include_once('../class/Item.php');
include_once('../class/EventFloor.php');
include_once('../class/EventSector.php');

class Painel{
	
	private $ultimo_id;
	private $id_event;
	private $id_order;
	
	public function setUltimoId($ultimo_id) {
		
		if(!is_null($ultimo_id)){
			if (!is_numeric($ultimo_id)){
				throw new Exception('Ultimo Id não é numérico ('.$ultimo_id.').');
			}
			$this->ultimo_id = $ultimo_id;
		}
		return $this;
	}
	
	public function getUltimoId(){
		if(!isset($this->ultimo_id)){
			return 0;
		}
		return $this->ultimo_id;
	}
	
	public function setIdEvent($id_event) {
		
		if (!is_numeric($id_event)){
			throw new Exception('Id do evento não é numérico('.$id_event.').');
		}
		$this->id_event = $id_event;
		return $this;
	}
	
	public function getIdEvent(){
		
		if (!is_numeric($this->id_event)){
			throw new Exception('Id do evento não é numérico.');
		}
		return $this->id_event;
	}
	
	public function consultaPedidos(){
		include('../conexao.php');
		
		$query = $con->prepare('SELECT o.order_tracking_number,e.event_name, o.order_chair,
				o.order_floor, o.order_sector,
				DATE_FORMAT(o.order_date, "%d/%m/%Y %H:%i") as order_date,
				o.order_price_total, o.order_id, o.order_status_id
				FROM `order` as o INNER JOIN `event` as e ON o.order_event_id = e.event_id
				WHERE e.event_id = ? AND o.order_id > ? ORDER BY order_id');
		
		$query->execute(array($this->getIdEvent(), $this->getUltimoId()));
		$num_rows = $query->rowCount();
		$query->setFetchMode(PDO::FETCH_CLASS, 'Order');
		
		if($num_rows > 0){
			$pedidos = array();
		
			while ($row = $query->fetch()){
				$pedido['order_id'] = $row->getOrderId();
				$pedido['numero_pedido'] = $row->getOrderTrackingNumber();
		
				$floor = $sector = '';
				if($row->getOrderFloor() != null || $row->getOrderFloor() != 0){
						
					$query3 = $con->prepare('SELECT event_floor 
							FROM `event_floor`
							WHERE event_floor_id = ?');
					$query3->execute(array($row->getOrderFloor()));
					$query3->setFetchMode(PDO::FETCH_CLASS, 'EventFloor');
					$row3 = $query3->fetch();
					$pedido['floor'] = $row3->getEventFloor();
					$pedido['floor_id'] = $row->getOrderFloor();
				} else{
					$pedido['floor'] = '';
				}
				
		
				if($row->getOrderSector() != null || $row->getOrderSector() != 0){
		
					$query4 = $con->prepare('SELECT event_sector
							FROM `event_sector`
							WHERE event_sector_id = ?');
					$query4->execute(array($row->getOrderSector()));
					$query4->setFetchMode(PDO::FETCH_CLASS, 'EventSector');
					$row4 = $query4->fetch();
					$pedido['sector'] = $row4->getEventSector();
					$pedido['sector_id'] = $row->getOrderSector();
				}else{
					$pedido['sector'] = '';
				}
		
				$pedido['chair'] = $row->getOrderChair();
		
				$query2 = $con->prepare('SELECT i.item_quantity,p.product_name
						FROM item as i INNER JOIN product as p ON i.item_product_id = p.product_id
						WHERE item_order_id = ?');
				$query2->execute(array($row->getOrderId()));
				$query2->setFetchMode(PDO::FETCH_CLASS, 'Item');
		
				$produtos = array();
				while ($row2 = $query2->fetch()){
					$produto = array();
					$produto['name'] = $row2->getProductName();
					$produto['qtd'] = $row2->getItemQuantity();
					$produtos[] = $produto;
				}
				$pedido['produtos'] = $produtos;
				$pedido['total'] = $row->getOrderPriceTotal();
				$pedido['order_status_id'] = $row->getOrderStatusId();
				$pedidos[] = $pedido;
			}
		}
		return $pedidos;
	}
	
	public function consultaStatus(array $orders){
		include('../conexao.php');
		
		$orders = implode(",", $orders);
		
		$query = $con->prepare('SELECT o.order_id, o.order_status_id
				FROM `order` as o WHERE o.order_id IN ('.$orders.') ORDER BY o.order_id');
		$query->execute();
		$row = $query->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
}