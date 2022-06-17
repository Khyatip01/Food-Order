<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>change password</h1><br>
        <br>
        <?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
        ?>

        <form action="" method="POST">

<table class="tbl-30">
    <tr>
        <td>current password:</td>
        <td>
            <input type="password" name="current_password" placeholder="current password">
        </td>
    </tr>
<tr>
    <td>New Password:</td>
    <td>
        <input type="password" name="new_password" placeholder="new password">
    </td>
</tr>
<tr>
    <td>confirm password:</td>
    <td>
    
        <input type="password" name="confirm_password" placeholder="confirm password">
        </td>
</tr>
<tr>
           <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="change password" class="btn-secondary">

            </td>
</tr>
</table>
        </form>
    </div>
</div>

<?php  
     if(isset($_POST['submit'])){
        //get the data from form
$id=$_POST['id'];
$current_password=$_POST['current_password'];
$new_password=$_POST['new_password'];
$confirm_password=$_POST['confirm_password'];
   
$sql= "SELECT* FROM tbl_admin WHERE id=$id AND password='$current_password'";
$res=mysqli_query($conn,$sql);

if($res){
    $count=mysqli_num_rows($res);
    if ($count== 1) {
        if($new_password==$confirm_password){
            //update the password
            $sql2="UPDATE tbl_admin SET 
                password='$new_password'
                WHERE id=$id
                ";
            $res2=mysqli_query($conn,$sql2);
         if($res2){
            $_SESSION['change-pwd']="<div class='success'>pwd is changed successfull.</div>";
            header('location:' .SITEURL.'admin/manage-admin.php');
         }
         else{
            $_SESSION['change-pwd']="<div class='error'>pwd did not change.</div>";
            header('location:' .SITEURL.'admin/manage-admin.php');
         }
        }
        else{
            //redirect page
            $_SESSION['pwd-not-match']="<div class='error'>pwd not match.</div>";
        header('location:' .SITEURL.'admin/manage-admin.php');
        }
    }
    else{
        $_SESSION['user-not-found']="<div class='error'>user not found.</div>";
        header('location:' .SITEURL.'admin/manage-admin.php');//redirect 
    }
}


}
?>


        <?php include('partials/footer.php');?>