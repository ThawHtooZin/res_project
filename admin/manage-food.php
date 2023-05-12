<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
    <div class="main-content">
      <div class="wrapper">
        <h1>Manage Food</h1>
        <?php if(!empty($_SESSION['add'])){
          ?>
          <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $_SESSION['add']; ?>
          </div>
          <?php
          unset($_SESSION['add']);
        } ?>
        <?php if(!empty($_SESSION['remove'])){
          ?>
          <div class="alert alert-warning">
            <strong>Success!</strong> <?php echo $_SESSION['remove']; ?>
          </div>
          <?php
          unset($_SESSION['remove']);
        } ?>
        <?php if(!empty($_SESSION['update'])){
          ?>
          <div class="alert alert-warning">
            <strong>Success!</strong> <?php echo $_SESSION['update']; ?>
          </div>
          <?php
          unset($_SESSION['update']);
        } ?>
        <?php if(!empty($_SESSION['login'])){
          ?>
          <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $_SESSION['login']; ?>
          </div>
          <?php
          unset($_SESSION['login']);
        } ?>
        <br><br>
        <!-- button to add admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>
        <table class="tbl-full" width="100%">
          <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Action</th>
          </tr>
          <tr>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM tbl_food");
            $stmt->execute();
            $datas = $stmt->fetchall();
            foreach ($datas as $data) {

            ?>
            <?php
            $stmt2 = $pdo->prepare("SELECT * FROM tbl_category WHERE id=".$data['category_id']);
            $stmt2->execute();
            $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
             ?>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['title'] ?></td>
            <td><?php echo $data['description']; ?></td>
            <td><?php echo $data['price']; ?></td>
            <td><img src="image/<?php echo $data['image_name']; ?>" alt="" width="100" height="100"></td>
            <td><?php echo $data2['title']; ?></td>
            <td><?php echo $data['featured']; ?></td>
            <td><?php echo $data['active']; ?></td>
            <td>
              <a href="update-food.php?id=<?php echo $data['id']; ?>" class="btn btn-secondary">Update Food</a>
              <a href="delete-food.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete Food</a>
            </td>
          </tr>
          <?php
          }
          ?>

        </table>

        </div>
      </div>
    </div>

    <?php
    include 'partials/footer.php';
    ?>
