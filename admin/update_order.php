<?php ob_start(); ?>
<?php include("partials/menu.php");?>
<?php include('../config/constants.php');?>
<?php 
if (isset($_GET['id'])) 
{
	$id=$_GET['id'];

	$ress = $db->query("SELECT * FROM tbl_order WHERE id='$id'");
	$ress->execute();
	$row3 = $ress->fetch();

		  		$id = $row3['id'];
				$food = $row3['food'];
				$price = $row3['price'];
				$qty = $row3['qty'];
				$status = $row3['status'];
				$customer_name =$row3['customer_name'];
				$customer_contact =$row3['customer_contact'];
				$customer_email =$row3['customer_email'];
				$customer_address =$row3['customer_address'];
}
else
{
		header('Location:'.SITEURL.'admin/manage-order.php');
}



 ?>
<div class="main-content">
	<div class="wrapper">
	<h1>Update Food</h1>
	<br/>
	

	<form action="" method="POST" enctype="multipart/form-data">
		<table class="tbl-30">
				
			<tr>
				<td>Food Name:</td>
				<td><?php echo $food; ?></td>
					
			</tr>
			<tr>
				<td>Price:</td>
				<td><?php echo $price; ?></td>
					
			</tr>

			<tr>
				<td>Qty:</td>
				
				<td><input type="number" name="qty"  value="<?php echo $qty; ?>"></td>
			</tr>

							
			<tr>
				<td>Status:</td>

				<td>
					<select name="status">
						<option <?php if ($status=="Ordered") {echo "selected";} ?> value="Ordered">Ordered</option>
						<option <?php if ($status=="On Deliver") {echo "selected";} ?> value="On Deliver">On Deliver</option>
						<option <?php if ($status=="Delivered") {echo "selected";} ?> value="Delivered">Delivered</option>
						<option <?php if ($status=="Canseled") {echo "selected";} ?> value="Canseled">Canseled</option>
					</select>
				</td>
			</tr>

			<tr>
				<td>Customer Name:</td>
					
				<td><input type="text" name="customer_name"  value="<?php echo $customer_name; ?>"></td>
					
			</tr>
				
				<td>Customer Contact:</td>
				<td><input type="text" name="customer_contact"  value="<?php echo $customer_contact; ?>">
					
			</td>

			</tr>
				
				<td>Customer Email:</td>
				
				<td><input type="text" name="customer_email"  value="<?php echo $customer_email; ?>">
			</td>

			</tr>
				<td>Customer Address:</td>
					
				<td><input type="text" name="customer_address"  value="<?php echo $customer_address; ?>">
			</td>

					
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="price" value="<?php echo $price; ?>">
						<input type="submit" name="submit" value="Update Food" class="btn-secondary">
						
					</td>
					
					
				</tr>
				
				</table >
			</form>

	<?php 
	if (isset($_POST['submit']))
	{	
		$id = $_GET['id'];
		
		$qty = $_POST['qty'];
		$total = $price*$qty;

		$status = $_POST['status'];

		$customer_name = $_POST['customer_name'];
		$customer_contact = $_POST['customer_contact'];
		$customer_email = $_POST['customer_email'];
		$customer_address = $_POST['customer_address'];

		
		

		$res2 = $db->prepare("UPDATE tbl_order
				    		SET qty = '$qty',
				    		total = '$total',
				    		status ='$status',
							customer_name = '$customer_name',
							customer_contact = '$customer_contact',
							customer_email = '$customer_email',
							customer_address = '$customer_address'
    						WHERE id='$id'");
		  $res2->execute();

		


		  if ($res2==true) 
			{
				$_SESSION['update'] = "<div class='success'>order update successfuly.</div>";
				
				header('Location: '.SITEURL.'admin/manage-order.php');
				
			}
			else
			{
				$_SESSION['update'] = "<div class='success'>feiled order update .</div>";
				
				header('Location: '.SITEURL.'admin/manage-order.php');

			}
		
	}

	?>
	</div>
</div>

 <?php include("partials/footer.php");?>