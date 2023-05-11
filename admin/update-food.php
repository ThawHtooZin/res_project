<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
$stmt = $pdo->prepare("SELECT * FROM tbl_food WHERE id=".$_GET['id']);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if($_POST){
  if(empty($_POST['title']) || empty($_POST['description']) || empty($_POST['price'])){
      if(empty($_POST['title'])){
        $titleerror = "The Title field is required";
      }
      if(empty($_POST['description'])){
        $descerror = "The Description field is required";
      }
      if(empty($_POST['price'])){
        $priceerror = "The Price field is required";
      }
  }else{
    if(!empty($_FILES['image']['name'])){
      $file = 'image/'. ($_FILES['image']['name']);
      $imageType = pathinfo($file, PATHINFO_EXTENSION);

      if($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png'){
        echo "<script>alert('Image should be jpg, jpeg, png');</script>";
      }else{
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        move_uploaded_file($_FILES['image']['tmp_name'], $file);

        $stmt = $pdo->prepare("UPDATE tbl_food SET title='$title', description='$description', price='$price', image_name='$image', featured='$featured', active='$active' WHERE id=".$_GET['id']);
        $stmt->execute();

        if($stmt){
          echo "<script>alert('Category updated successfully')</script>";
          header('location:manage-category.php');
          $_SESSION['update'] = "Category Has Been Updated Successfully";
        }else{
          echo "<script>alert('category updating had an error')</script>";
        }
      }
    }else{
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];
      $stmt = $pdo->prepare("UPDATE tbl_food SET title='$title', description='$description', price='$price', featured='$featured', active='$active' WHERE id=".$_GET['id']);
      $stmt->execute();

      if($stmt){
        echo "<script>alert('Food updated successfully')</script>";
        header('location:manage-food.php');
        $_SESSION['update'] = "Food Has Been Updated Successfully";
      }else{
        echo "<script>alert('food updating had an error')</script>";
      }
    }
  }
}


?>
    <div class="main-content">
      <div class="wrapper">

        <div class="card">
          <div class="card-header">
            <h1>Update Food</h1>
          </div>
          <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
          <div class="card-body">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Your Title" required value="<?php echo $data['title']; ?>">
            <p class="text-danger"><?php if(!empty($titleerror)){echo $titleerror;} ?></p>
            <label>Description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter Your Title" required value="<?php echo $data['description']; ?>">
            <p class="text-danger"><?php if(!empty($descerror)){echo $descerror;} ?></p>
            <label>Price</label>
            <input type="number" name="price" class="form-control" placeholder="Enter Your Title" required value="<?php echo $data['price']; ?>">
            <p class="text-danger"><?php if(!empty($priceerror)){echo $priceerror;} ?></p>
            <label>Image Name</label>
            <input type="file" name="image" class="form-control">
            <img src="image/<?php echo $data['image_name'] ?>" alt="" width="100" height="100%">
            <br>
            <label>Featured</label>
            <select class="form-control" name="featured">
              <option value="yes" <?php if($data['featured'] == 'yes'){echo "selected";} ?>>Yes</option>
              <option value="no" <?php if($data['featured'] == 'no'){echo "selected";} ?>>No</option>
            </select>
            <label>Active</label>
            <select class="form-control" name="active">
              <option value="yes" <?php if($data['active'] == 'yes'){echo "selected";} ?>>Yes</option>
              <option value="no" <?php if($data['active'] == 'no'){echo "selected";} ?>>No</option>
            </select>
          </div>
          <div class="card-footer">
            <div class="row">
              <button type="submit" class="btn btn-warning">Update Food</button>
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
