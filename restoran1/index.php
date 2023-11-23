
<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';
include_once 'class/Food.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$food = new Food($db);

if(!$customer->loggedIn()) {	
	header("Location: index.html");	
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
			<div class='row'>
			<?php 
			$result = $food->itemsList();
			$count=0;
			while ($item = $result->fetch_assoc()) { 
			if ($count == 0) {
				echo "<div class='row'>";
			}
			?>	
				<div class="col-md-3">
					<form method="post" action="cart.php?action=add&id_menu=<?php echo $item["id_menu"]; ?>">
						<div class="mypanel" text-align="center";>
							<img src="images/food/<?php echo $item["image_name"]; ?>" class="img-responsive">

							<h4 class="text-dark"><?php echo $item["menu_name"]; ?></h4>
							<h5 class="text-info"><?php echo $item["description"]; ?></h5>
							<h5 class="text-danger">Rp. <?php echo $item["price"]; ?>/-</h5>
							<h5 class="text-info">Jumlah: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
							<input type="hidden" name="menu_name" value="<?php echo $item["menu_name"]; ?>">
							<input type="hidden" name="price" value="<?php echo $item["price"]; ?>">
							<input type="hidden" name="id_menu" value="<?php echo $item["id_menu"]; ?>">
							<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Beli">
						</div>
					</form>    
				</div>

			<?php 
			$count++;
			if($count==4)
			{
			  echo "</div>";
			  $count=0;
			}
			} 
			?>
			</div>
		   
    </div>        
		
<?php include('inc/footer.php');?>
