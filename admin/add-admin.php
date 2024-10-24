<?php  session_start();?>
<?php 
include('../config/constants.php');

 //prosess the value from and Save it i DB
// chek weather the submit is cliked or not
if (isset($_POST['submit'])) {
	// button cliked
	//echo "button cluked";
	$full_name = $_POST['full_name'];
	$usernsme = $_POST['usernsme'];
	$password = md5($_POST['password']);//password encription width md5

	// sql query save the data into database

	// execute query and save to in db
	$sql = "INSERT INTO tbl_admin 
						(full_name,
						username, 
						password )
				 VALUES('$full_name',
				 		'$usernsme',
				  		'$password')";
	
	$res = $db->prepare($sql);
	$res->execute();
	
	//chek whether the data is inserted or not and display 
	if ($res==TRUE) 
		{
		//created session message
		$_SESSION['add'] = "ADMIN ADDED SUCCESSUFFULY";
		//redirect to manage admin
		header("location:".SITEURL.'admin/manage-admin.php');
		}

	else
		{
		$_SESSION['add'] = "FIELD TO ADDED ADMIN ";
		header("location:".SITEURL.'admin/add-admin.php');
		}
}



?>
<?php include('partials/menu.php');?>
<div class="main-content">
		<div class="wrapper">
			
			<h1>Add Admin</h1>
			<br><br>
			<?php
			if (isset($_SESSION['add'])) //chek session set or not 
			{
				echo $_SESSION['add']; 
				unset($_SESSION['add']); // remove session message
			} 
			?>
			<form action="" method="POST">

				<table class="tbl-30">
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="full_name" placeholder="Enter your name" > </td>
						
					</tr>
					<tr>
						<td>User Name:</td>
						<td><input type="Password" name="usernsme" placeholder="Enter your user name" > </td>
						
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="text" name="password" placeholder="Enter your Password" > </td>
						
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Admin" class="btm-secondary">
						</td>
						
						
					</tr>
				</table>
				
			</form>
			

			
		</div>
	</div>
	<!--main containt end -->

<?php include("partials/footer.php");?>