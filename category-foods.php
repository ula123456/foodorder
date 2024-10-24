<?php ob_start(); ?>
<?php include('partial-frontend/menu.php'); ?>
<?php

if (isset($_GET['category_id'])) 
{
            $category_id = $_GET['category_id'];


            $ress = $db->query("SELECT * FROM tbl_category WHERE id= $category_id ");
            $ress->execute();
            $row = $ress->fetch();
           
            $category_title = $row['title'];
                            
          
}
else
{
    header('Location:'.SITEURL);
}

 ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
  $res2 = $db->prepare("SELECT count(*) FROM tbl_food WHERE category=$category_id ");
                  $res2->execute();
        $count2 = $res2->fetchColumn();


        if ($count2>0) 
        {
            $ress = $db->query("SELECT * FROM tbl_food WHERE category=$category_id ");
            $ress->execute();
            

           while ($row2 = $ress->fetch()) 
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $descrition = $row2['descrition'];
                    $image_name = $row2['image_name'];
?> 
                <div class="food-menu-box">
                    <div class="food-menu-img">
                     <?php 
                     if($image_name =="")
                            {
                              echo "<div class='error'>Image not aviable</div>";  
                                
                            }
                            else
                            {
                                ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
 <?php 
                            } 

                      ?>   
                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $descrition; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
     <?php            }  

        }
        else
        { ?>
            echo "<div class='error'>Category not added.</div>";
     <?php    }

            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partial-frontend/footer.php'); ?>