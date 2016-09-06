<?php

class EventConfiguration{
	private $event_configuration_id;
	private $event_id;
	private $event_name;
	private $event_configuration_sector;
	private $event_configuration_row;
	private $event_configuration_chair;
	private $event_configuration_table;
	private $event_configuration_floor;
	private $event_configuration_room;
	private $event_configuration_block;
	private $event_configuration_concession;
	
	// EVENT CONFIGURATION ID
	public function getEventConfigurationId() {
		return $this->event_configuration_id;
	}
	
	public function setEventConfigurationId($event_configuration_id) {
		$this->event_configuration_id = $event_configuration_id;
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
	
	// EVENT NAME
	public function getEventName() {
		return $this->event_name;
	}
	
	public function setEventName($event_name) {
		$this->event_name = $event_name;
		return $this;
	}
	
	// CONFIGURATION SECTOR
	public function getEventConfigurationSector() {
		return $this->event_configuration_sector;
	}
	
	public function setEventConfigurationSector($event_configuration_sector) {
		$this->event_configuration_sector = $event_configuration_sector;
		return $this;
	}
	
	// CONFIGURATION ROW
	public function getEventConfigurationRow() {
		return $this->event_configuration_row;
	}
	
	public function setEventConfigurationRow($event_configuration_row) {
		$this->event_configuration_row = $event_configuration_row;
		return $this;
	}
	
	// CONFIGURATION CHAIR
	public function getEventConfigurationChair() {
		return $this->event_configuration_chair;
	}
	
	public function setEventConfigurationChair($event_configuration_chair) {
		$this->event_configuration_chair = $event_configuration_chair;
		return $this;
	}
	
	// CONFIGURATION TABLE
	public function getEventConfigurationTable() {
		return $this->event_configuration_table;
	}
	
	public function setEventConfigurationTable($event_configuration_table) {
		$this->event_configuration_table = $event_configuration_table;
		return $this;
	}
	
	// CONFIGURATION FLOOR
	public function getEventConfigurationFloor() {
		return $this->event_configuration_floor;
	}
	
	public function setEventConfigurationFloor($event_configuration_floor) {
		$this->event_configuration_floor = $event_configuration_floor;
		return $this;
	}
	
	// CONFIGURATION ROOM
	public function getEventConfigurationRoom() {
		return $this->event_configuration_room;
	}
	
	public function setEventConfigurationRoom($event_configuration_room) {
		$this->event_configuration_room = $event_configuration_room;
		return $this;
	}
	
	// CONFIGURATION BLOCK
	public function getEventConfigurationBlock() {
		return $this->event_configuration_block;
	}
	
	public function setEventConfigurationBlock($event_configuration_block) {
		$this->event_configuration_block = $event_configuration_block;
		return $this;
	}
	
	// CONFIGURATION CONCESSION
	public function getEventConfigurationConcession() {
		return $this->event_configuration_concession;
	}
	
	public function setEventConfigurationConcession($event_configuration_concession) {
		$this->event_configuration_concession = $event_configuration_concession;
		return $this;
	}
}