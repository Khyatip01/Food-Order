<?php include('partials/menu.php');?>

   <!--main content starts-->
   <div class="menu-content">
    <div class="wrapper">
   <h1>Manage Admin</h1><br>

   <?php  
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']); //removing session msg only 1 time
      }

      if(isset($_SESSION['delete'])){
         echo $_SESSION['delete'];
         unset($_SESSION['delete']);
      }

      if(isset($_SESSION['update'])){
         echo $_SESSION['update'];
         unset($_SESSION['update']);
      }

      if(isset($_SESSION['user-not-found'])){
         echo $_SESSION['user-not-found'];
         unset($_SESSION['user-not-found']);
      }
      
      if(isset($_SESSION['pwd-not-match'])){
         echo $_SESSION['pwd-not-match'];
         unset($_SESSION['pwd-not-match']);
      }

      if(isset($_SESSION['change-pwd'])){
         echo $_SESSION['change-pwd'];
         unset($_SESSION['change-pwd']);
      }
   ?>
<br>
<br>
   <!-- button to add admin-->
   <a href="add-admin.php" class="btn-primary">Add Admin</a>
   <br><br>
<table class="tbl-full">
    <tr>
        <th>sr.NO</th>
        <th>full name</th>
        <th>username</th>
        <th>Actions</th>
     </tr>

     <?php 
         $sql="SELECT *FROM tbl_admin";
         $res=mysqli_query($conn,$sql);
         $sn=1; //assign id from 1

         if (mysqli_num_rows($res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($res)) {
                $id=$row['id'];
                $full_name=$row['full_Name'];
                $username=$row['username'];

                ?>
    <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $full_name;?></td>
        <td><?php echo $username;?></td>
        <td>
           <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>
           <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> update admin</a>
           <a href="<?php echo SITEURL; ?>admin/delete-admin.php? id=<?php echo $id; ?>" class="btn-danger"> delete admin</a>
        </td>
    </tr>


                <?php  
                


            }
          } else {
            echo "we dont have data in database";
          }
     ?>
    
</table>
</div>
   </div>
   <!--main content ends-->

   <?php include('partials/footer.php');?>