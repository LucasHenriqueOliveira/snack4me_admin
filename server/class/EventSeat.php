<?php

class EventSeat{
	private $event_seat_id;
	private $event_id;
	private $event_seat;
	private $event_seat_row_id;
	private $event_seat_sector_id;	
	
	// EVENT SEAT ID
	public function getEventSeatId() {
		return $this->event_seat_id;
	}
	
	public function setEventSeatId($event_seat_id) {
		$this->event_seat_id = $event_seat_id;
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
	
	// SEAT
	public function getEventSeat() {
		return $this->event_seat;
	}
	
	public function setEventSeat($event_seat) {
		$this->event_seat = $event_seat;
		return $this;
	}
	
	// SEAT ROW ID
	public function getEventSeatRowId() {
		return $this->event_seat_row_id;
	}
	
	public function setEventSeatRowId($event_seat_row_id) {
		$this->event_seat_row_id = $event_seat_row_id;
		return $this;
	}
	
	// SEAT SECTOR ID
	public function getEventSeatSectorId() {
		return $this->event_seat_sector_id;
	}
	
	public function setEventSeatSectorId($event_seat_sector_id) {
		$this->event_seat_sector_id = $event_seat_sector_id;
		return $this;
	}
}