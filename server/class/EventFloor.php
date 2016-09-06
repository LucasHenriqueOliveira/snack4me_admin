<?php

class EventFloor{
	private $event_floor_id;
	private $event_id;
	private $event_floor;
	
	// EVENT FLOOR ID
	public function getEventFloorId() {
		return $this->event_floor_id;
	}
	
	public function setEventFloorId($event_floor_id) {
		$this->event_floor_id = $event_floor_id;
		return $this;
	}
	
	// EVENT ID
	public function getEventId() {
		return $this->event_id;
	}
	
	public function setEventId($event_id) {
		$this->event_id = $event_id;
		return $this;
	}
	
	// FLOOR
	public function getEventFloor() {
		return $this->event_floor;
	}
	
	public function setEventFloor($event_floor) {
		$this->event_floor = $event_floor;
		return $this;
	}
}