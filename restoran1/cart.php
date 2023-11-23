<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}

if(isset($_POST["add"])){
	if(isset($_SESSION["cart"])){
		$item_array_id = array_column($_SESSION["cart"], "id_menu");
		if(!in_array($_GET["id_menu"], $item_array_id)){
			$count = count($_SESSION["cart"]);
			$item_array = array(
				'id_menu' => $_GET["id_menu"],
				'menu_name' => $_POST["menu_name"],
				'price' => $_POST["price"],
				'id_menu' => $_POST["id_menu"],
				'quantity' => $_POST["quantity"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="cart.php"</script>';
		} else {					
			echo '<script>window.location="cart.php"</script>';
		}
	} else {
		$item_array = array(
			'id_menu' => $_GET["id_menu"],
			'menu_name' => $_POST["menu_name"],
			'price' => $_POST["price"],
			'id_menu' => $_POST["id_menu"],
			'quantity' => $_POST["quantity"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
}

if(isset($_GET["action"])){
	if($_GET["action"] == "delete"){
		foreach($_SESSION["cart"] as $keys => $values){
			if($values["id_menu"] == $_GET["id_menu"]){
				unset($_SESSION["cart"][$keys]);						
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

if(isset($_GET["action"])){
	if($_GET["action"] == "empty"){
		foreach($_SESSION["cart"] as $keys => $values){
			unset($_SESSION["cart"]);					
			echo '<script>window.location="cart.php"</script>';
		}
	}
}
		
include('inc/header.php');
?>
<title>Toben Cafe</title>
<?php include('inc/container.php');?>
<div class="content">
	<div class="container-fluid">		
		<div class='row'>		
		<?php include('top_menu.php'); ?> 
		</div>
		<div class='row'>		
		<?php
		if(!empty($_SESSION["cart"])){
		?>      
			<h3>Keranjang Anda</h3>    
			<table class="table table-striped">
			 <thead class="thead-dark">
			<tr>
			<th width="40%">Nama Menu</th>
			<th width="10%">Jumlah</th>
			<th width="20%">Detail Harga</th>
			<th width="15%">Order Total</th>
			<th width="5%">Action</th>
			</tr>
			</thead>
			<?php
			$total = 0;
			foreach($_SESSION["cart"] as $keys => $values){
			?>
				<tr>
				<td><?php echo $values["menu_name"]; ?></td>
				<td><?php echo $values["quantity"] ?></td>
				<td>Rp. <?php echo $values["price"]; ?></td>
				<td>Rp. <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
				<td><a href="cart.php?action=delete&id_menu=<?php echo $values["id_menu"]; ?>"><span class="text-danger">Remove</span></a></td>
				</tr>
				<?php 
				$total = $total + ($values["quantity"] * $values["price"]);
			}
			?>
			<tr>
			<td colspan="3" text-align="right">Total</td>
			<td text-align="right">Rp. <?php echo number_format($total, 2); ?></td>
			<td></td>
			</tr>
			</table>
			<?php
			echo '<a href="cart.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Empty Cart</button></a>&nbsp;<a href="index.php"><button class="btn btn-warning">Add more items</button></a>&nbsp;<a href="checkout.php"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Check Out</button></a>';
			?>
		<?php
		} elseif(empty($_SESSION["cart"])){
		?>
			<div class="container">
			<div class="jumbotron">
			<h3>Keranjang Kosong. Enjoy <a href="index.php">Menu List</a> di Sini.</h3>        
			</div>      
			</div>    
		<?php
		}
		?>		
		</div>		   
	</div> 	
</div>
<?php include('inc/footer.php');?>
