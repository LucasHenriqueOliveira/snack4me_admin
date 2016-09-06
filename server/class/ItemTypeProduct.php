<?php

class ItemTypeProduct{
	private $item_type_product_id;
	private $item_type_product_product_id;
	private $item_type_product_type_product_id;
	private $item_type_product_desc;
	private $item_type_product_item_id;

	// ITEM TYPE PRODUCT ID
	public function getItemTypeProductId() {
		return $this->item_type_product_id;
	}

	public function setItemTypeProductId($item_type_product_id) {
		$this->item_type_product_id = $item_type_product_id;
		return $this;
	}

	// ITEM TYPE PRODUCT PRODUCT ID
	public function getItemTypeProductProductId() {
		return $this->item_type_product_product_id;
	}

	public function setItemTypeProductProductId($item_type_product_product_id) {
		$this->item_type_product_product_id = $item_type_product_product_id;
		return $this;
	}

	// ITEM TYPE PRODUCT TYPE PRODUCT ID
  public function getItemTypeProductTypeProductId() {
    return $this->item_type_product_product_id;
  }

  public function setItemTypeProductTypeProductId($item_type_product_type_product_id) {
    $this->item_type_product_type_product_id = $item_type_product_type_product_id;
    return $this;
  }

	// ITEM TYPE PRODUCT DESC
  public function getItemTypeProductDesc() {
    return $this->item_type_product_id;
  }

  public function setItemTypeProductDesc($item_type_product_id) {
    $this->item_type_product_id = $item_type_product_id;
    return $this;
  }

  // ITEM TYPE PRODUCT ITEM ID
  public function getItemTypeProductItemId() {
    return $this->item_type_product_item_id;
  }

  public function setItemTypeProductItemId($item_type_product_item_id) {
    $this->item_type_product_item_id = $item_type_product_item_id;
    return $this;
  }

}