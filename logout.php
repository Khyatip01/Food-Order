<?php //include constant.php
include('../config/constant.php');
//1.destroy session
session_destroy();
//2.redirect to login page..
header('location:'.SITEURL.'admin/login.php');
?>