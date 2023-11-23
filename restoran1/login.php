<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if($customer->loggedIn()) {	
	header("Location: index.php");	
}

$loginMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {	
	$customer->username = $_POST["username"];
	$customer->password = $_POST["password"];	
	$customer->loginType = $_POST["loginType"];
	if($customer->login()) {
		header("Location: index.php");	
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
} else {
	$loginMessage = 'Masukkan Username & Password.';
}
include('inc/header.php');
?>
<title>Toben Cafe</title>
<?php include('inc/container.php');?>
<div class="content" > 
	<div class="container-fluid">			
        <div class="col-md-6" >                    
		<div class="panel panel-info">
			<div class="panel-heading" style="background:#5bc0de;color:white;">
				<div class="panel-title">Customer Log In</div>                        
			</div> 
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">                                    
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="username" name="username" value="<?php if(!empty($_POST["username"])) { echo $_POST["username"]; } ?>" placeholder="username" style="background:white;" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="password" required>
					</div>						
					
					<div style="margin-top:10px" class="form-group">                               
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Login" class="btn btn-info">						  
						</div>						
					</div>					
					
					
				</form> 
				<a href="admin/add-customer.php">Daftar Akun Customer</a> 
			</div>                     
		</div>  
	</div>       
    </div>        
		
<?php include('inc/footer.php');?>
