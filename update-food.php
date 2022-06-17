<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>update Food</h1><br>
        <br>
        <?php
        if(isset($_GET['id']))
{    
    //1.get the id
$id=$_GET['id'];
$sql2="SELECT *FROM tbl_food WHERE id=$id";
$res2=mysqli_query($conn,$sql2);
if($res2){
    
    $count=mysqli_num_rows($res2);
    if ($count== 1) {
            
        // output data of each row
        $row = mysqli_fetch_assoc($res2);
           // $id=$row['id'];
            $title=$row['title'];
            $description=$row['description'];
            $price=$row['price'];
            $current_image=$row['image_name'];
            $current_category=$row['category_id'];
            $featured=$row['featured'];
            $active=$row['active'];

            
}}
else{
    $_SESSION['no-category-found']="<div class='error'>food updated failed</div>";

    header('location:' .SITEURL.'admin/manage-food.php');
    }}
else
{
    header('location:'.SITEURL.'admin/manage-food.php');
}

//2.ceate sql query 
   

        ?>

        <form action=" " method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="food Title" value="<?php echo $title;?>">
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" rows="5" cols="30" placeholder="Description of the food"><?php echo $description;?></textarea>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price;?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                <?php
                     if($current_image!="")
                     {
                       ?>
                       <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width="150px">
                       <?php
                     } 
                     else
                     {
                        echo "<div class='error'>Image  is not available.</div>";
                     }
                ?>
            </td></tr>
            <tr>
                <td>New image:</td>
            <td>
                <input type="file" name="image" >                         
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
                            $category_id=$row['id'] ;
                            $category_title=$row['title'];

                            ?>

                            <option <?php if($current_category==$category_id){echo "selected";}?>value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                            
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
                    <input type="radio" <?php if($featured=="Yes"){echo "checked";} ?>name="featured" value="Yes">Yes
                    <input type="radio" <?php if($featured=="No"){echo "checked";} ?>name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                <input type="radio" <?php if($active=="Yes"){echo "checked";}?> name="active" value="Yes">Yes
                <input type="radio" <?php if($active=="No"){echo "checked";}?> name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form><br>
    </div>
</div>
<?php   
if(isset($_POST['submit']))
{
    //echo "button is clicked!";// get all values from form
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $current_image=$_POST['current_image'];
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    //check for image
    if(isset($_FILES['image']['name']))
    {
       $image_name=$_FILES['image']['name'];
         if($image_name!="")
         {
//upload new image and remove current image
            //auto rename our image and get extension(jpg,png,gif,etc)ex:main.jpg
            $ext= end(explode('.',$image_name));
            //rename the image
            $image_name="Food-Name-".rand(000,999).'.'.$ext;//ex:Food_Category_834.jpg

            $src_path=$_FILES['image']['tmp_name'];
            $dst_path="../images/food/".$image_name;
            //finally we can upload image
            $upload=move_uploaded_file($src_path,$dst_path);
            //check whether the img is uploaded or not
            //if not then stop process and redirect the error msg
            if($upload==false){
                $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
            //remove current image if it is available
            if($current_image!=""){
             $remove_path="../images/food/".$current_image;
            $remove=unlink( $remove_path);
            if($remove==false)
            {
                $_SESSION['remove-failed']="<div class='error'>failed to remove image</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

         }
         else
         {
            $image_name=$current_image;
         }
    }
   else
   {
     $image_name=$current_image;
   }
    $sql3="UPDATE tbl_food SET
    title='$title',
    description='$description',
    price=$price,
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active'
    WHERE id=$id
    ";
    $res3=mysqli_query($conn,$sql3);
    if($res3){
        $_SESSION['update']="<div class='success'>Food updated successfully</div>";
    //redirect to manage admin..
    header('location:' .SITEURL.'admin/manage-food.php');
    }
    else{
        //$_SESSION['update']="<div class='error'>Food updated failed</div>";
    //redirect to manage admin..
    $_SESSION['update']="<div class='error'>category updated failed</div>";
    header('location:' .SITEURL.'admin/manage-food.php');
    }

}

?>
<?php include('partials/footer.php'); ?>
