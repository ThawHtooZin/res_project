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

    <!-- CAtegories Section Starts Here -->
    <?php
    $stmt = $pdo->prepare("SELECT * FROM tbl_category");
    $stmt->execute();
    $datas = $stmt->fetchall();
    ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            foreach ($datas as $data) {

            ?>
            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="admin/image/<?php echo $data['image_name']; ?>" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white"><?php echo $data['title']; ?></h3>
            </div>
            </a>
            <?php
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include 'partials/footer.php'; ?>
