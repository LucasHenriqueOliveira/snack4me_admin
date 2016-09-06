<?php

class TypeProduct{
	private $type_product_id;
	private $type_product_name_pt;
	private $type_product_name_en;
	private $type_product_name_es;
	private $type_product_product_id;
	private $item_type_product_desc;
	private $item_type_product_item_id;
	
	// TYPE PRODUCT ID
	public function getTypeProductId() {
		return $this->type_product_id;
	}
	
	public function setTypeProductId($type_product_id) {
		$this->type_product_id = $type_product_id;
		return $this;
	}

	// TYPE PRODUCT NAME PT
	public function getTypeProductNamePT() {
		return $this->type_product_name_pt;
	}
	
	public function setTypeProductNamePT($type_product_name_pt) {
		$this->type_product_name_pt = $type_product_name_pt;
		return $this;
	}

	// TYPE PRODUCT NAME EN
        public function getTypeProductNameEN() {
                return $this->type_product_name_en;
        }

        public function setTypeProductNameEN($type_product_name_en) {
                $this->type_product_name_en = $type_product_name_en;
                return $this;
        }

        // TYPE PRODUCT NAME ES
        public function getTypeProductNameES() {
                return $this->type_product_name_es;
        }

        public function setTypeProductNameES($type_product_name_es) {
                $this->type_product_name_es = $type_product_name_es;
                return $this;
        }
	
	// TYPE PRODUCT PRODUCT ID
	public function getTypeProductProductId() {
		return $this->type_product_product_id;
	}
	
	public function setTypeProductProductId($type_product_product_id) {
		$this->type_product_product_id = $type_product_product_id;
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