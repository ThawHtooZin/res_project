
<?php
include 'partials/menu.php';
?>
  <?php
    if($_POST){
      if(empty($_POST['username']) || empty($_POST['password'])){
        if(empty($_POST['username'])){
          $usererror = "The Username field is required";
        }
        if(empty($_POST['password'])){
          $passerror = "The Password field is required";
        }
      }else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE username='$username'");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($password == $data['password']){
          header('location:manage-admin.php');
          $_SESSION['login'] = "Login Successful";
          $_SESSION['user_id'] = $data['id'];
          $_SESSION['logged_in'] = true;
        }
      }
    }
  ?>
    <div class="main-content">
        <div class="container">
          <div class="card">
            <div class="card-header">
              <h4>Login Page</h4>
            </div>
            <div class="card-body">
              <form action="login.php" method="post">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Your Username">
                <p class="text-danger"><?php if(!empty($usererror)){echo $usererr;} ?></p>
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
                <p class="text-danger"><?php if(!empty($passerror)){echo $passerror;} ?></p>
            </div>
            <div class="card-footer">
              <div class="row">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </div>
          </form>
          </div>
        </div>
    </div>

    <?php
    include 'partials/footer.php';
    ?>
