<?php include('partial-frontend/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php $search = $_POST['search']; ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 

             $res = $db->prepare("SELECT count(*) FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'  ");
                        $res->execute();
            $count = $res->fetchColumn();


        if ($count>0) 
        {
            $ress = $db->query("SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ");
            $ress->execute();
            
        
                while ($row = $ress->fetch()) 
                {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];                 ?>
                
                    <div class="food-menu-box">
                        <div class="food-menu-img"> 
                        <?php
                            if($image_name =="")
                                {
                                  echo "<div class='error'>Image not aviable</div>";  
                                    
                                }
                                else
                                { ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                         <?php  }  ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="order.html" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
<?php           }
            }
             else
            {
             echo "<div class='error'>Food not aviable</div>";  
            }
                

            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include('partial-frontend/footer.php'); ?>