<?php
include 'partials/menu.php';
?>
<?php
if($_POST){
  if(empty($_POST['current'])|| empty($_POST['newpass']) || empty($_POST['rewritepass'])){
    if(empty($_POST['current'])){
      $currenterror = "The Current Password field is required";
    }
    if(empty($_POST['newpass'])){
      $newpasserror = "The New Password field is required";
    }
    if(empty($_POST['rewritepass'])){
      $rewritepasserror = "The Rewrite Password field is required";
    }
  }else{
    $current = $_POST['current'];
    $newpass = $_POST['newpass'];
    $rewritepass = $_POST['rewritepass'];

    $stmt = $pdo->prepare("SELECT password FROM tbl_admin WHERE id=".$_GET['id']);
    $stmt->execute();
    $passdata = $stmt->fetch(PDO::FETCH_ASSOC);

    if($current == $passdata['password']){
      if($newpass == $rewritepass){
        $password = $newpass;
        $stmt = $pdo->prepare("UPDATE tbl_admin SET password='$password' WHERE id=".$_GET['id']);
        $stmt->execute();

        if($stmt){
          echo "<script>alert('password updated successfully')</script>";
          header('location:manage-admin.php');
          $_SESSION['update'] = "Password Has Been Updated Successfully";
        }else{
          echo "<script>alert('password updating had an error')</script>";
        }
      }else{
        $error = "Rewrite Password must be same as New Password";
      }
    }else{
      $error = "Wrong Current Password";
    }
  }
}
$stmt = $pdo->prepare("SELECT * FROM tbl_admin");
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
            <h5>Username : <?php echo $data['username']; ?></h5>
            <label>Current Password</label>
            <input type="text" name="current" class="form-control" placeholder="Enter the Current Password" required>
            <p class="text-danger"><?php if(!empty($currenterror)){echo $currenterror;} ?></p>
            <label>New Password</label>
            <input type="password" name="newpass" class="form-control" placeholder="Enter the New Password" required>
            <p class="text-danger"><?php if(!empty($newpasserror)){echo $newpasserror;} ?></p>
            <label>Re Write The Password</label>
            <input type="password" name="rewritepass" class="form-control" placeholder="Rewrite the Password" required>
            <p class="text-danger"><?php if(!empty($rewritepasserror)){echo $rewritepasserror;} ?></p>
            <p class="text-danger"><?php if(!empty($error)){echo $error;} ?></p>
          </div>
          <div class="card-footer">
            <div class="row">
              <button type="submit" class="btn btn-warning">Update Password</button>
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
