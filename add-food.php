<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Add Food</h1><br>

        <?php
       
          if(isset($_SESSION['upload'])){//checking session set or not
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //removing session msg only 1 time
          }
        ?><br>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="food Title">
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" rows="5" cols="30" placeholder="Description of the food"></textarea>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" >
                </td>
            </tr>
            <tr>
                <td>Select Image::</td>
                <td>
                <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                        <?php //display category from database
                        $sql="SELECT* FROM tbl_category WHERE active='Yes'";
                        $res=mysqli_query($conn,$sql);

                        $count=mysqli_num_rows($res);

                         //$sn=1;
                        if($count>0)
                        {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'] ;
                            $title=$row['title'];

                            ?>

                            <option value="<?php echo $id;?>"><?php echo $title;?></option>
                            
                            <?php
                            
                        }
                    }
                    else 
                    {
                           ?>
                           <option value="0">No category found</option>
                           <?php
                    }
                        
                        ?>
                        
                    </select>
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
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form><br>

             <?php
                    if(isset($_POST['submit'])){
                        //echo "clicked!";
                        //get value from form
                        $title=$_POST['title'];
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $category=$_POST['category'];
                        
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


                        
            if(isset($_FILES['image']['name'])){
                //upload image with source path and destination path
                $image_name=$_FILES['image']['name'];
                if($image_name!="")
                {


                //auto rename our image and get extension(jpg,png,gif,etc)ex:main.jpg
                $ext= end(explode('.',$image_name));
                //rename the image
                $image_name="Food-Name-".rand(000,999).'.'.$ext;//ex:Food_Category_834.jpg

                $src=$_FILES['image']['tmp_name'];
                $dst="../images/food/".$image_name;
                //finally we can upload image
                $upload=move_uploaded_file($src,$dst);
                //check whether the img is uploaded or not
                //if not then stop process and redirect the error msg
                if($upload==false){
                    $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }
            }
        }
            else{
                //dont upload image 
                $image_name="";
            }
//for numerical value without quotes
            $sql2="INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category, 
            featured='$featured',
            active='$active'
            ";

            //3.execute query
            $res2= mysqli_query($conn,$sql2);
            //4.check query executed or not
            if($res2){
//category added
           $_SESSION['add']="<div class='success'>category added successfully</div>";
//redirect page TO MANAGE ADMIN
           header("location:" .SITEURL.'admin/manage-food.php');
            }
            else{
//failed to add
           $_SESSION['add']="<div class='error'>category failed to add.</div>";
//redirect page TO MANAGE ADMIN
           header("location:" .SITEURL.'admin/manage-food.php');
            }
            


                         }     //check radio btn clicked or not
             
             ?>

    
    </div></div>


    <?php include('partials/footer.php');?>