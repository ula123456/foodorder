<?php session_start(); ?>
<?php ob_start(); ?>
<html>
<head>
	<title>login - Food Order Sistem</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<div class="login"><br>
		<h1 class="text-center">Login</h1><br><br>
		<br><br>
		<?php 
				if (isset($_SESSION['login'])) 
				{
					
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}
				if (isset($_SESSION['no-login-message'])) 
				{
					echo $_SESSION['no-login-message'];
					unset($_SESSION['no-login-message']);
				}
		?>
		<br><br>
		

		<form action="" method="POST" class="text-center">
			Username:<br>
			<input type="text" name="username" placeholder="Inter Username"><br><br>
			Password: <br>
			<input type="password" name="password" placeholder="Inter Password"><br><br>
			<input type="submit" name="submit" value="login" class="btn-primary"><br><br>
			
		</form>
		<p class="text-center">Created by ULA</p><br>
	</div>

</body>
</html>

<?php include('../config/constants.php');



if (isset($_POST['submit'])) 
{
	
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$res = $db->prepare("SELECT count(*) FROM tbl_admin 
									 WHERE username=$username 
									   AND password='$password'");
			 	$res->execute();
		$count = $res->fetchColumn();


		if ($count==1) 
		{
			
			$_SESSION['login'] = "<div class='success text-center'>Login successful</div>";
			 $_SESSION['user'] = $username;

			
			header('Location:'.SITEURL.'admin/index.php');
		}
		else
		{
			$_SESSION['login'] = "<div class='error text-center'>User name or password not much.</div>";
		
			header('Location:'.SITEURL.'admin/login.php');


		}

}
var_dump($_SESSION['user'] );
?>