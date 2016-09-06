<?php

class Coupon{
	private $coupon_id;
	private $coupon_number;
	private $coupon_tax;
	private $coupon_sin_used;
	private $coupon_event_id;
	
	// ID
	public function getCouponId() {
		return $this->coupon_id;
	}
	
	public function setCouponId($coupon_id) {
		$this->coupon_id = $coupon_id;
		return $this;
	}
	
	// NUMBER
	public function getCouponNumber() {
		return $this->coupon_number;
	}
	
	public function setCouponNumber($coupon_number) {
		$this->coupon_number = $coupon_number;
		return $this;
	}
	
	// TAX
	public function getCouponTax() {
		return $this->coupon_tax;
	}
	
	public function setCouponTax($coupon_tax) {
		$this->coupon_tax = $coupon_tax;
		return $this;
	}
	
	// COUPON SIN USED
	public function getCouponSinUsed() {
		return $this->coupon_sin_used;
	}
	
	public function setCouponSinUsed($coupon_sin_used) {
		$this->coupon_sin_used = $coupon_sin_used;
		return $this;
	}
	
	// COUPON EVENT ID
	public function getCouponEventId() {
		return $this->coupon_event_id;
	}
	
	public function setCouponEventId($coupon_event_id) {
		$this->coupon_event_id = $coupon_event_id;
		return $this;
	}
	
}