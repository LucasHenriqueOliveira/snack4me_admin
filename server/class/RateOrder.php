<?php

class RateOrder{
	private $rate_order_id;
	private $order_id;
	private $rate_order_question_1;
	private $rate_order_question_2;
	private $rate_order_question_3;
	private $rate_order_desc;
	
	// RATE ORDER ID
	public function getRateOrderId() {
		return $this->rate_order_id;
	}
	
	public function setRateOrderId($rate_order_id) {
		$this->rate_order_id = $rate_order_id;
		return $this;
	}

	// ORDER ID
	public function getOrderId() {
		return $this->order_id;
	}
	
	public function setOrderId($order_id) {
		$this->order_id = $order_id;
		return $this;
	}
	
	// RATE ORDER QUESTION 1
	public function getRateOrderQuestion1() {
		return $this->rate_order_question_1;
	}
	
	public function setRateOrderQuestion1($rate_order_question_1) {
		$this->rate_order_question_1 = $rate_order_question_1;
		return $this;
	}

	// RATE ORDER QUESTION 2
	public function getRateOrderQuestion2() {
		return $this->rate_order_question_2;
	}
	
	public function setRateOrderQuestion2($rate_order_question_2) {
		$this->rate_order_question_2 = $rate_order_question_2;
		return $this;
	}

	// RATE ORDER QUESTION 3
	public function getRateOrderQuestion3() {
		return $this->rate_order_question_3;
	}
	
	public function setRateOrderQuestion3($rate_order_question_3) {
		$this->rate_order_question_3 = $rate_order_question_3;
		return $this;
	}

        // RATE ORDER DESC
	public function getRateOrderDesc() {
		return $this->rate_order_desc;
	}
	
	public function setRateOrderDesc($rate_order_desc) {
		$this->rate_order_desc = $rate_order_desc;
		return $this;
	}
}