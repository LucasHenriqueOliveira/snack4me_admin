<?php

class Customer{
	private $customer_id;
	private $customer_name;
	private $customer_email;
	private $customer_password;
	private $customer_registration_date;
	private $customer_sin_valid;
	private $customer_type;
	private $customer_update_password;
	private $customer_device_id;
	private $customer_token;
	
	// ID
	public function getCustomerId() {
		return $this->customer_id;
	}
	
	public function setCustomerId($customer_id) {
		$this->customer_id = $customer_id;
		return $this;
	}
	
	// NAME
	public function getCustomerName() {
		return $this->customer_name;
	}
	
	public function setCustomerName($customer_name) {
		$this->customer_name = $customer_name;
		return $this;
	}
	
	// EMAIL
	public function getCustomerEmail() {
		return $this->customer_email;
	}
	
	public function setCustomerEmail($customer_email) {
		$this->customer_email = $customer_email;
		return $this;
	}
	
	// PASSWORD
	public function getCustomerPassword() {
		return $this->customer_password;
	}
	
	public function setCustomerPassword($customer_password) {
		$this->customer_password = $customer_password;
		return $this;
	}
	
	// REGISTRATION DATE
	public function getCustomerRegistrationDate() {
		return $this->customer_registration_date;
	}
	
	public function setCustomerRegistrationDate($customer_registration_date) {
		$this->customer_registration_date = $customer_registration_date;
		return $this;
	}
	
	// SIN VALID
	public function getCustomerSinValid() {
		return $this->customer_sin_valid;
	}
	
	public function setCustomerSinValid($customer_sin_valid) {
		$this->customer_sin_valid = $customer_sin_valid;
		return $this;
	}
	
	// TYPE
	public function getCustomerType() {
		return $this->customer_type;
	}
	
	public function setCustomerType($customer_type) {
		$this->customer_type = $customer_type;
		return $this;
	}
	
	// UPDATE PASSWORD
	public function getCustomerUpdatePassword() {
		return $this->customer_update_password;
	}
	
	public function setCustomerUpdatePassword($customer_update_password) {
		$this->customer_update_password = $customer_update_password;
		return $this;
	}
	
	// DEVICE ID
	public function getCustomerDeviceId() {
		return $this->customer_device_id;
	}
	
	public function setCustomerDeviceId($customer_device_id) {
		$this->customer_device_id = $customer_device_id;
		return $this;
	}
	
	// TOKEN
	public function getCustomerToken() {
		return $this->customer_token;
	}
	
	public function setCustomerToken($customer_token) {
		$this->customer_token = $customer_token;
		return $this;
	}
}