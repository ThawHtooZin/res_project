
<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>

    <div class="main-content">
      <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
        // Category Count
        $categorystmt = $pdo->prepare("SELECT COUNT(*) as row_count FROM tbl_category");
        $categorystmt->execute();
        $categorydata = $categorystmt->fetch(PDO::FETCH_ASSOC);

        // Food Count
        $foodstmt = $pdo->prepare("SELECT COUNT(*) as row_count FROM tbl_food");
        $foodstmt->execute();
        $fooddata = $foodstmt->fetch(PDO::FETCH_ASSOC);

        // Order Count
        $orderstmt = $pdo->prepare("SELECT COUNT(*) as row_count FROM tbl_order");
        $orderstmt->execute();
        $orderdata = $orderstmt->fetch(PDO::FETCH_ASSOC);

        // Food Count
        $pricestmt = $pdo->prepare("SELECT SUM(price) as PRICE FROM tbl_order");
        $pricestmt->execute();
        $pricedata = $pricestmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="col-4 text-center">
          <a href="manage-category.php" style="text-decoration:none; color:black;">
            <h1><?php echo $categorydata['row_count']; ?></h1>
            Categories
          </a>
        </div>
        <div class="col-4 text-center">
          <a href="manage-food.php" style="text-decoration:none; color:black;">
            <h1><?php echo $fooddata['row_count']; ?></h1>
          Foods
          </a>
        </div>
        <div class="col-4 text-center">
          <a href="manage-order.php" style="text-decoration:none; color:black;">
          <h1><?php echo $orderdata['row_count']; ?></h1>
          Total Orders
          </a>
        </div>
        <div class="col-4 text-center">
          <a href="manage-order.php" style="text-decoration:none; color:black;">
          <h1><?php echo $pricedata['PRICE']; ?>ks</h1>
          Revenue Generated
          </a>
        </div>
        <div class="clearfix">

        </div>
      </div>
    </div>

    <?php
    include 'partials/footer.php';
    ?>
