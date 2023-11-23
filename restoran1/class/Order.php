<?php
class Order {	
   
	private $ordersTable = 'data_pesan';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function insert(){		
		if($this->menu_name) {
			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->ordersTable."(`id_menu`, `menu_name`, `price`, `quantity`, `order_date`, `order_id`)
			VALUES(?,?,?,?,?,?)");		
			$this->id_menu = htmlspecialchars(strip_tags($this->id_menu));
			$this->menu_name = htmlspecialchars(strip_tags($this->menu_name));
			$this->price = htmlspecialchars(strip_tags($this->price));
			$this->quantity = htmlspecialchars(strip_tags($this->quantity));
			$this->order_date = htmlspecialchars(strip_tags($this->order_date));
			$this->order_id = htmlspecialchars(strip_tags($this->order_id));			
			$stmt->bind_param("isiiss", $this->id_menu, $this->menu_name, $this->price, $this->quantity, $this->order_date, $this->order_id);			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
}
?>