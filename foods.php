<?php include 'partials/menu.php'; ?>
<?php include 'config/connect.php'; ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

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

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
          }
          ?>


            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include 'partials/footer.php'; ?>
