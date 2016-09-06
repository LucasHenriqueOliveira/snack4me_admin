<?php

class Sport{
	private $sport_id;
	private $sport_name;
	
	// SPORT ID
	public function getSportId() {
		return $this->sport_id;
	}
	
	public function setSportId($sport_id) {
		$this->sport_id = $sport_id;
		return $this;
	}
	
	// SPORT NAME
	public function getSportName() {
		return $this->sport_name;
	}
	
	public function setSportName($sport_name) {
		$this->sport_name = $sport_name;
		return $this;
	}
}