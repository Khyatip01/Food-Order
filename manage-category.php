<?php include('partials/menu.php');?>

<div class="menu-content">
    <div class="wrapper">
    <h1>Manage category</h1>
<br>

        <?php
        if(isset($_SESSION['add'])){//checking session set or not
            echo $_SESSION['add'];
            unset($_SESSION['add']); //removing session msg only 1 time
          }

        if(isset($_SESSION['remove'])){//checking session set or not
            echo $_SESSION['remove'];
            unset($_SESSION['remove']); //removing session msg only 1 time
          }

        if(isset($_SESSION['delete'])){//checking session set or not
            echo $_SESSION['delete'];
            unset($_SESSION['delete']); //removing session msg only 1 time
          }

        if(isset($_SESSION['no-category-found'])){//checking session set or not
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']); //removing session msg only 1 time
          } 
          
        if(isset($_SESSION['update'])){//checking session set or not
            echo $_SESSION['update'];
            unset($_SESSION['update']); //removing session msg only 1 time
          }

        if(isset($_SESSION['upload'])){//checking session set or not
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //removing session msg only 1 time
          }
        
        if(isset($_SESSION['failed-remove'])){//checking session set or not
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']); //removing session msg only 1 time
          }
          
        ?><br>
        <br>
      <!-- button to add admin-->
   <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
   <br><br>
<table class="tbl-full">
    <tr>
        <th>Sr.NO</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
     </tr>
     <?php 
     $sql="SELECT *FROM tbl_category";
     $res=mysqli_query($conn,$sql);
     $count=mysqli_num_rows($res);

     $sn=1;
     if($count>0){
        while($row=mysqli_fetch_assoc($res))
        {
          $id=$row['id'] ;
          $title=$row['title'];
          $image_name=$row['image_name'] ;
          $featured=$row['featured'] ;
          $active=$row['active'] ;
          ?>
     <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title;?></td>

        <td>
            <?php 
            //check whether the imgname is available or not
            if($image_name!=="")
            {
                //display the image
                ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
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
           <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary"> update Category</a>
           <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> delete Category</a>
        </td>
    </tr>
          <?php
        }
     }
     else{
        ?>
        <tr>
            <td colspan="6"><div class="error">No category added.</div></td>
            
        </tr>
        <?php
     }
     ?>


    
</table>
</div>
</div>
<?php include('partials/footer.php');?>