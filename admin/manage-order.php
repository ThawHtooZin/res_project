<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
if($_POST){
  if(!empty($_POST['search'])){
    if($_POST['search']){
      setcookie('search', $_POST['search'], time() + (87400 * 36), "/");
    }
  }else{
      if(empty($_GET['pageno'])){
        unset($_COOKIE['search']);
        setcookie('search', null, -1, '/');
      }
  }
}
?>
<?php
  if (!empty($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  }else{
    $pageno = 1;
  }
  $numOfrecs = 3;
  $offset = ($pageno -1) * $numOfrecs;

  if (empty($_POST['search']) && empty($_COOKIE['search'])) {
    $stmt = $pdo->prepare("SELECT * FROM tbl_order ORDER BY id DESC");
    $stmt->execute();
    $rawResult = $stmt->fetchAll();
    $total_pages = ceil(count($rawResult) / $numOfrecs);

    $stmt = $pdo->prepare("SELECT * FROM tbl_order ORDER BY id DESC LIMIT $offset,$numOfrecs ");
    $stmt->execute();
    $datas = $stmt->fetchAll();
  }else{
      if(!empty($_POST['search'])){
        $searchkey = $_POST['search'];
      }else{
        $searchkey = $_COOKIE['search'];
      }

      $stmt = $pdo->prepare("SELECT * FROM tbl_order WHERE customer_name LIKE '%$searchkey%' ORDER BY id DESC");
      $stmt->execute();
      $rawResult = $stmt->fetchAll();
      $total_pages = ceil(count($rawResult) / $numOfrecs);

      $stmt = $pdo->prepare("SELECT * FROM tbl_order WHERE customer_name LIKE '%$searchkey%' ORDER BY id DESC LIMIT $offset,$numOfrecs ");
      $stmt->execute();
      $datas = $stmt->fetchAll();

  }

?>
    <div class="main-content">
      <div class="wrapper">
        <div class="row">
          <div class="col">
            <h1>Manage Order</h1>
          </div>
          <div class="col">
            <form action="manage-order.php" method="post">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" name="button" class="btn btn-secondary">Search</button>
                </span>
              </div>
            </form>
          </div>
        </div>

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
        <div aria-label="Page navigation example" style="float:right;">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
            <li class="page-item <?php if($pageno <= 1){echo 'disabled';} ?>">
              <a class="page-link" href="<?php if($pageno <= 1){echo '#';} else {echo "?pageno=".($pageno-1);} ?>">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
            <li class="page-item <?php if($pageno >= $total_pages){echo 'disabled';}; ?>">
              <a class="page-link" href="<?php if($pageno >= $total_pages){echo '#';}else{echo "?pageno=".($pageno+1);} ?>">Next</a>
            </li>
            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a> </li>
          </ul>
        </div>
      </div>

        </div>
      </div>
    </div>

    <?php
    include 'partials/footer.php';
    ?>
