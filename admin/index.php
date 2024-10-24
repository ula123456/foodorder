<?php include("partials/menu.php");?>
	<!--main containt start -->
	<div class="main-content">
		<div class="wrapper">
			
			<h1>DASHBORD</h1>
			<br><br>

			<?php
			if (isset($_SESSION['add'])) 
			{
			  	echo $_SESSION['add'];
			  	unset($_SESSION['add']);
			}  ?>


			<div class="col-4 text-center">
			<?php

				 $res = $db->prepare("SELECT count(*) FROM tbl_category");
			 	 $res->execute();
		$count = $res->fetchColumn();

			
			 ?>
				<h1><?php echo $count; ?></h1>
				<br/>
				Foods
			</div>
			<div class="col-4 text-center">
				<?php

				 $res2 = $db->prepare("SELECT count(*) FROM tbl_food");
			 	 $res2->execute();
		$count2 = $res2->fetchColumn();

			
			 ?>
				<h1><?php echo $count2; ?></h1>
				<br/>
				Orders
			</div>
			<div class="col-4 text-center">
				<?php

				 $res3 = $db->prepare("SELECT count(*) FROM tbl_order");
			 	 $res3->execute();
		$count3 = $res3->fetchColumn();

			
			 ?>
				<h1><?php echo $count3; ?></h1>
				<br/>
				Total Orders
			</div>
			<div class="col-4 text-center">
				<?php

				 $res4 = $db->prepare("SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'");
			 	 $res4->execute();
		$row4 = $res4->fetch();

			$total_revenu = $row4['Total'];
			
			 ?>
				<h1>$<?php echo $total_revenu; ?></h1>
				<br/>
				Revenu Genereted
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!--main containt end -->
	<?php include("partials/footer.php");?>
	