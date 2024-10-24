<?php ob_start(); ?>
<?php include("partials/menu.php");?>

<div class="main-content">
		<div class="wrapper">
			<h1>Add Food</h1>
			<br/><br/>

			<?php 
			if (isset($_SESSION['upload'])) //chek session set or not 
			{
				echo $_SESSION['upload']; 
				unset($_SESSION['upload']); // remove session message
			} 

			?>

			<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				
			
				<tr>
					<td>Title:</td>
					<td><input type="text" name="title" placeholder="Title of the Food"></td>
					
				</tr>
				<tr>
					<td>Description:</td>
					<td><textarea name="description" cols="30" rows="5" placeholder="Description of Food" ></textarea></td>
					
				</tr>
				<tr>
					<td>Price:</td>
					<td><input type="number" name="price"></td>
					
				</tr>
				<tr>
					<td>Select Image:</td>
					<td><input type="file" name="image"></td>
					
				</tr>
				<tr>
					<td>Category:</td>

					<td>
						<select name="category">

							<?php 
							
						$res = $db->prepare("SELECT count(*) FROM tbl_category WHERE active = 'Yes' ");
			 			$res->execute();
						$count = $res->fetchColumn();

							if ($count>0) 
							{
								$res=$db->query("SELECT  * FROM tbl_category WHERE active = 'Yes'");

								while ($row = $res->fetch()) 
								{
									$id = $row ['id'];
									$title =$row['title'];
									?>  
									<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
									 <?php
								}
							}
							else
							{
								?><option value="0">no category found</option><?php
							}
				
							
							

							?>
						
						</select>
					</td>
				</tr>


				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No
					</td>
					
				</tr>
				<tr>
					<td>Active:</td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>

					
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
						
					</td>
					
					
				</tr>
				</table >
			</form>
			<?php 

			if (isset($_POST['submit'])) 
			{
				$title =$_POST['title'];
				$description =$_POST['description'];
				$price =$_POST['price'];
				$category =$_POST['category'];
				if (isset($_POST['featured'])) 
				{
					$featured = $_POST['featured'];
				}
				else
				{
					$featured = "No";
				}
				if (isset($_POST['featured'])) 
				{
					$active = $_POST['active'];
				}
				else
				{
					$active = "No";
				}
				if (isset($_FILES['image']['name'])) 
				{
					$image_name = $_FILES['image']['name'];
					if ($image_name != "") 
					{

						$ext = end(explode('.', $image_name));
						
					
						$image_name = "food-Name-".rand(000,999).".".$ext;

						$src = $_FILES['image']['tmp_name'];

						$dst = "../images/food/".$image_name;

						$upload = move_uploaded_file($src, $dst);

						if ($upload==false) 
						{
							$_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
											 header('Location:'.SITEURL.'admin/add-food.php');	die();	
						}

					}
				}
				else
				{
					$image_name = "";
				}
				$sql2 = "INSERT INTO tbl_food 
							   SET title ='$title',
							 description = '$description',
							       price = '$price',
							  image_name ='$image_name',
						   	  	category ='$category',
						   		featured = '$featured',
						      	  active ='$active'";
	
			$res2 = $db->prepare($sql2);
			$res2->execute();

			if ($res2==TRUE) 
			{
			//created session message
			$_SESSION['add'] = "<div class='success'>Food Aded SUCCESSUFFULY.</div>";
			//redirect to manage admin
			header("location:".SITEURL.'admin/manage-food.php');
			}

			else
			{
			$_SESSION['add'] = "<div class='error'>Failed to Upload image.</div>";;
			header("location:".SITEURL.'admin/manage-food.php');
			}
			}


			?>

		</div>
</div>


<?php include("partials/footer.php");?>