<?php

class Item{
	private $item_id;
	private $item_order_id;
	private $item_product_id;
	private $item_price_unit;
	private $item_quantity;
	private $item_price_total;
	private $product_image;
	private $product_name_pt;
	private $product_name_en;
	private $product_name_es;
	private $product_desc_pt;
	private $product_desc_en;
	private $product_desc_es;
	private $product_fast;
	private $product_concession_id;
	
	// ITEM ID
	public function getItemId() {
		return $this->item_id;
	}
	
	public function setItemId($item_id) {
		$this->item_id = $item_id;
		return $this;
	}
	
	// ITEM ORDER ID
	public function getItemOrderId() {
		return $this->item_order_id;
	}
	
	public function setItemOrderId($item_order_id) {
		$this->item_order_id = $item_order_id;
		return $this;
	}
	
	// ITEM PRODUCT ID
	public function getItemProductId() {
		return $this->item_product_id;
	}
	
	public function setItemProductId($item_product_id) {
		$this->item_product_id = $item_product_id;
		return $this;
	}
	
	// ITEM PRICE UNIT
	public function getItemPriceUnit() {
		return $this->item_price_unit;
	}
	
	public function setItemPriceUnit($item_price_unit) {
		$this->item_price_unit = $item_price_unit;
		return $this;
	}
	
	// ITEM QUANTITY
	public function getItemQuantity() {
		return $this->item_quantity;
	}
	
	public function setItemQuantity($item_quantity) {
		$this->item_quantity = $item_quantity;
		return $this;
	}
	
	// ITEM PRICE TOTAL
	public function getItemPriceTotal() {
		return $this->item_price_total;
	}
	
	public function setItemPriceTotal($item_price_total) {
		$this->item_price_total = $item_price_total;
		return $this;
	}

  // PRODUCT IMAGE
  public function getProductImage() {
    return $this->product_image;
  }

  public function setProductImage($product_image) {
    $this->product_image = $product_image;
    return $this;
  }
	
	// PRODUCT NAME PT
	public function getProductNamePT() {
		return $this->product_name_pt;
	}
	
	public function setProductNamePT($product_name_pt) {
		$this->product_name_pt = $product_name_pt;
		return $this;
	}

	// PRODUCT NAME EN
	public function getProductNameEN() {
		return $this->product_name_en;
	}
	
	public function setProductNameEN($product_name_en) {
		$this->product_name_en = $product_name_en;
		return $this;
	}

	// PRODUCT NAME ES
	public function getProductNameES() {
		return $this->product_name_es;
	}
	
	public function setProductNameES($product_name_es) {
		$this->product_name_es = $product_name_es;
		return $this;
	}
	
	// PRODUCT DESC PT
	public function getProductDescPT() {
		return $this->product_desc_pt;
	}
	
	public function setProductDescPT($product_desc_pt) {
		$this->product_desc_pt = $product_desc_pt;
		return $this;
	}

	// PRODUCT DESC EN
	public function getProductDescEN() {
		return $this->product_desc_en;
	}
	
	public function setProductDescEN($product_desc_en) {
		$this->product_desc_en = $product_desc_en;
		return $this;
	}

	// PRODUCT DESC ES
	public function getProductDescES() {
		return $this->product_desc_es;
	}
	
	public function setProductDescES($product_desc_es) {
		$this->product_desc_es = $product_desc_es;
		return $this;
	}

  // PRODUCT FAST
  public function getProductFast() {
    return $this->product_fast;
  }

  public function setProductFast($product_fast) {
    $this->product_fast = $product_fast;
    return $this;
  }
	
	// PRODUCT CONCESSION ID
	public function getProductConcessionId() {
		return $this->product_concession_id;
	}
	
	public function setProductConcessionId($product_concession_id) {
		$this->product_concession_id = $product_concession_id;
		return $this;
	}

}