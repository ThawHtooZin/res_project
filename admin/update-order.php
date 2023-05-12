<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
if($_POST){
  if(empty($_POST['food']) || empty($_POST['price']) || empty($_POST['qty']) || empty($_POST['total_price']) || empty($_POST['status']) || empty($_POST['name']) || empty($_POST['contact']) || empty($_POST['email']) || empty($_POST['address'])){
    if(empty($_POST['food'])){
      $fooderror = "The Food field is required";
    }
    if(empty($_POST['price'])){
      $priceerror = "The Price field is required";
    }
    if(empty($_POST['qty'])){
      $quentityerror = "The Quantity field is required";
    }
    if(empty($_POST['total_price'])){
      $total_priceerror = "The Total Price field is required";
    }
    if(empty($_POST['status'])){
      $statuserror = "The Status field is required";
    }
    if(empty($_POST['name'])){
      $nameerror = "The Name field is required";
    }
    if(empty($_POST['contact'])){
      $contacterror = "The Contact field is required";
    }
    if(empty($_POST['email'])){
      $emailerror = "The Email field is required";
    }
    if(empty($_POST['address'])){
      $addresserror = "The Address field is required";
    }
  }else{
    $food = $_POST['food'];
    $price = $_POST['price'];
    $quentity = $_POST['qty'];
    $total_price = $quentity * $price;
    $status = $_POST['status'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("UPDATE tbl_order SET food='$food',price='$price', qty='$quentity', total='$total_price', order_date='$order_date', status='$status', customer_name='$name', customer_contact='$contact', customer_email='$email', customer_address='$address' WHERE id=".$_GET['id']);
    $stmt->execute();

    if($stmt){
      echo "<script>alert('Order updated successfully')</script>";
      header('location:manage-order.php');
      $_SESSION['update'] = "Order Has Been Updated Successfully";
    }else{
      echo "<script>alert('Order updating had an error')</script>";
    }
  }
}

$stmt = $pdo->prepare("SELECT * FROM tbl_order WHERE id=".$_GET['id']);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="main-content">
      <div class="wrapper">

        <div class="card">
          <div class="card-header">
            <h1>Update Admin</h1>
          </div>
          <form action="" method="post" autocomplete="off">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
          <div class="card-body">
            <label>Food</label>
            <input type="text" name="food" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['food']; ?>">
            <p class="text-danger"><?php if(!empty($fooderror)){echo $fooderror;} ?></p>
            <label>Price</label>
            <input type="text" name="price" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['price']; ?>">
            <p class="text-danger"><?php if(!empty($priceerror)){echo $priceerror;} ?></p>
            <label>Quentity</label>
            <input type="text" name="qty" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['qty']; ?>">
            <p class="text-danger"><?php if(!empty($quentityerror)){echo $quentityerror;} ?></p>
            <label>Total_Cost</label>
            <input type="text" name="total_price" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['total']; ?>">
            <p class="text-danger"><?php if(!empty($total_priceerror)){echo $total_priceerror;} ?></p>
            <label>status</label>
            <select class="form-control" name="status">
              <option value="reserved">Reserved</option>
              <option value="canceled">Canceled</option>
            </select>
            <p class="text-danger"><?php if(!empty($statuserror)){echo $statuserror;} ?></p>
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['customer_name']; ?>">
            <p class="text-danger"><?php if(!empty($nameerror)){echo $nameerror;} ?></p>
            <label>Contact</label>
            <input type="text" name="contact" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['customer_contact']; ?>">
            <p class="text-danger"><?php if(!empty($contacterror)){echo $contacterror;} ?></p>
            <label>Email</label>
            <input type="text" name="email" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['customer_email']; ?>">
            <p class="text-danger"><?php if(!empty($emailerror)){echo $emailerror;} ?></p>
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['customer_address']; ?>">
            <p class="text-danger"><?php if(!empty($addresserror)){echo $addresserror;} ?></p>
          </div>
          <div class="card-footer">
            <div class="row">
              <button type="submit" class="btn btn-warning">Update Admin</button>
            </div>
          </div>
        </form>
        </div>


        </div>
      </div>
    </div>

    <?php
    include 'partials/footer.php';
    ?>
