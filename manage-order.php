<?php include('partials/menu.php');?>

<div class="menu-content">
    <div class="wrapper">
    <h1>Manage order</h1>
    <br><br><br>
      <!-- button to add admin-->
      <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
      ?>
   
<table class="tbl-full">
    <tr>
        <th>sr.NO</th>
        <th>Food</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Order date</th>
        <th>Status</th>
        <th>Customer Name</th>
        <th>Customer Contact</th>
        <th>Customer Email</th>
        <th>Customer Address</th>
        <th>Actions</th>
     </tr>
    <?php 
           $sql="SELECT *FROM tbl_order ORDER BY id DESC";//display the latest order
           $res=mysqli_query($conn,$sql);

           $count=mysqli_num_rows($res);
$sn=1;
           if($count>0){
               while($row=mysqli_fetch_assoc($res)){
                       $id=$row['id'];
                       $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['qty'];
                        $total=$row['total'];
                        $order_date=$row['order_date'];
                        $status=$row['status'];
                        $customer_name=$row['customer_name'];
                        $customer_contact=$row['customer_contact'];
                        $customer_email=$row['customer_email'];
                        $customer_address=$row['customer_address'];

?>
     <tr>
        <td colspan="1"><?php echo $sn++;?></td>
        <td colspan="1"><?php echo $food;?></td>
        <td colspan="1"><?php echo $price;?>&#8377;</td>
        <td colspan="1"><?php echo $qty?></td>
        <td colspan="1"><?php echo $total?></td>
        <td colspan="1" ><?php echo $order_date;?></td>
        <td >
            <?php
               if($status=="Ordered")
               {
                echo "<label>$status</label>";
               }
               elseif($status=="On delivery")
               {
                echo "<label style='color:orange;'>$status</label>";  
               }
               elseif($status=="Delivered")
               {
                echo "<label style='color:green;'>$status</label>";  
               }
               elseif($status=="Canceled")
               {
                echo "<label style='color:red;'>$status</label>";  
               }
            ?>
        </td>
        <td colspan="1"><?php echo $customer_name?></td>
        <td colspan="1"><?php echo $customer_contact?></td>
        <td><?php echo $customer_email?></td>
        <td><?php echo $customer_address?></td>
               
        <td>
        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?> " class="btn-secondary"> update Order</a>
        
        </td>
    </tr>

                   <?php
                      
               }
           }
           else{
               echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
           }

 ?>

    
</table>
</div>
</div>
<?php include('partials/footer.php');?>