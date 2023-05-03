<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
if($_POST){
  if(empty($_POST['title'])|| empty($_FILES['image']['name'])){
    if(empty($_POST['title'])){
      $titleerror = "The Title field is required";
    }
    if(empty($_POST['image']['name'])){
      $imageerror = "The Image field is required";
    }
  }else{

    $file = 'image/'. ($_FILES['image']['name']);
    $imageType = pathinfo($file, PATHINFO_EXTENSION);

    if($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png'){
      echo "<script>alert('Image should be jpg, jpeg, png');</script>";
    }else{
      $title = $_POST['title'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];
      $image = $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $file);
      $stmt = $pdo->prepare("INSERT INTO tbl_category(title, image_name, featured, active) VALUES('$title', '$image', '$featured', '$active')");
      $stmt->execute();

      if($stmt){
        echo "<script>alert('Category added successfully')</script>";
        header('location:manage-category.php');
        $_SESSION['add'] = "Category Has Been Added Successfully";
      }else{
        echo "<script>alert('Category adding had an error')</script>";
      }
    }
  }
}
?>
    <div class="main-content">
      <div class="wrapper">

        <div class="card">
          <div class="card-header">
            <h1>Add Category</h1>
          </div>
          <form action="add-category.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
          <div class="card-body">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Your Title" required>
            <p class="text-danger"><?php if(!empty($titleerror)){echo $titleerror;} ?></p>
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
            <p class="text-danger"><?php if(!empty($imageerror)){echo $imageerror;} ?></p>
            <label>Featured</label>
            <select class="form-control" name="featured">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
            <label>Active</label>
            <select class="form-control" name="active">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
          <div class="card-footer">
            <div class="row">
              <button type="submit" class="btn btn-primary">Add Category</button>
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
