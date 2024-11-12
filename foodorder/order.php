<?php ob_start(); ?>
<?php session_start(); ?>
<?php include('partial-frontend/menu.php'); ?>
<?php 

if (isset($_GET['food_id'])) 
{
    $food_id = $_GET['food_id'];

            $res = $db->prepare("SELECT count(*) FROM tbl_food WHERE id=$food_id ");
                        $res->execute();
            $count = $res->fetchColumn();


        if ($count==1) 
        {
            $ress = $db->query("SELECT * FROM tbl_food WHERE id=$food_id ");
            $ress->execute();
            $row = $ress->fetch();

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('Location:'.SITEURL); 
        }

}
else
{
   header('Location:'.SITEURL);   
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;  ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;  ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ula" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. ula@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php

            if (isset($_POST['submit'])) 
            {
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price*$qty;

                $order_date = date("Y-m-d h:i:");

                $status = "Ordered";
               echo $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

   $sql = "INSERT INTO `tbl_order` 
      ( food,
        price,
        qty, 
        total, 
        order_date,
        status,
        customer_name,
        customer_contact,
        customer_email, 
        customer_address)
       VALUES('$food',
       '$price', 
       '$qty', 
       '$total', 
       '$order_date', 
       '$status', 
       '$customer_name', 
       '$customer_contact', 
       '$customer_email', 
       '$customer_address' )";
    
    $res = $db->prepare($sql);
    $res->execute();
    

   
                      
    
           
            if ($res==true) 
            {
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered successfuly.</div>";
                
                header('Location: '.SITEURL);
                
            }
            else
            {
                $_SESSION['order'] = "<div class='success text-center'>feiled Food Ordered .</div>";
                
                header('Location: '.SITEURL);

            }


            }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partial-frontend/footer.php'); ?>