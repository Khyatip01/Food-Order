<?php include('../config/constant.php');
//check whether the id and image value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete it
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];//delete data and redirect to anage category page

   if($image_name!="")
   {
//remove ..img is available so
      $path="../images/food/".$image_name;
      $remove= unlink($path);

      if($remove==false){
        //if failed to remove image set the session msg and redirect
        $_SESSION['remove']="<div class='error'>failed to remove category image</div>";
        die();
        header('location:'.SITEURL.'admin/manage-category.php');
      }
   
 }
 //delete data from database
 $sql="DELETE FROM tbl_food WHERE id=$id";

 $res= mysqli_query($conn,$sql);

if($res){
//echo "admin deleted!";
$_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
//redirect to manage admin..
header('location:' .SITEURL.'admin/manage-food.php');
}
else{
//echo "failed to delete admin!!";
$_SESSION['delete']="<div class='error'>failed to delete food</div>";
//redirect to manage admin..
header('location:' .SITEURL.'admin/manage-food.php');
}
}

else
{
   //redirect to manage category page
   $_SESSION['unauthorized']="<div class='error'>Unauthorized To Access</div>";
   header('location:'.SITEURL.'admin/manage-food.php');
}

?>

