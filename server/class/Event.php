<?php

class Event{
	private $event_id;
	private $event_name;
	private $event_image;
	private $event_tax_service;
	private $distance;
	private $event_city_id;
	private $city_name;
	
	// ID
	public function getEventId() {
		return $this->event_id;
	}
	
	public function setEventId($event_id) {
		$this->event_id = $event_id;
		return $this;
	}
	
	// NAME
	public function getEventName() {
		return $this->event_name;
	}
	
	public function setEventName($event_name) {
		$this->event_name = $event_name;
		return $this;
	}
	
	// IMAGE
	public function getEventImage() {
		return $this->event_image;
	}
	
	public function setEventImage($event_image) {
		$this->event_image = $event_image;
		return $this;
	}
	
	// EVENT TAX SERVICE
	public function getEventTaxService() {
		return $this->event_tax_service;
	}
	
	public function setEventTaxService($event_tax_service) {
		$this->event_tax_service = $event_tax_service;
		return $this;
	}
	
	// DISTANCE
	public function getDistance() {
		return number_format($this->distance,1);
	}
	
	public function setDistance($distance) {
		$this->distance = $distance;
		return $this;
	}
	
	// CITY ID
	public function getEventCityId() {
		return $this->event_city_id;
	}
	
	public function setEventCityId($event_city_id) {
		$this->event_city_id = $event_city_id;
		return $this;
	}
	
	// CITY NAME
	public function getCityName() {
		return $this->city_name;
	}
	
	public function setCityName($city_name) {
		$this->city_name = $city_name;
		return $this;
	}
}