<?php include("partials/menu.php");?>

	<!--main containt start -->
	<div class="main-content">
		<div class="wrapper">
			
			<h1>Manage Food</h1>
			<br/><br/><?php
			if (isset($_SESSION['delete'])) 
			{
			  	echo $_SESSION['delete'];
			  	unset($_SESSION['delete']);
			} ?>
			<!-- button to add admin -->
			<a href="<?php  echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

			<br/><br/><br/>
			<?php 
			if (isset($_SESSION['add'])) //chek session set or not 
			{
				echo $_SESSION['add']; 
				unset($_SESSION['add']); // remove session message
			} 

			?>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Fetured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>
				<?php 
				
	

	$res = $db->prepare("SELECT count(*) FROM tbl_food ");
			 			$res->execute();
			$count = $res->fetchColumn();


		if ($count>0) 
		{
			$ress = $db->query("SELECT * FROM tbl_food ");
			$ress->execute();
			
			$sn=1;

			if ($ress==TRUE) 
			{
				while ($row = $ress->fetch()) 
				{
				$id = $row['id'];
				$title = $row['title'];
				$price = $row['price'];
				$image_name = $row['image_name'];
				$featered = $row['featured'];
				$active = $row['active'];
				$description = $row['description'];
				$category =$row['category'];
				
				 ?>
				<tr>
					<td><?php echo $sn++;?>.</td>
					<td><?php echo $title;?></td>
					<td><?php echo $price;?></td>
					<td><?php 
						if ($image_name!="") 
						{ ?> <img src="../images/food/<?php echo $image_name?>"width="100px"><?php }
						else
						{echo "<div class='error'>Image not added</div>";}
					
					?></td>
					<td><?php echo $featered;?></td>
							
					<td><?php echo $active;?></td>
					
					
					
					<td>
						<a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-secondary">update category</a>
						<a href="<?php echo SITEURL;?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">delete category</a>
					</td>
				<?php 
				}
			}
		}
		else
		{ ?>
			echo "<tr><td colspan='7'class='error'></td>food not Added Yet </tr>";
		<?php
		}

				

 ?>
			</table>

			
		</div>
	</div>
	<!--main containt end -->

<?php include("partials/footer.php");?>