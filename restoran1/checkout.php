<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}
include('inc/header.php');
?>
<title>Toben Cafe</title>
  <link rel="stylesheet" type = "text/css" href ="css/foods.css">
<?php include('inc/container.php');?>
<div class="content">
	<div class="container-fluid">		
		
		<div class='row'>		
        <?php include('top_menu.php'); ?> 
		</div>
		<?php
		$orderTotal = 0;
		foreach($_SESSION["cart"] as $keys => $values){
			$total = ($values["quantity"] * $values["price"]);
			$orderTotal = $orderTotal + $total;
		}
		?>
		<div class='row'>
			<div class="col-md-6">
				<h3>Info</h3>
				<?php 
				$CustomerNameResult = $customer->getCustomerName();
				$count=0;
				while ($CustomerName = $CustomerNameResult->fetch_assoc()) { 
				?>
				<h3><strong><?php echo $CustomerName["customer_name"]; ?></strong></h3>
				<p><strong>Phone</strong>:<?php echo $CustomerName["phone"]; ?></p>
				<p><strong>Username</strong>:<?php echo $CustomerName["username"]; ?></p>
				<?php
				}
				?>				
			</div>
			<?php 
			$randNumber1 = rand(100000,999999); 
			$orderNumber = $randNumber1;
			?>
			<div class="col-md-6">
				<h3>Ringkasan</h3>
				<h3><strong>Order Total</strong>: Rp. <?php echo $orderTotal; ?></h3>
				<p><a href="process_order.php?order=<?php echo $orderNumber;?>"><button class="btn btn-warning">Place Order</button></a></p>
			</div>
		</div>
		   
    </div>        
		
<?php include('inc/footer.php');?>
