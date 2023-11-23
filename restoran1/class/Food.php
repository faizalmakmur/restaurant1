<?php
class Food {	
   
	private $foodItemsTable = 'data_menu';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->conn->prepare("SELECT id_menu, menu_name, description, price, image_name, available FROM ".$this->foodItemsTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	
}
?>