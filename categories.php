<?php include('partial-frontend/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            $res = $db->prepare("SELECT count(*) FROM tbl_category ");
                  $res->execute();
        $count = $res->fetchColumn();


        if ($count>0) 
        {
            $ress = $db->query("SELECT * FROM tbl_category WHERE active ='Yes' ");
            $ress->execute();
            

           while ($row = $ress->fetch()) 
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
?> 
                        <a href="category-foods.php">
                            <div class="box-3 float-container">
<?php   if($image_name =="")
        {echo "<div class='error'>Image not foud</div>";                            
  } else {?>
                                 <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
 <?php   } ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                         </a>
<?php
                }  

        }
        else
        {
            echo "<div class='error'>Category not aviable.</div>";
        }

?>

             ?>

             

                
            
                      
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partial-frontend/footer.php'); ?>