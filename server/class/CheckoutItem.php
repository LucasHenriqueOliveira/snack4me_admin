<?php

class CheckoutItem{
	private $checkout_item_id;
	private $checkout_item_checkout_id;
	private $checkout_item_product_id;
	private $checkout_item_price_unit;
	private $checkout_item_quantity;
	private $checkout_item_price_total;
	
	// CHECKOUT ITEM ID
	public function getCheckoutItemId() {
		return $this->checkout_item_id;
	}
	
	public function setCheckoutItemId($checkout_item_id) {
		$this->checkout_item_id = $checkout_item_id;
		return $this;
	}
	
	// CHECKOUT ITEM ORDER ID
	public function getCheckoutItemCheckoutId() {
		return $this->checkout_item_checkout_id;
	}
	
	public function setCheckoutItemCheckoutId($checkout_item_checkout_id) {
		$this->checkout_item_checkout_id = $checkout_item_checkout_id;
		return $this;
	}
	
	// CHECKOUT ITEM PRODUCT ID
	public function getCheckoutItemProductId() {
		return $this->checkout_item_product_id;
	}
	
	public function setCheckoutItemProductId($checkout_item_product_id) {
		$this->checkout_item_product_id = $checkout_item_product_id;
		return $this;
	}
	
	// CHECKOUT ITEM PRICE UNIT
	public function getCheckoutItemPriceUnit() {
		return $this->checkout_item_price_unit;
	}
	
	public function setCheckoutItemPriceUnit($checkout_item_price_unit) {
		$this->checkout_item_price_unit = $checkout_item_price_unit;
		return $this;
	}
	
	// CHECKOUT ITEM QUANTITY
	public function getCheckoutItemQuantity() {
		return $this->checkout_item_quantity;
	}
	
	public function setCheckoutItemQuantity($checkout_item_quantity) {
		$this->checkout_item_quantity = $checkout_item_quantity;
		return $this;
	}
	
	// CHECKOUT ITEM PRICE TOTAL
	public function getCheckoutItemPriceTotal() {
		return $this->checkout_item_price_total;
	}
	
	public function setCheckoutItemPriceTotal($checkout_item_price_total) {
		$this->checkout_item_price_total = $checkout_item_price_total;
		return $this;
	}

}