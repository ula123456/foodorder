<?php session_start(); ?>
<?php include('../config/constants.php'); 
 include("partials/menu.php");?>

	<!--main containt start -->
	<div class="main-content">
		<div class="wrapper">
			
			<h1>Manage Admin</h1>
			<br/>

			<?php 
			if (isset($_SESSION['add'])) {echo $_SESSION['add']; 
										unset($_SESSION['add']);} 


			if (isset($_SESSION['delete'])) {echo $_SESSION['delete'];
											 unset($_SESSION['delete']); }


			if (isset($_SESSION['update'])) {echo $_SESSION['update'];
											unset($_SESSION['update']);
											}


			if (isset($_SESSION['user_not_found'])) {echo $_SESSION['user_not_found'];
													unset($_SESSION['user_not_found']); }


			if (isset($_SESSION['pwd-not-much'])) {	echo $_SESSION['pwd-not-much'];
													unset($_SESSION['pwd-not-much']); }


			if (isset($_SESSION['change_pwd'])) {echo $_SESSION['change_pwd'];
												unset($_SESSION['change_pwd']); }
			?>

			<br/><br/>
			<!-- button to add admin -->
			<a href="add-admin.php" class="btn-primary">Add Admin</a>

			<br/><br/><br/>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>
				<?php
				$res = $db->query("SELECT * FROM tbl_admin");
				$res->execute();

				$sn=1;

			if ($res==TRUE) 
			{
				while ($row = $res->fetch()) 
				{
					$id = $row['id'];
					$full_name = $row['full_name'];
					$username = $row['username'];
					?>
					<tr>
					<td><?php echo $sn++;?></td>
					<td><?php echo $full_name; ?></td>
					<td><?php echo $username;?></td>
					<td>
						<a href="<?php echo SITEURL;?>admin/update_password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>
						<a href="<?php echo SITEURL;?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">update admin</a>
						<a href="<?php echo SITEURL;?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">delete admin</a>
					</td>
				</tr>
					<?php 
				}
			}

				 ?>
				
				
			</table>

			
		</div>
	</div>
	<!--main containt end -->

<?php include("partials/footer.php");?>