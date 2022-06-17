<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>update admin</h1><br>
        <br>
        <?php
//1.get the id
$id=$_GET['id'];

//2.ceate sql query
$sql="SELECT *FROM tbl_admin WHERE id=$id";
$res=mysqli_query($conn,$sql);
if($res){
    
    $count=mysqli_num_rows($res);
    if ($count== 1) {
            
        // output data of each row
        $row = mysqli_fetch_assoc($res);
           // $id=$row['id'];
            $full_name=$row['full_Name'];
            $username=$row['username'];
}
    else{
    
    header('location:' .SITEURL.'admin/manage-admin.php');
    }
}


        ?>

        <form action=" " method="POST">

    <table class="tbl-30">
        <tr>
            <td>full_Name:</td>
            <td>
                <input type="text" name="full_name" value="<?php echo $full_name;?>">
            </td>
        </tr>
        <tr>
            <td>Username</td>
            <td>
                <input type="text" name="username" value="<?php echo $username;?>">                         
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary">

            </td>
        </tr>
    </table>
    </div>
</div>
<?php   
if(isset($_POST['submit']))
{
    //echo "button is clicked!";// get all values from form
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id=$id
    ";
    $res=mysqli_query($conn,$sql);
    if($res){
        $_SESSION['update']="<div class='success'>admin updated successfully</div>";
    //redirect to manage admin..
    header('location:' .SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update']="<div class='error'>admin updated failed</div>";
    //redirect to manage admin..
    header('location:' .SITEURL.'admin/manage-admin.php');
    }

}

?>
<?php include('partials/footer.php'); ?>