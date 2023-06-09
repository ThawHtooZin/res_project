<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
if($_POST){
  if(empty($_POST['full_name'])|| empty($_POST['username']) || empty($_POST['password'])){
    if(empty($_POST['full_name'])){
      $fullnameerror = "The Full_name field is required";
    }
    if(empty($_POST['username'])){
      $usererror = "The Username field is required";
    }
    if(empty($_POST['password'])){
      $passerror = "The Password field is required";
    }
  }else{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("UPDATE tbl_admin SET full_name='$full_name', username='$username', password='$password' WHERE id=".$_GET['id']);
    $stmt->execute();

    if($stmt){
      echo "<script>alert('admin updated successfully')</script>";
      header('location:manage-admin.php');
      $_SESSION['update'] = "Admin Has Been Updated Successfully";
    }else{
      echo "<script>alert('admin updating had an error')</script>";
    }
  }
}

$stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE id=".$_GET['id']);
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
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="Enter Your Full Name" required value="<?php echo $data['full_name']; ?>">
            <p class="text-danger"><?php if(!empty($fullnameerror)){echo $fullnameerror;} ?></p>
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Your Username" required value="<?php echo $data['username']; ?>">
            <p class="text-danger"><?php if(!empty($usererror)){echo $usererror;} ?></p>
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required value="<?php echo $data['password']; ?>">
            <p class="text-danger"><?php if(!empty($usererror)){echo $passerror;} ?></p>
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
