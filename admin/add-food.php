<?php
include 'partials/menu.php';
require 'config/userauth.php';
?>
<?php
if($_POST){
  if(empty($_POST['title']) || empty($_POST['description']) || empty($_POST['price']) || empty($_FILES['image']['name'])){
    if(empty($_POST['title'])){
      $titleerror = "The Title field is required";
    }
    if(empty($_POST['description'])){
      $descerror = "The Description field is required";
    }
    if(empty($_POST['price'])){
      $priceerror = "The Price field is required";
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
      $description = $_POST['description'];
      $price = $_POST['price'];
      $image = $_FILES['image']['name'];
      $category = $_POST['category_id'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];
      move_uploaded_file($_FILES['image']['tmp_name'], $file);
      $stmt = $pdo->prepare("INSERT INTO tbl_food(title, description, price, image_name, category_id, featured, active) VALUES('$title','$description','$price', '$image', '$category', '$featured', '$active')");
      $stmt->execute();

      if($stmt){
        echo "<script>alert('Category added successfully')</script>";
        header('location:manage-food.php');
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
            <h1>Add Food</h1>
          </div>
          <form action="add-food.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
          <div class="card-body">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Your Title" required>
            <p class="text-danger"><?php if(!empty($titleerror)){echo $titleerror;} ?></p>
            <label>Description</label>
            <textarea name="description" rows="3" class="form-control" placeholder="Enter Your Description"></textarea>
            <p class="text-danger"><?php if(!empty($descerror)){echo $descerror;} ?></p>
            <label>Price</label>
            <input type="number" name="price" class="form-control" placeholder="Enter Your Price">
            <p class="text-danger"><?php if(!empty($priceerror)){echo $priceerror;} ?></p>
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
            <p class="text-danger"><?php if(!empty($imageerror)){echo $imageerror;} ?></p>
            <label>Category</label>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM tbl_category");
            $stmt->execute();
            $datas = $stmt->fetchall();
            ?>
            <select class="form-control" name="category_id">
              <?php
              foreach ($datas as $data) {

              ?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['title']; ?></option>
              <?php
              }
              ?>
            </select>
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
              <button type="submit" class="btn btn-primary">Add Food</button>
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
