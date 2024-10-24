<?php session_start(); ?>
<?php 

include('../config/constants.php'); 

$id = $_GET['id'];
 
$select_user = $db->prepare("DELETE FROM tbl_admin WHERE id='$id'");
$select_user->execute();

if ($select_user==true) 
{
	//echo "Admin DELETE";
	$_SESSION['delete'] = "<div class='success'>Admin DELETE Successully.</div>";
	header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
	$_SESSION['delete'] = "<div class='error'>Admin DELETE fieled</div>";
	header('location:'.SITEURL.'admin/manage-admin.php');
}
?>