<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
    <div class="main-content">
      <div class="wrapper">
        <h1>Manage Admin</h1>
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
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br><br>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM tbl_admin");
        $stmt->execute();
        $datas = $stmt->fetchall();
        ?>
        <table class="tbl-full" width="100%">
          <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
          <?php
          foreach ($datas as $data) {
            ?>
            <tr>
              <td><?php echo $data['id']; ?></td>
              <td><?php echo $data['full_name']; ?></td>
              <td><?php echo $data['username']; ?></td>
              <td>
                <a href="update-password.php?id=<?php echo $data['id']; ?>" class="btn-primary">Update Password</a>
                <a href="update-admin.php?id=<?php echo $data['id']; ?>" class="btn-secondary2">Update User</a>
                <a href="delete-admin.php?id=<?php echo $data['id'];?>" class="btn-danger2">Delete User</a>
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
