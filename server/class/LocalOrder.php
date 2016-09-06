<?php

class LocalOrder{
	private $local_order_id;
	private $local_order_name_pt;
	private $local_order_name_en;
	private $local_order_name_es;

	
	// LOCAL ORDER ID
	public function getLocalOrderId() {
		return $this->local_order_id;
	}
	
	public function setLocalOrderId($local_order_id) {
		$this->local_order_id = $local_order_id;
		return $this;
	}
	
	// LOCAL ORDER NAME PT
	public function getLocalOrderNamePT() {
		return $this->local_order_name_pt;
	}
	
	public function setLocalOrderNamePT($local_order_name_pt) {
		$this->local_order_name_pt = $local_order_name_pt;
		return $this;
	}
	
	// LOCAL ORDER NAME EN
	public function getLocalOrderNameEN() {
		return $this->local_order_name_en;
	}
	
	public function setLocalOrderNameEN($local_order_name_en) {
		$this->local_order_name_en = $local_order_name_en;
		return $this;
	}

	// LOCAL ORDER NAME ES
	public function getLocalOrderNameES() {
		return $this->local_order_name_es;
	}
	
	public function setLocalOrderNameES($local_order_name_es) {
		$this->local_order_name_es = $local_order_name_es;
		return $this;
	}

}