<?php  include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
//display all category
$sql="SELECT *FROM tbl_category  WHERE active='Yes' LIMIT 40";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

$sn=1;
if($count>0){
   while($row=mysqli_fetch_assoc($res))
   {
     $id=$row['id'] ;
     $title=$row['title'];
     $image_name=$row['image_name'] ;
     ?>
          <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
            <div class="box-3 float-container">
                <?php //check image is available or not
                      if($image_name=="")
                      {
                             echo "<div class='error'>image is not available</div>";
                      }
                      else
                      {  //image available
                        ?>
                         <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
     
                        <?php
                      }
                ?>

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>

     <?php
     }}


     else{
        //category not available
         echo "<div class='error'>No category added.</div>";
     }
     ?>
            

          


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php  include('partials-front/footer.php');?>