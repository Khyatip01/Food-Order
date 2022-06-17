<?php include('partials/menu.php');?>


<div class="menu-content">
    <div class="wrapper">
   <h1>Add Admin</h1><br>

   <?php  
      if(isset($_SESSION['add'])){//checking session set or not
        echo $_SESSION['add'];
        unset($_SESSION['add']); //removing session msg only 1 time
      }
   ?>

   <form action="" method="post">

   <table class="tbl-30">
    <tr>
        <td>full name:</td>
        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
    </tr>
    <tr>
        <td>Username:</td>
        <td><input type="text" name="username" placeholder="Enter Username">
        </td>   
    </tr>
    <tr>
        <td>Password:</td>
        <td><input type="password" name="password" placeholder="Enter password">
        </td>   
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
    </tr>
</table>
   </form><br>


<?php include('partials/footer.php');?>

<?php //process the value from form and save it in database
      
      if(isset($_POST['submit'])){   //1.get data
       // echo"button clicked!";
       $full_name=$_POST['full_name'];
       $username=$_POST['username'];
       $password=md5($_POST['password']); //passowrd encrypted with md5
         
       //2.sql query to sav the data in databse

    

$dbname = "food-order";

// Create connection

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO tbl_admin(full_name,username,password)
VALUES('$_POST[full_name]',$_POST[username],'$_POST[password]')";
    

$res= mysqli_query($conn, $sql);
if ($res) {
    //echo "New record created successfully";
    //create a session variable to display msg 
    $_SESSION['add']="admin added successfully!";
    //redirect page TO MANAGE ADMIN
    header("location:" .SITEURL.'admin/manage-admin.php');
  } else {
    $_SESSION['add']="failed to add admin!";
    //redirect page TO add ADMIN
    header("location:" .SITEURL.'admin/add-admin.php');
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
mysqli_close($conn); 
}
?>
