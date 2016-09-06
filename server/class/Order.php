<?php

class Order{
	private $order_id;
	private $order_customer_id;
	private $order_customer_email;
	private $order_tracking_number;
	private $order_date;
	private $order_floor;
	private $order_apartment;
	private $order_local_order_id;
	private $order_price;
	private $order_price_discount;
	private $order_tip;
	private $order_tax_service;
	private $order_price_total;
	private $order_event_id;
	private $order_schedule_date;
	private $order_schedule;
	private $event_name;
	private $event_date;
	private $order_status_id;
	private $status_name_pt;
	private $status_name_en;
	private $status_name_es;
	private $order_delivery_date;
	private $order_user_id_delivery;
	
	// ORDER ID
	public function getOrderId() {
		return $this->order_id;
	}
	
	public function setOrderId($order_id) {
		$this->order_id = $order_id;
		return $this;
	}
	
	// ORDER CUSTOMER ID
	public function getOrderCustomerId() {
		return $this->order_customer_id;
	}
	
	public function setOrderCustomerId($order_customer_id) {
		$this->order_customer_id = $order_customer_id;
		return $this;
	}
	
	// ORDER CUSTOMER EMAIL
	public function getOrderCustomerEmail() {
		return $this->order_customer_email;
	}
	
	public function setOrderCustomerEmail($order_customer_email) {
		$this->order_customer_email = $order_customer_email;
		return $this;
	}
	
	// ORDER TRACKING NUMBER
	public function getOrderTrackingNumber() {
		return $this->order_tracking_number;
	}
	
	public function setOrderTrackingNumber($order_tracking_number) {
		$this->order_tracking_number = $order_tracking_number;
		return $this;
	}
	
	// ORDER DATE
	public function getOrderDate() {
		return $this->order_date;
	}
	
	public function setOrderDate($order_date) {
		$this->order_date = $order_date;
		return $this;
	}
	
	// ORDER FLOOR
	public function getOrderFloor() {
		return $this->order_floor;
	}
	
	public function setOrderFloor($order_floor) {
		$this->order_floor = $order_floor;
		return $this;
	}
	
	// ORDER APARTMENT
	public function getOrderApartment() {
		return $this->order_apartment;
	}
	
	public function setOrderApartment($order_apartment) {
		$this->order_apartment = $order_apartment;
		return $this;
	}

	// ORDER LOCAL ORDER ID
  public function getOrderLocalOrderId() {
    return $this->order_local_order_id;
  }

  public function setOrderLocalOrderId($order_local_order_id) {
    $this->order_local_order_id = $order_local_order_id;
    return $this;
  }
	
	// ORDER PRICE
	public function getOrderPrice() {
		return $this->order_price;
	}
	
	public function setOrderPrice($order_price) {
		$this->order_price = $order_price;
		return $this;
	}
	
	// ORDER PRICE DISCOUNT
	public function getOrderPriceDiscount() {
		return $this->order_price_discount;
	}
	
	public function setOrderPriceDiscount($order_price_discount) {
		$this->order_price_discount = $order_price_discount;
		return $this;
	}
	
	// ORDER TIP
	public function getOrderTip() {
		return $this->order_tip;
	}
	
	public function setOrderTip($order_tip) {
		$this->order_tip = $order_tip;
		return $this;
	}
	
	// ORDER TAX SERVICE
	public function getOrderTaxService() {
		return $this->order_tax_service;
	}
	
	public function setOrderTaxService($order_tax_service) {
		$this->order_tax_service = $order_tax_service;
		return $this;
	}
	
	// ORDER PRICE TOTAL
	public function getOrderPriceTotal() {
		return $this->order_price_total;
	}
	
	public function setOrderPriceTotal($order_price_total) {
		$this->order_price_total = $order_price_total;
		return $this;
	}
	
	// ORDER EVENT ID
	public function getOrderEventId() {
		return $this->order_event_id;
	}
	
	public function setOrderEventId($order_event_id) {
		$this->order_event_id = $order_event_id;
		return $this;
	}
	
	// ORDER SCHEDULE DATE
	public function getOrderScheduleDate() {
		return $this->order_schedule_date;
	}
	
	public function setOrderScheduleDate($order_schedule_date) {
		$this->order_schedule_date = $order_schedule_date;
		return $this;
	}

  // ORDER SCHEDULE
  public function getOrderSchedule() {
    return $this->order_schedule;
  }

  public function setOrderSchedule($order_schedule) {
    $this->order_schedule = $order_schedule;
    return $this;
  }
	
	// EVENT NAME
	public function getEventName() {
		return $this->event_name;
	}
	
	public function setEventName($event_name) {
		$this->event_name = $event_name;
		return $this;
	}
	
	// EVENT DATE
	public function getEventDate() {
		return $this->event_date;
	}
	
	public function setEventDate($event_date) {
		$this->event_date = $event_date;
		return $this;
	}
	
	// ORDER STATUS ID
	public function getOrderStatusId() {
		return $this->order_status_id;
	}
	
	public function setOrderStatusId($order_status_id) {
		$this->order_status_id = $order_status_id;
		return $this;
	}
	
	// STATUS NAME PT
	public function getStatusNamePT() {
		return $this->status_name_pt;
	}
	
	public function setStatusNamePT($status_name_pt) {
		$this->status_name_pt = $status_name_pt;
		return $this;
	}

	// STATUS NAME EN
  public function getStatusNameEN() {
    return $this->status_name_en;
  }

  public function setStatusNameEN($status_name_en) {
    $this->status_name_en = $status_name_en;
    return $this;
  }

  // STATUS NAME ES
  public function getStatusNameES() {
    return $this->status_name_es;
  }

  public function setStatusNameES($status_name_es) {
    $this->status_name_es = $status_name_es;
    return $this;
  }
	
	// ORDER DELIVERY DATE
	public function getOrderDeliveryDate() {
		return $this->order_delivery_date;
	}
	
	public function setOrderDeliveryDate($order_delivery_date) {
		$this->order_delivery_date = $order_delivery_date;
		return $this;
	}

  // ORDER USER ID DELIVERY
  public function getOrderUserIdDelivery() {
    return $this->order_user_id_delivery;
  }

  public function setOrderUserIdDelivery($order_user_id_delivery) {
    $this->order_user_id_delivery = $order_user_id_delivery;
    return $this;
  }

}