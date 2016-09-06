<?php

class User{
	private $user_id;
	private $user_name;
	private $profile_id;
	private $profile_name;
	private $user_login_default;
	private $user_password;
	private $user_device_id;
	private $user_token;
	
	// USER ID
	public function getUserId() {
		return $this->user_id;
	}
	
	public function setUserId($user_id) {
		$this->user_id = $user_id;
		return $this;
	}
	
	// USER ID
	public function getUserName() {
		return $this->user_name;
	}
	
	public function setUserName($user_name) {
		$this->user_name = $user_name;
		return $this;
	}
	
	// PROFILE ID
	public function getProfileId() {
		return $this->profile_id;
	}
	
	public function setProfileId($profile_id) {
		$this->profile_id = $profile_id;
		return $this;
	}
	
	// PROFILE NAME
	public function getProfileName() {
		return $this->profile_name;
	}
	
	public function setProfileName($profile_name) {
		$this->profile_name = $profile_name;
		return $this;
	}

	// USER LOGIN DEFAULT
  public function getUserLoginDefault() {
    return $this->user_login_default;
  }

  public function setUserLoginDefault($user_login_default) {
    $this->user_login_default = $user_login_default;
    return $this;
  }
	
	// USER PASSWORD
	public function getUserPassword() {
		return $this->user_password;
	}
	
	public function setUserPassword($user_password) {
		$this->user_password = $user_password;
		return $this;
	}
	
	// DEVICE ID
	public function getUserDeviceId() {
		return $this->user_device_id;
	}
	
	public function setUserDeviceId($user_device_id) {
		$this->user_device_id = $user_device_id;
		return $this;
	}
	
	// TOKEN
	public function getUserToken() {
		return $this->customer_token;
	}
	
	public function setUserToken($user_token) {
		$this->user_token = $user_token;
		return $this;
	}

}