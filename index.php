<?php include('partials/menu.php');?>
   <!--main content starts-->
   <div class="menu-content">
    <div class="wrapper">
   <h1>DASHBOARD</h1><br><br>
<?php
   if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
?>
<br><br>
<div class="col-4 text-center">

<?php 
      $sql="SELECT *FROM tbl_category";
      $res=mysqli_query($conn,$sql);
      $count=mysqli_num_rows($res);


?>
    <h1><?php echo $count;?></h1><br>
    categories
</div>

<div class="col-4 text-center">
<?php 
      $sql2="SELECT *FROM tbl_food";
      $res2=mysqli_query($conn,$sql2);
      $count2=mysqli_num_rows($res2);


?>
    <h1><?php echo $count2;?></h1><br>
   
    Foods
</div>

<div class="col-4 text-center">
    
<?php 
      $sql3="SELECT *FROM tbl_order";
      $res3=mysqli_query($conn,$sql3);
      $count3=mysqli_num_rows($res3);

?>
    <h1><?php echo $count3;?></h1><br>
    Total Orders
</div>

<div class="col-4 text-center">
<?php //use aggregate function for it..
      $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
      $res4=mysqli_query($conn,$sql4);
      //$count=mysqli_num_rows($res4);
      $row4=mysqli_fetch_assoc($res4);
      $total_revenue=$row4['Total'];


?>
    <h1><?php echo $total_revenue;?>&#8377;</h1><br>


   Revenue Generated</div>

    <div class="clearfix"></div>
</div>
   </div>
   <!--main content ends-->

   <?php include('partials/footer.php'); ?>