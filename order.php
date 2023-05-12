<?php include 'partials/menu.php'; ?>
<?php include 'config/connect.php'; ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
          <?php
          if($_POST){
            if(empty($_POST['full_name']) || empty($_POST['contact']) || empty($_POST['email']) || empty($_POST['address'])){
              if(empty($_POST['full_name'])){
                $usererror = "The Full Name field is required";
              }
              if(empty($_POST['contact'])){
                $contacterror = "The Contact field is required";
              }
              if(empty($_POST['email'])){
                $emailerror = "The Email field is required";
              }
              if(empty($_POST['address'])){
                $addresserror = "The Address field is required";
              }
            }else{
              $customer_name = $_POST['full_name'];
              $customer_contact = $_POST['contact'];
              $customer_email = $_POST['email'];
              $customer_address = $_POST['address'];
              $quantity = $_POST['qty'];
              $food = $data['title'];
              $price = $data['price'];
              $totalprice = $quantity * $price;

              $stmt = $pdo->prepare("INSERT INTO tbl_order(food, price, qty, total, customer_name, customer_contact, customer_email, customer_address) VALUES('$food','$price','$quantity','$totalprice','$customer_name','$customer_contact','$customer_email','$customer_address')");
              $stmt->execute();
              if($stmt){
                echo "<script>alert('Your order have been ordered'); window.location.href = 'index.php'</script>";
              }else{
                echo "<script>alert('Your order can't been order because of an error'); window.location.href = 'index.php'</script>";
              }
            }
          }
          ?>
            <h2 class="text-center text-white">Fill the form and at the food to your card.</h2>

            <form action="" class="order" method="post">

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="Enter Your Name" class="input-responsive" >
                    <p style="color:red;"><?php if(!empty($usererror)){echo $usererror;} ?></p>
                    <br>
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your Number" class="input-responsive" >
                    <p style="color:red;"><?php if(!empty($contacterror)){echo $contacterror;} ?></p>
                    <br>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" >
                    <p style="color:red;"><?php if(!empty($emailerror)){echo $emailerror;} ?></p>
                    <br>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Your Address" class="input-responsive" ></textarea>
                    <p style="color:red;"><?php if(!empty($addresserror)){echo $addresserror;} ?></p>
                    <br>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Order Now</button>
                    </div>
                </fieldset>
                
            </form>

        </div>
    </section>
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Foods</h2>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM tbl_food");
        $stmt->execute();
        $datas = $stmt->fetchall();
        foreach ($datas as $data) {
          ?>
          <div class="food-menu-box">
            <div class="food-menu-img">
              <img src="admin/image/<?php echo $data['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
              <h4><?php echo $data['title']; ?></h4>
              <p class="food-price"><?php echo $data['price']; ?>ks</p>
              <p class="food-detail">
                <?php echo $data['description']; ?>
              </p>
              <br>

              <a href="" class="btn btn-primary">Add</a>
            </div>
          </div>
          <?php
        }
        ?>


        <div class="clearfix"></div>



      </div>

    </section>
    <!-- fOOD sEARCH Section Ends Here -->


<?php include 'partials/footer.php'; ?>
