<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Add Category</h1><br>
        

        <?php
        if(isset($_SESSION['add'])){//checking session set or not
            echo $_SESSION['add'];
            unset($_SESSION['add']); //removing session msg only 1 time
          }

          if(isset($_SESSION['upload'])){//checking session set or not
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //removing session msg only 1 time
          }
        ?><br>
        <br>
        <!--add category starts-->
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="category Title">
                </td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>

        <!--add category ends-->

        <?php  
         if(isset($_POST['submit'])){
            //echo "clicked!";
            //get value from form
            $title=$_POST['title'];
            //check radio btn clicked or not
            if(isset($_POST['featured'])){
                //get value
                $featured=$_POST['featured'];
            }
            else{
                $featured="No";
            }
            if(isset($_POST['active'])){
                //get value
                $active=$_POST['active'];
            }
            else{
                $active="No";
            }

            //check whether the img is selected or not
            //print_r($_FILES['image']);
            //die();

            if(isset($_FILES['image']['name'])){
                //upload image with source path and destination path
                $image_name=$_FILES['image']['name'];
                if($image_name!="")
                {


                //auto rename our image and get extension(jpg,png,gif,etc)ex:main.jpg
                $ext= end(explode('.',$image_name));
                //rename the image
                $image_name="Food_Category_".rand(000,999).'.'.$ext;//ex:Food_Category_834.jpg

                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;
                //finally we can upload image
                $upload=move_uploaded_file($source_path,$destination_path);
                //check whether the img is uploaded or not
                //if not then stop process and redirect the error msg
                if($upload==false){
                    $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }}
            }
            else{
                //dont upload image 
                $image_name="";
            }
            $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3.execute query
                $res= mysqli_query($conn,$sql);
                //4.check query executed or not
                if($res){
//category added
               $_SESSION['add']="<div class='success'>category added successfully</div>";
//redirect page TO MANAGE ADMIN
               header("location:" .SITEURL.'admin/manage-category.php');
                }
                else{
//failed to add
               $_SESSION['add']="<div class='error'>category failed to add.</div>";
//redirect page TO MANAGE ADMIN
               header("location:" .SITEURL.'admin/manage-category.php');
                }
                


         }
        ?>
    </div>
</div>


<?php include('partials/footer.php');?>