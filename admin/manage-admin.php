<?php
include 'partials/menu.php';
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
                <a href="#" class="btn-secondary2">Update User</a>
                <a href="#" class="btn-danger2">Delete User</a>
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
