<?php
//chceck whether the user logged in or not
//authorization access control
if(!isset($_SESSION['user'])){
//redirect to login page with msg..
$_SESSION['no-login-message']="<div class='error text-center'>please login to access admin panel</div>";
header('location:' .SITEURL.'admin/login.php');
}
?>