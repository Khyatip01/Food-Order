<?php //include constant.php file
include('../config/constant.php');
//1. get the id to delete admin and using sql query delete it
echo $id= $_GET['id'];

//2. redirect to manage admin page
$sql= "DELETE FROM tbl_admin WHERE id=$id";
$res= mysqli_query($conn,$sql);

if($res){
//echo "admin deleted!";
$_SESSION['delete']="<div class='success'>admin deleted successfully</div>";
//redirect to manage admin..
header('location:' .SITEURL.'admin/manage-admin.php');
}
else{
//echo "failed to delete admin!!";
$_SESSION['delete']="<div class='error'>failed to delete admin</div>";
//redirect to manage admin..
header('location:' .SITEURL.'admin/manage-admin.php');
}


?>