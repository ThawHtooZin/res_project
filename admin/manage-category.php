<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
    <div class="main-content">
      <div class="wrapper">
        <h1>Manage Category</h1>
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
        <?php
        $stmt = $pdo->prepare("SELECT * FROM tbl_category");
        $stmt->execute();
        $datas = $stmt->fetchall();
        ?>
        <br><br>
        <!-- button to add admin -->
        <a href="add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>
        <table class="tbl-full" width="100%">
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Action</th>
          </tr>
          <?php
          foreach ($datas as $data) {
            ?>
            <tr>
              <td><?php echo $data['id']; ?></td>
              <td><?php echo $data['title'] ?></td>
              <td><img src="image/<?php echo $data['image_name']; ?>" alt="" width="100" height="100"></td>
              <td><?php echo $data['featured'] ?></td>
              <td><?php echo $data['active'] ?></td>
              <td>
                <a href="#" class="btn btn-secondary">Update User</a>
                <a href="#" class="btn btn-danger">Delete User</a>
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
