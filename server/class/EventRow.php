<?php

class EventRow{
	private $event_row_id;
	private $event_id;
	private $event_row;
	private $event_row_sector_id;
	private $event_row_floor_id;	
	
	// EVENT ROW ID
	public function getEventRowId() {
		return $this->event_row_id;
	}
	
	public function setEventRowId($event_row_id) {
		$this->event_row_id = $event_row_id;
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
	
	// ROW
	public function getEventRow() {
		return $this->event_row;
	}
	
	public function setEventRow($event_row) {
		$this->event_row = $event_row;
		return $this;
	}
	
	// ROW SECTOR ID
	public function getEventRowSectorId() {
		return $this->event_row_sector_id;
	}
	
	public function setEventRowSectorId($event_row_sector_id) {
		$this->event_row_sector_id = $event_row_sector_id;
		return $this;
	}
	
	// ROW FLOOR ID
	public function getEventRowFloorId() {
		return $this->event_row_floor_id;
	}
	
	public function setEventRowFloorId($event_row_floor_id) {
		$this->event_row_floor_id = $event_row_floor_id;
		return $this;
	}
}