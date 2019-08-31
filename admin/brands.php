<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/Habitual/core/dbh.php';
include 'includes/head.php';
include 'includes/nav.php';

//Get brands from database
$sql = "SELECT * FROM brand ORDER BY brand";
$results = $dbh->query($sql);
$errors = array();

//Edit BRAND
// if(isset($_GET['edit']) && !empty($_GET['edit'])){
//   $edit_id = (int)$_GET['edit'];
//   $edit_id = sanitize($edit_id);
//   $sql = "SELECT * FROM brand WHERE id = '$edit_id'";
//   $edit_result = $dbh->query($sql);
//   $eBrand = mysqli_fetch_assoc($edit_result);
// }

//Delete Brand
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id = (int)$_GET['delete'];
  $delete_id = sanitize($delete_id);
  $sql2 = "DELETE FROM brand WHERE id = '$delete_id'";
  $dbh->query($sql2);
  header('Location: brands.php');
}

//If add form is submitted
if (isset($_POST['add_submit'])) {
  $brand = sanitize($_POST['brand']);
  //Check if brand is blank
  if ($_POST['brand'] == '') {
    $errors[] .= 'You must enter a brand!';
  }
  //check if brand exist in Database
  $sql ="SELECT * FROM brand WHERE brand ='$brand'";
  $result = $dbh->query($sql);
  $count = mysqli_num_rows($result);
  if($count > 0){
    $errors[] .= $brand.' already exist, Please choose another brand name..';
  }

  //display $errors
  if(!empty($errors)){
    echo display_errors($errors);
  }else{
    //ADD BRAND TO DATABASE
    $sql = "INSERT INTO brand (brand) VALUES ('$brand')";
    $result = $dbh->query($sql);
    header('Location: brands.php');
  }
}

 ?>
<h2 class="text-center">Brands</h2><hr>
<!-- Brand form -->
<div class="row">
<div class="col-md-4">
</div>
<div class="col-sm-12 col-md-4">
<div class="text-center">
  <form class="form-inline" action="brands.php" method="post">
    <div class="form-group text-center mobBrand">
      <label class="text-center" for="brand">Add a Brand:</label>
      <input type="text" name="brand" id="brand" class="form-control form-brand" value="<?= ((isset($_POST['brand']))?$_POST['brand']:''); ?>">
      <input type="submit" name="add_submit" value="Add Brand" class="btn btn-success">
    </div>
  </form>
  </div>
</div>
<div class="col-md-4">
</div>

</div>
<table class="table table-bordered table-striped table-auto table-condensed">
  <thead>
    <th></th><th>Brand</th><th></th>
  </thead>
  <tbody>
<?php while($brand = mysqli_fetch_assoc($results)) : ?>
    <tr>
      <td><a href="brands.php?edit=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><span>Edit</span></a></td>
      <td><?=$brand['brand'];?></td>
      <td><a href="brands.php?delete=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><span>Delete</span></a></td>
    </tr>
<?php endwhile; ?>
  </tbody>
</table>


<?php include 'includes/footer.php'; ?>
