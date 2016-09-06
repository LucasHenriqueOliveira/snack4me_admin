<?php

class Concession{
	private $concession_id;
	private $concession_event_id;
	private $concession_name;
	private $concession_image;
	
	// CONCESSION ID
	public function getConcessionId() {
		return $this->concession_id;
	}
	
	public function setConcessionId($concession_id) {
		$this->concession_id = $concession_id;
		return $this;
	}
	
	// CONCESSION EVENT ID
	public function getConcessionEventId() {
		return $this->concession_event_id;
	}
	
	public function setConcessionEventId($concession_event_id) {
		$this->concession_event_id = $concession_event_id;
		return $this;
	}
	
	// CONCESSION NAME
	public function getConcessionName() {
		return $this->concession_name;
	}
	
	public function setConcessionName($concession_name) {
		$this->concession_name = $concession_name;
		return $this;
	}
	
	// CONCESSION IMAGE
	public function getConcessionImage() {
		return $this->concession_image;
	}
	
	public function setConcessionImage($concession_image) {
		$this->concession_image = $concession_image;
		return $this;
	}
}