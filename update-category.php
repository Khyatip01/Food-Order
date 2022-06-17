<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>update Category</h1><br>
        <br>
        <?php
        if(isset($_GET['id']))
{    
    //1.get the id
$id=$_GET['id'];
$sql="SELECT *FROM tbl_category WHERE id=$id";
$res=mysqli_query($conn,$sql);
if($res){
    
    $count=mysqli_num_rows($res);
    if ($count== 1) {
            
        // output data of each row
        $row = mysqli_fetch_assoc($res);
           // $id=$row['id'];
            $title=$row['title'];
            $current_image=$row['image_name'];
            $featured=$row['featured'];
            $active=$row['active'];

            
}}
else{
    $_SESSION['no-category-found']="<div class='error'>category updated failed</div>";

    header('location:' .SITEURL.'admin/manage-category.php');
    }}
else
{
    header('location:'.SITEURL.'admin/manage-category.php');
}

//2.ceate sql query



   



        ?>

        <form action=" " method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
        <tr>
            <td>title:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title;?>">
            </td>
        </tr>
        <tr>
            <td>Current image:</td>
            <td>
                <?php
                     if($current_image!="")
                     {
                       ?>
                       <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
                       <?php
                     } 
                     else
                     {
                        echo "<div class='error'>Image not added.</div>";
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
            <td>Featured:</td>
            <td>
            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes 
            <input <?php if($featured=="No"){echo "checked";}?>type="radio" name="featured" value="No">No 
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes 
            <input <?php if($active=="No"){echo "checked";}?>type="radio" name="active" value="No">No 
            </td>
        </tr>
        <tr>
            <td colspan="2">
                 <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                 <input type="hidden" name="id" value="<?php echo $id;?>">
                 <input type="submit" name="submit" value="Update Category" class="btn-secondary">

            </td>
        </tr>
    </table>
</form>
    </div>
</div>
<?php   
if(isset($_POST['submit']))
{
    //echo "button is clicked!";// get all values from form
    $id=$_POST['id'];
    $title=$_POST['title'];
    $current_image=$_POST['current_image'];
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
            $image_name="Food_Category_".rand(000,999).'.'.$ext;//ex:Food_Category_834.jpg

            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            //finally we can upload image
            $upload=move_uploaded_file($source_path,$destination_path);
            //check whether the img is uploaded or not
            //if not then stop process and redirect the error msg
            if($upload==false){
                $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
            //remove current image if it is available
            if($current_image!=""){
             $remove_path="../images/category/".$current_image;
            $remove=unlink( $remove_path);
            if($remove==false)
            {
                $_SESSION['failed-remove']="<div class='error'>failed to remove image</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
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
    $sql2="UPDATE tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id=$id
    ";
    $res2=mysqli_query($conn,$sql2);
    if($res2){
        $_SESSION['update']="<div class='success'>category updated successfully</div>";
    //redirect to manage admin..
    header('location:' .SITEURL.'admin/manage-category.php');
    }
    else{
        $_SESSION['update']="<div class='error'>admin updated failed</div>";
    //redirect to manage admin..
    $_SESSION['update']="<div class='error'>category updated failed</div>";
    header('location:' .SITEURL.'admin/manage-category.php');
    }

}

?>
<?php include('partials/footer.php'); ?>
