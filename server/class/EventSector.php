<?php

class EventSector{
	private $event_sector_id;
	private $event_id;
	private $event_sector;
	private $event_sector_floor_id;
	
	// EVENT Sector ID
	public function getEventSectorId() {
		return $this->event_sector_id;
	}
	
	public function setEventSectorId($event_sector_id) {
		$this->event_sector_id = $event_sector_id;
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
	
	// SECTOR
	public function getEventSector() {
		return $this->event_sector;
	}
	
	public function setEventSector($event_sector) {
		$this->event_sector = $event_sector;
		return $this;
	}
	
	// SECTOR FLOOR ID
	public function getEventSectorFloorId() {
		return $this->event_sector_floor_id;
	}
	
	public function setEventSectorFloorId($event_sector_floor_id) {
		$this->event_sector_floor_id = $event_sector_floor_id;
		return $this;
	}
}