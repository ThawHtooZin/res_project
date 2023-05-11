<?php include 'partials/menu.php'; ?>
<?php include 'config/connect.php'; ?>

  <?php
  $stmt = $pdo->prepare("SELECT * FROM tbl_category WHERE id=" . $_GET['id']);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on <a href="#" class="text-white">"<?php echo $data['title']; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $stmt = $pdo->prepare("SELECT * FROM tbl_food WHERE category_id=".$data['id']);
            $stmt->execute();
            $fooddatas = $stmt->fetchall();
            ?>
            <?php
            foreach ($fooddatas as $fooddata) {
            ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="admin/image/<?php echo $fooddata['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4><?php echo $fooddata['title']; ?></h4>
                    <p class="food-price"><?php echo $fooddata['price']; ?>ks</p>
                    <p class="food-detail">
                        <?php echo $fooddata['description']; ?>
                    </p>
                    <br>

                    <a href="order.php?id=<?php echo $fooddata['id']; ?>" class="btn btn-primary">Order Now</a>
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
