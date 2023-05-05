<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
$stmt = $pdo->prepare("SELECT * FROM tbl_order");
$stmt->execute();
$datas = $stmt->fetchall();
?>
    <div class="main-content">
      <div class="wrapper">
        <h1>Manage Order</h1>

        <br><br><br>
        <table class="tbl-full" width="100%">
          <tr>
            <th>Id</th>
            <th>Food</th>
            <th>Price</th>
            <th>Quentity</th>
            <th>Total Price</th>
            <th>Order_date</th>
            <th>Status</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
          <?php
          foreach ($datas as $data) {
            ?>

            <tr>
              <td style="padding-left: 10px;"><?php echo $data['id']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['food']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['price']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['qty']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['total']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['order_date']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['status']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['customer_name']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['customer_contact']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['customer_email']; ?></td>
              <td style="padding-left: 10px;"><?php echo $data['customer_address']; ?></td>
              <td>
                <a href="update-order.php?id=<?php echo $data['id']; ?>" class="btn btn-secondary">Update Order</a>
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
