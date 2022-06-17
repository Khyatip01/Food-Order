<?php
//start session
session_start();
//create constant to store repeating values
define('SITEURL','http://localhost/web-design-course-restaurant-master/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME);

?>