<?php

class Checkout{
	private $checkout_id;
	private $checkout_customer_id;
	private $checkout_date;
	private $checkout_sector;
	private $checkout_floor;
	private $checkout_chair;
	private $checkout_table;
	private $checkout_price;
	private $checkout_price_discount;
	private $checkout_tip;
	private $checkout_price_total;
	private $checkout_coupon_id;
	private $checkout_event_id;
	private $checkout_sin_order;
	
	// CHECKOUT ID
	public function getCheckoutId() {
		return $this->checkout_id;
	}
	
	public function setCheckoutId($checkout_id) {
		$this->checkout_id = $checkout_id;
		return $this;
	}
	
	// CHECKOUT CUSTOMER ID
	public function getCheckoutCustomerId() {
		return $this->checkout_customer_id;
	}
	
	public function setCheckoutCustomerId($checkout_customer_id) {
		$this->checkout_customer_id = $checkout_customer_id;
		return $this;
	}
	
	// CHECKOUT DATE
	public function getCheckoutDate() {
		return $this->checkout_date;
	}
	
	public function setCheckoutDate($checkout_date) {
		$this->checkout_date = $checkout_date;
		return $this;
	}
	
	// CHECKOUT SECTOR
	public function getCheckoutSector() {
		return $this->checkout_sector;
	}
	
	public function setCheckoutSector($checkout_sector) {
		$this->checkout_sector = $checkout_sector;
		return $this;
	}
	
	// CHECKOUT FLOOR
	public function getCheckoutFloor() {
		return $this->checkout_floor;
	}
	
	public function setCheckoutFloor($checkout_floor) {
		$this->checkout_floor = $checkout_floor;
		return $this;
	}
	
	// CHECKOUT CHAIR
	public function getCheckoutChair() {
		return $this->checkout_chair;
	}
	
	public function setCheckoutChair($checkout_chair) {
		$this->checkout_chair = $checkout_chair;
		return $this;
	}
	
	// CHECKOUT TABLE
	public function getCheckoutTable() {
		return $this->checkout_table;
	}
	
	public function setCheckoutTable($checkout_table) {
		$this->checkout_table = $checkout_table;
		return $this;
	}
	
	// CHECKOUT PRICE
	public function getCheckoutPrice() {
		return $this->checkout_price;
	}
	
	public function setCheckoutPrice($checkout_price) {
		$this->checkout_price = $checkout_price;
		return $this;
	}
	
	// CHECKOUT PRICE DISCOUNT
	public function getCheckoutPriceDiscount() {
		return $this->checkout_price_discount;
	}
	
	public function setCheckoutPriceDiscount($checkout_price_discount) {
		$this->checkout_price_discount = $checkout_price_discount;
		return $this;
	}
	
	// CHECKOUT TIP
	public function getCheckoutTip() {
		return $this->checkout_tip;
	}
	
	public function setCheckoutTip($checkout_tip) {
		$this->checkout_tip = $checkout_tip;
		return $this;
	}
	
	// CHECKOUT PRICE TOTAL
	public function getCheckoutPriceTotal() {
		return $this->checkout_price_total;
	}
	
	public function setCheckoutPriceTotal($checkout_price_total) {
		$this->checkout_price_total = $checkout_price_total;
		return $this;
	}
	
	// CHECKOUT COUPON ID
	public function getCheckoutCouponId() {
		return $this->checkout_coupon_id;
	}
	
	public function setCheckoutCouponId($checkout_coupon_id) {
		$this->checkout_coupon_id = $checkout_coupon_id;
		return $this;
	}
	
	// CHECKOUT EVENT ID
	public function getCheckoutEventId() {
		return $this->checkout_event_id;
	}
	
	public function setCheckoutEventId($checkout_event_id) {
		$this->checkout_event_id = $checkout_event_id;
		return $this;
	}
	
	// CHECKOUT SIN ORDER
	public function getCheckoutSinOrder() {
		return $this->checkout_sin_order;
	}
	
	public function setCheckoutSinOrder($checkout_sin_order) {
		$this->checkout_sin_order = $checkout_sin_order;
		return $this;
	}

}