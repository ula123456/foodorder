<?php session_start(); ?>
<?php
include('../config/constants.php');
if (isset($_POST['submit'])) 
{
	$id = $_GET['id'];
	$full_name=$_POST['full_name'];
	$username=$_POST['username'];

	
	$res = $db->prepare("UPDATE tbl_admin
				    		SET full_name ='$full_name',
								username ='$username'
						  WHERE id='$id'");
		  $res->execute();
	 

	if ($res==true) 
	{
		$_SESSION['update'] = "<div class='success'>Admin apdate successfuly.</div>";
		
		header('Location: '.SITEURL.'admin/manage-admin.php');
		
	}
}?>
<?php include("partials/menu.php");?>

<div class="main-content">
		<div class="wrapper">
			<h1>Update admin</h1>

			<br><br>

			<?php 

			$id = $_GET['id'];
			$res = $db->prepare("SELECT count(*) FROM tbl_admin WHERE id='$id'");
			$res->execute();

			if ($res==true) 
			{
				$count = $res->fetchColumn();
				if ($count==1) {
					//echo "Admin aviable";
					$res = $db->prepare("SELECT * FROM tbl_admin WHERE id='$id'");
					$res->execute();
					$row = $res->fetch();
					$full_name = $row['full_name'];
					$username = $row['username'];
					$id=$row['id'];
				}
				else
				{
					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}
			?>

			<form action="" method="POST">

				<table class="tbl-30">
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="full_name" value="<?php echo $full_name;?>" > </td>
						
					</tr>
					<tr>
						<td>User Name:</td>
						<td><input type="text" name="username" value="<?php echo $username;?>" > </td>
						
					</tr>
					
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Update Admin" class="btm-secondary">
						</td>
						
						
					</tr>
					
				</table>
				
			</form>

		</dir>
</dir>
<?php include("partials/footer.php");?>