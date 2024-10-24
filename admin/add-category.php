<?php session_start(); ?>
<?php ob_start(); ?>
<?php include('../config/constants.php');?>
<?php include("partials/menu.php");?>

<div class="main-content">
		<div class="wrapper">
			<h1>Add Category</h1>
			<br><br>
			<?php
			if (isset($_SESSION['add'])) //chek session set or not 
			{
				echo $_SESSION['add']; 
				unset($_SESSION['add']); // remove session message
			} 
			if (isset($_SESSION['upload'])) //chek session set or not 
			{
				echo $_SESSION['upload']; 
				unset($_SESSION['upload']); // remove session message
			} 
			?>
			<br><br>
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title</td>
						<td><input type="text" name="title" placeholder="Category title"></td>
					</tr>
					<tr>
						<td>Select Image</td>
						<td><input type="file" name="image">
							
						</td>
					</tr>

					<tr>
						<td>Featured</td>
						<td>
							<input type="radio" name="featured" value="Yes">Yes
							<input type="radio" name="featured" value="No">No
						</td>
					</tr>
					<tr>
						<td>Active</td>
						<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="no">No
					  </td>
					</tr>
					<tr>
						
						<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
						
					  </td>
					</tr>
					
				</table>
			</form>
		<?php 
		if (isset($_POST['submit'])) 
		{
			$title =$_POST['title'];

			if (isset($_POST['featured'])) {$featured=$_POST['featured'];}

			else{$featured="No";}

			if (isset($_POST['active'])) {$active=$_POST['active'];	}

			else{$active="no";}
			//print_r($_FILES['image']);
			if (isset($_FILES['image']['name'])) 
			{
				$image_name= $_FILES['image']['name'];

				if ($image_name !="") 
				{
					
				

					$ext = end(explode('.', $image_name));

					$image_name = "food_category".rand(000,999).'.'.$ext;



					$source_path = $_FILES['image']['tmp_name'];

					$destination_path = "../images/category/".$image_name;

					$upload = move_uploaded_file($source_path, $destination_path);
					if ($upload==false) {$_SESSION['upload'] = "<div class='error'>Failed to Upload image.</div>";
										 header('Location:'.SITEURL.'admin/add-category.php');	die();	}
				}
			}
			else
			{
				$image_name="";
			}

			$sql = "INSERT INTO tbl_category 
							SET title='$title',
								image_name='$image_name',
						   	    featured='$featured',
						        active='$active'";
	
			$res = $db->prepare($sql);
			$res->execute();

			if ($res==TRUE) 
			{
			//created session message
			$_SESSION['add'] = "CATEGORY ADDED SUCCESSUFFULY";
			//redirect to manage admin
			header("location:".SITEURL.'admin/manage-category.php');
			}

			else
			{
			$_SESSION['add'] = "FIELD TO ADDED CATEGORY ";
			header("location:".SITEURL.'admin/manage-category.php');
			}
		}
		?>
	</div>
</div>
<?php include("partials/footer.php");?>