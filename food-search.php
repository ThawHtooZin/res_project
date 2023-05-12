<?php include 'partials/menu.php'; ?>
<?php include 'config/connect.php'; ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $_POST['search']; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $search = $_POST['search'];
            $stmt = $pdo->prepare("SELECT * FROM tbl_food WHERE title LIKE '%$search%' ");
            $stmt->execute();
            $datas = $stmt->fetchall();
            foreach ($datas as $data) {
              ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="admin/image/<?php echo $data['image_name'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $data['title']; ?></h4>
                    <p class="food-price"><?php echo $data['price']; ?>ks</p>
                    <p class="food-detail">
                        <?php echo $data['description'] ?>
                    </p>
                    <br>
                    <a href="order.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Order Now</a>
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
