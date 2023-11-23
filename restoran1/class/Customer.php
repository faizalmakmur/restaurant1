<?php
class Customer {	
   
	private $customerTable = 'data_customer';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->username && $this->password) {
			$sqlQuery = "
				SELECT * FROM ".$this->customerTable." 
				WHERE username = ? AND password = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = ($this->password);
			$stmt->bind_param("ss", $this->username, $password);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["id_customer"] = $user['id_customer'];				
				$_SESSION["customer_name"] = $user['customer_name'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["id_customer"])) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function getCustomerName(){
		if($_SESSION["id_customer"]) {
			$stmt = $this->conn->prepare("
				SELECT * FROM ".$this->customerTable." 
				WHERE id_customer = '".$_SESSION["id_customer"]."'");				
			$stmt->execute();			
			$result = $stmt->get_result();		
			return $result;	
		}
	}
}
?>