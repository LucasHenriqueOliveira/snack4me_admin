<?php

class Product{
	private $product_id;
	private $product_number;
	private $product_name_pt;
	private $product_name_en;
	private $product_name_es;
	private $product_image;
	private $product_price;
	private $product_desc_pt;
	private $product_desc_en;
	private $product_desc_es;
	private $product_hour_initial;
	private $product_hour_final;
	private $product_event_id;
	private $product_concession_id;
	private $product_inventory_qtd;
	private $product_inventory_current;
	private $product_inventory_maximum;
	private $product_inventory_minimum;
	private $product_category_id;
	private $product_complement;
	private $category_name_pt;
	private $category_name_en;
	private $category_name_es;
	
	// PRODUCT ID
	public function getProductId() {
		return $this->product_id;
	}
	
	public function setProductId($product_id) {
		$this->product_id = $product_id;
		return $this;
	}

	// PRODUCT NUMBER
	public function getProductNumber() {
		return $this->product_number;
	}
	
	public function setProductNumber($product_number) {
		$this->product_number = $product_number;
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
	
	// PRODUCT IMAGE
	public function getProductImage() {
		return $this->product_image;
	}
	
	public function setProductImage($product_image) {
		$this->product_image = $product_image;
		return $this;
	}
	
	// PRODUCT PRICE
	public function getProductPrice() {
		return $this->product_price;
	}
	
	public function setProductPrice($product_price) {
		$this->product_price = $product_price;
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

  // PRODUCT HOUR INITIAL
  public function getProductHourInitial() {
    return $this->product_hour_initial;
  }

  public function setProductHourInitial($product_hour_initial) {
    $this->product_hour_initial = $product_hour_initial;
    return $this;
  }

  // PRODUCT HOUR FINAL
  public function getProductHourFinal() {
    return $this->product_hour_final;
  }

  public function setProductHourFinal($product_hour_final) {
    $this->product_hour_final = $product_hour_final;
    return $this;
  }
	
	// PRODUCT EVENT ID
	public function getProductEventId() {
		return $this->product_event_id;
	}
	
	public function setProductEventId($product_event_id) {
		$this->product_event_id = $product_event_id;
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
	
	// PRODUCT INVENTORY QTD
	public function getProductInventoryQtd() {
		return $this->product_inventory_qtd;
	}
	
	public function setProductInventoryQtd($product_inventory_qtd) {
		$this->product_inventory_qtd = $product_inventory_qtd;
		return $this;
	}
	
	// PRODUCT INVENTORY CURRENT
	public function getProductInventoryCurrent() {
		return $this->product_inventory_current;
	}
	
	public function setProductInventoryCurrent($product_inventory_current) {
		$this->product_inventory_current = $product_inventory_current;
		return $this;
	}
	
	// PRODUCT INVENTORY MAXIMUM
	public function getProductInventoryMaximum() {
		return $this->product_inventory_maximum;
	}
	
	public function setProductInventoryMaximum($product_inventory_maximum) {
		$this->product_inventory_maximum = $product_inventory_maximum;
		return $this;
	}
	
	// PRODUCT INVENTORY MINIMUM
	public function getProductInventoryMinimum() {
		return $this->product_inventory_minimum;
	}
	
	public function setProductInventoryMinimum($product_inventory_minimum) {
		$this->product_inventory_minimum = $product_inventory_minimum;
		return $this;
	}

	// PRODUCT CATEGORY ID
  	public function getProductCategoryId() {
  		return $this->product_category_id;
  	}

  	public function setProductCategoryId($product_category_id) {
  		$this->product_category_id = $product_category_id;
  		return $this;
  	}

  // PRODUCT COMPLEMENT
  public function getProductComplement() {
    return $this->product_complement;
  }

  public function setProductComplement($product_complement) {
    $this->product_complement = $product_complement;
    return $this;
  }

	// PRODUCT CATEGORY NAME PT
  public function getCategoryNamePT() {
    return $this->category_name_pt;
  }

  public function setCategoryNamePT($category_name_pt) {
    $this->category_name_pt = $category_name_pt;
    return $this;
  }

  // PRODUCT CATEGORY NAME EN
  public function getCategoryNameEN() {
    return $this->category_name_en;
  }

  public function setCategoryNameEN($category_name_en) {
    $this->category_name_en = $category_name_en;
    return $this;
  }

  // PRODUCT CATEGORY NAME ES
  public function getCategoryNameES() {
    return $this->category_name_es;
  }

  public function setCategoryNameES($category_name_es) {
    $this->category_name_es = $category_name_es;
    return $this;
  }

}