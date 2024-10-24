<?php session_start(); ?>
<?php 
include('../config/constants.php');
		if (isset($_POST['submit'])) 

		{	$id =$_POST['id'];
			$current_password =md5($_POST['current_password']);
			$new_password = md5($_POST['new_password']);
			$confirm_password = md5($_POST['confirm_password']);


			$res = $db->prepare("SELECT * FROM tbl_admin 
										 WHERE id=$id 
										   AND password='$current_password'");
			$res->execute();
			
			if ($res==1) 
			{
				if ($new_password==$confirm_password) 
				{
					$res2 = $db->prepare("UPDATE tbl_admin
				    						 SET password ='$new_password'
						 				   WHERE id='$id'");
		  			$res2->execute();
		  			
		  			if ($res2==true) 
		  			{
		  				$_SESSION['change_pwd'] = "<div class='success'>Password Changed. </div>";
						header('Location:'.SITEURL.'admin/manage-admin.php');
		  			}
		  			else
		  			{
		  				$_SESSION['change_pwd'] = "<div class='error'>Failed to  Change password. </div>";
						header('Location:'.SITEURL.'admin/manage-admin.php');
		  			}
				}
				else
				{
				$_SESSION['pwd-not-much'] = "<div class='error'>Password Not Much. </div>";
				header('Location:'.SITEURL.'admin/manage-admin.php');
				}
			}
			else
			{
				$_SESSION['user-not-found'] = "<div class='error'>User Not found. </div>";
				header('Location:'.SITEURL.'admin/manage-admin.php');
			}
		}

?>
<?php include("partials/menu.php");?>
<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br/><br/>

		<?php 
			if (isset($_GET['id'])) {
				$id=$_GET['id'];
			}
		?>
		
		<form action="" method="POST">
				<table>
					<tr>
						<td>Curren Password:</td>
						<td>
						<input type="password" name="current_password" placeholder="current Password">							
						</td>
						
					</tr>
					<tr>
						<td>New Password</td>
						<td>
						<input type="password" name="new_password" placeholder="New Password">							
						</td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td>
						<input type="password" name="confirm_password" placeholder="Confirm Password">							
						</td>
					</tr>
					<tr>
						<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change Password" class="btn-secondary">						
						</td>
					</tr>
				</table>
			</form>

		

			
		</div>
	</div>

	<!--main containt end -->
<?php include("partials/footer.php");?>