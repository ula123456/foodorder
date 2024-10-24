<?php include("partials/menu.php");?>

	<!--main containt start -->
	<div class="main-content">
		<div class="wrapper">
			
			<h1>Manage Order</h1>
			<br/>
			<?php
			if (isset($_SESSION['update'])) 
			{
			  	echo $_SESSION['update'];
			  	unset($_SESSION['update']);
			} ?>
			<br/><br/>			

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Food</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Total</th>
					<th>Order date</th>
					<th>Status</th>
					<th>Customer Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
				<?php

				$res = $db->prepare("SELECT count(*) FROM tbl_order ");
			 			$res->execute();
			$count = $res->fetchColumn();


		if ($count>0) 
		{
			$ress = $db->prepare("SELECT * FROM tbl_order ORDER BY id DESC");
			$ress->execute();
			
			$sn=1;

			if ($ress==TRUE) 
			{
				while ($row = $ress->fetch()) 
				{
				$id = $row['id'];
				$food = $row['food'];
				$price = $row['price'];
				$qty = $row['qty'];
				$total = $row['total'];
				$order_date = $row['order_date'];
				$status = $row['status'];
				$customer_name =$row['customer_name'];
				$customer_contact =$row['customer_contact'];
				$customer_email =$row['customer_email'];
				$customer_address =$row['customer_address'];
				
				?>
				<tr>
					<td><?php echo $sn++;?>.</td>
					<td><?php echo $food;?></td>
					<td><?php echo $price;?></td>
					<td><?php echo $qty;?></td>
					<td><?php echo $total;?></td>
					<td><?php echo $order_date;?></td>
					<td>
						<?php 
							if ($status=="Ordered") 
							{
								echo "<label>$status</label>";
							}
							elseif ($status=="On Deliver") 
							{
								echo "<label style='color: orange;'>$status</label>";
							}
							elseif ($status=="Delivered") 
							{
								echo "<label style='color: green;'>$status</label>";
							}
							elseif ($status=="Canseled") 
							{
								echo "<label style='color: red;'>$status</label>";
							}
						?>
					</td>
					<td><?php echo $customer_name;?></td>
					<td><?php echo $customer_contact;?></td>
					<td><?php echo $customer_email;?></td>
					<td><?php echo $customer_address;?></td>
					<td>
						<a href="<?php echo SITEURL;?>admin/update_order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>

						
					</td>
				</tr>

		<?php   }
			}
		}
		else
		{
			echo "<div class='error'>Order not aviable</div>";
		}	
				 ?>

				
				
				
			</table>

			
		</div>
	</div>
	<!--main containt end -->

<?php include("partials/footer.php");?>