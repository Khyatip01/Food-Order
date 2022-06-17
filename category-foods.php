<?php  include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
              if(isset($_GET['category_id']))
              {
                $category_id=$_GET['category_id'];
                //get the categorytitle based on id
                $sql="SELECT title FROM tbl_category WHERE id=$category_id";
                $res=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($res);
                $category_title=$row['title'];
              }
              else
              {
                header('location:'.SITEURL);
              }
        ?>
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

$sql2="SELECT *FROM tbl_food  WHERE category_id=$category_id ";
$res2=mysqli_query($conn,$sql2);
$count=mysqli_num_rows($res2);

$sn=1;
if($count>0){
   while($row=mysqli_fetch_assoc($res2))
   {
     $id=$row['id'] ;
     $title=$row['title'];
     $price=$row['price'] ;
     $description=$row['description'] ;
     $image_name=$row['image_name'] ;
     ?>

                <div class="food-menu-box">
                <div class="food-menu-img">
                <?php //check image is available or not
                      if($image_name=="")
                      {
                             echo "<div class='error'>image is not available</div>";
                      }
                      else
                      {  //image available
                        ?>
                         <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
     
                        <?php
                      }
                ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
                </div>
     <?php
     }
    }


     else{
        //category not available
         echo "<div class='error'>No food added.</div>";
     }
     ?>
         <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php  include('partials-front/footer.php');?>