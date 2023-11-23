<?php
if (isset($_SESSION["customer_name"])) {
  ?>
   <ul class="nav navbar-nav navbar-right">
	<li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Selamat Datang <?php echo $_SESSION["customer_name"]; ?> </a></li>
	<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Keranjang  (<?php
	  if(isset($_SESSION["cart"])){
	  $count = count($_SESSION["cart"]); 
	  echo "$count"; 
		}
	  else
		echo "0";
	  ?>) </a></li>
	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
  </ul>
<?php        
}
?>