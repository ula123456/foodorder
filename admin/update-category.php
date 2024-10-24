<?php ob_start(); ?>
<?php include("partials/menu.php");?>
<?php include('../config/constants.php');?>
<?php 
if (isset($_GET['id'])) 
{
	$id=$_GET['id'];

	$res = $db->prepare("SELECT count(*) FROM tbl_category 
									 WHERE id='$id'");
			 	$res->execute();
		$count = $res->fetchColumn();


		if ($count==1) 
		{
			$ress = $db->query("SELECT * FROM tbl_category WHERE id='$id'");
			$ress->execute();
			$row = $ress->fetch();

			$title = $row['title'];
			$current_image = $row['image_name'];
			$featered = $row['featured'];
			$active = $row['active'];

			

		}
		else
		{

		}
}


 ?>
<div class="main-content">
	<div class="wrapper">
	<h1>Update Category</h1>
	<br/>
	<form action="" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="title" value="<?php echo $title; ?>">
				</td>
			</tr>
			<tr>
				<td>Current Image</td>
				<td>
					<?php 
					if ($current_image != "") 
					{
						?> 
						<img src="<?php  echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150">
						<?php
					}
					else
					{
						echo "<div class='error'>Image Not Added </div>";
					}
					 ?>
					
				</td>
			</tr>
			<tr>
				<td>New Image</td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Featured</td>
				<td>
					<input <?php if ($featered=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
					<input <?php if ($featered=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
				</td>
			</tr>
			<tr>
				<td>Active</td>
				<td>
					<input <?php if ($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
					<input <?php if ($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
				</td>
			</tr>
			<tr>
				<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="submit" name="submit" value="Update Category">
			</tr>

		</table>
	</form>

	<?php 
	if (isset($_POST['submit']))
	{	
		$id = $_GET['id'];
		$title = $_POST['title'];
		$current_image = $_POST['current_image'];
		$featured = $_POST['featured'];
		$active = $_POST['active'];

		if (isset($_FILES['image']['name'])) 
		{
			$image_name = $_FILES['image']['name'];

			if ($image_name != "") 
			{
					$ext = end(explode('.', $image_name));

					$image_name = "food_category".rand(000,999).'.'.$ext;



					$source_path = $_FILES['image']['tmp_name'];

					$destination_path = "../images/category/".$image_name;

					$upload = move_uploaded_file($source_path, $destination_path);
					if ($upload==false) {$_SESSION['upload'] = "<div class='error'>Failed to Upload image.</div>";
										 header('Location:'.SITEURL.'admin/manage-category.php');	die();	}

					if ($current_image!="") 
							{
							$remove_pathe ="../image/category/".$current_image;
							$remove = unlink($remove_pathe);

							if ($upload==false) 
								{
								$_SESSION['failed-remove'] = "<div class='error'>Failed to Upload image.</div>";
								header('Location:'.SITEURL.'admin/manage-category.php');
								die();
								}
					
							}
			}
			
			else
			{
				$image_name=$current_image;
			}
		}
		else
		{
		$image_name=$current_image;
		}
		

		$res2 = $db->prepare("UPDATE tbl_category
				    		SET title ='$title',
				    		image_name = '$image_name',
							featured ='$featured',
							active = '$active'
						  WHERE id='$id'");
		  $res2->execute();
		

		  if ($res2==true) 
			{
				$_SESSION['update'] = "<div class='success'>Category update successfuly.</div>";
				
				header('Location: '.SITEURL.'admin/manage-category.php');
				
			}
			else
			{
				$_SESSION['update'] = "<div class='success'>feiled Category update .</div>";
				
				header('Location: '.SITEURL.'admin/manage-category.php');

			}
		
	}

	?>
	</div>
</div>

 <?php include("partials/footer.php");?>