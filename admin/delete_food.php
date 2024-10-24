<?php session_start(); ?>
<?php ob_start(); ?>
<?php 

include('../config/constants.php'); 

if (isset($_GET['id']) AND isset($_GET['image_name'])) 
{
	$id = $_GET['id'];
	$image_name =$_GET['image_name'];

	if ($image_name!="") 
	{
		$path = "../images/category/".$image_name;
		$remove = unlink($path);

		if($remmove==true)
		{
			$_SESSION['remove'] = "<div class='error'>Failed to remove Category.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
			die();
		}
	}


		$res = $db->prepare("DELETE FROM tbl_food WHERE id='$id'");
		$res->execute();



		if ($res==true) 
		{
			//echo "Admin DELETE";
			$_SESSION['delete'] = "<div class='success'>Category DELETE Successully.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
			
		}
		else
		{
			$_SESSION['delete'] = "<div class='error'>Category DELETE fieled</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
}
else
{

header('location:'.SITEURL.'admin/manage-food.php');

}


 


?>