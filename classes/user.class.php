<?php
class user{
	
	private $DB;
	
	public function __construct($DB){
		if(!isset($_SESSION)){
			session_start();
		}
		if(!isset($_SESSION['user'])){
			$_SESSION['user'] = array();
		}
		$this->DB = $DB;
	}
	
	public function userConnected(){
		if (isset($_SESSION['user']['id'])){
			return true;
		} else {
			return false;
		}
	}
	
	public function setId($id){
		$_SESSION['user']['id'] = $id;
	}
	
	public function setPhone($phoneNumber){
		$_SESSION['user']['phoneNumber'] = $phoneNumber;
	}
	
	public function setName($name){
		$_SESSION['user']['name'] = $name;
	}
	
	public function setEmail($email){
		$_SESSION['user']['email'] = $email;
	}
	
	public function setFunction($function){
		$_SESSION['user']['function'] = $function;
	}
	
	public function getId(){
		return $_SESSION['user']['id'];
	}
	
	public function getPhone(){
		return $_SESSION['user']['phoneNumber'];
	}
	
	public function getName(){
		return $_SESSION['user']['name'];
	}
	
	public function getEmail(){
		return $_SESSION['user']['email'];
	}
	
	public function getFunction(){
		return $_SESSION['user']['function'];
	}
	
	public function signout(){
		unset($_SESSION['user']);
		unset($_SESSION['panier']);
	}
	
	// Remainig functions to be implemented
	// public function createUser
	// public function deleteUser
	// public function userFunction
	// public function userBalance
	// public function userOrdersHistory
	// public function userCurrentOrders
	// public function userSponsorshipCode
	// public function userPromoCodes
	// public function userComplaints
	
}


























