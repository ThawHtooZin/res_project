<?php include 'partials/menu.php'; ?>
<?php include 'config/connect.php'; ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM tbl_category");
            $stmt->execute();
            $datas = $stmt->fetchall();
            foreach ($datas as $data) {
            ?>
            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="admin/image/<?php echo $data['image_name'] ?>" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>
            <?php
          }
          ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include 'partials/footer.php'; ?>
