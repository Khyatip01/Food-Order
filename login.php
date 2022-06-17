<?php include('../config/constant.php');?>
<html>
    <head>
        <title>login-food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body id="bg"><br><br>
<?php 
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        
        
?><br>
<br>
       
           <!--login form starts-->
           <form action="" method="POST" class="text-center codehim-form" >
            <strong>Login</strong><br>
            <br>
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br>
            <br>Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br>
            <br><input type="submit" name="submit" value="login" class="btn-primary">
           <br><br>

           <p class="text-center">Created By-<a href="modikhyati2001@gmail.com">Khyati Modi</a></p><br>
           </form><br><!--login form ends-->
       </div>

    </body>

</html>

<?php
//whether submit button is clicked or not..
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
//check user exist or not
    $sql="SELECT *FROM tbl_admin WHERE username='$username' AND password='$password'";

    //execute query
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
if($count==1){
//user available and login success
$_SESSION['login']="<div class='success'>Login successful.</div>";
$_SESSION['user']=$username;// to check user logged in or not
header('location:' .SITEURL.'admin/');
}
else{
    $_SESSION['login']="<div class='error text-center'>Login failed.</div>";
header('location:' .SITEURL.'admin/login.php');
//user is not available and login fail
}
}
?>