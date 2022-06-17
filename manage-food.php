<?php include('partials/menu.php');?>

<div class="menu-content">
    <div class="wrapper">
    <h1>Manage food</h1>
    <br>
    <br>
      <!-- button to add admin-->
   <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
   <br><br>

   <?php

        if(isset($_SESSION['add'])){//checking session set or not
              echo $_SESSION['add'];
              unset($_SESSION['add']); //removing session msg only 1 time
          }

        if(isset($_SESSION['delete'])){//checking session set or not
            echo $_SESSION['delete'];
            unset($_SESSION['delete']); //removing session msg only 1 time
          }

        if(isset($_SESSION['remove'])){//checking session set or not
            echo $_SESSION['remove'];
            unset($_SESSION['remove']); //removing session msg only 1 time
          }

        if(isset($_SESSION['upload'])){//checking session set or not
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //removing session msg only 1 time
          }

        if(isset($_SESSION['unauthorized'])){//checking session set or not
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']); //removing session msg only 1 time
          }

        if(isset($_SESSION['update'])){//checking session set or not
            echo $_SESSION['update'];
            unset($_SESSION['update']); //removing session msg only 1 time
          }


   ?>
<table class="tbl-full">
    <tr>
        <th>Sr.NO</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
     </tr>
     
             <?php 
             $sql="SELECT *FROM tbl_food";
             $res=mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
        
             $sn=1;
             if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                  $id=$row['id'] ;
                  $title=$row['title'];
                  $price=$row['price'];
                  $image_name=$row['image_name'] ;
                  $featured=$row['featured'] ;
                  $active=$row['active'] ;
                  ?>
              <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title;?></td>
        <td><?php echo $price;?></td>
        <td>
            
                  <?php 
                  //check whether the imgname is available or not
                  if($image_name!=="")
                  {
                      //display the image
                      ?>
                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" >
                      <?php
                  }
                  else{
                      //display the message
                      echo "<div class='error'>Image not added</div>";
                  }
                  ?>
            
            
        </td>
        <td><?php echo $featured;?></td>
        <td><?php echo $active;?></td>
        <td>
           <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary"> Update Food</a>
           <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Food</a>
        </td>

        
    </tr>
                <?php

                }
            }
            else{
                echo "<tr><td><div class='error'>Food Not Added Yet.</div></td></tr>";
            }
   ?>
</table>
</div>
</div>
<?php include('partials/footer.php');?>