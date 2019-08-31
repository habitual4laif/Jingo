<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/Habitual/core/dbh.php';
include 'includes/head.php';
include 'includes/nav.php';

if(isset($_GET['add'])){
$brandQuery = $dbh->query("SELECT * FROM brand ORDER BY brand");
$parentQuery = $dbh->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
?>
<h2 class="text-center">Add A New Product</h2>
<form class="form-" action="productsForm.php" method="post" enctype="multipart/form-data">
  <div class="container">
  <div class="row">
  <div class="form-group col-md-3">
    <label for="title">Title* :</label>
    <input type="text" name="title" class="form-control" id="tittle" value="<?=((isset($_POST['title']))?sanitize($_POST['title']):'');?>">
  </div>
  <div class="form-group col-md-3">
    <label for="brand">Brand* :</label>
    <select class="form-control" name="brand" id="brand">
      <option value=""<?=((isset($_POST['brand']) && $_POST['brand'] == '')?'selected':'');?>></option>
      <?php while ($brand = mysqli_fetch_assoc($brandQuery)): ?>
        <option value="<?=$brand['id'];?>"<?=((isset($_POST['brand']) && $_POST['brand'] == $brand['id'])?'selected':'');?>><?=$brand['brand'];?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="col-md-3 form-group">
    <label for="parent">Parent Category* :</label>
    <select class="form-control" id="parent" name="parent">
      <option value=""<?=((isset($_POST['parent']) && $_POST['parent'] == '')?'selected':'');?></option>
      <?php while ($parent = mysqli_fetch_assoc($parentQuery)): ?>
        <option value="<?=$parent['id'];?>"<?=((isset($_POST['parent']) && $_POST['parent'] == $parent['id'])?'select':'');?>><?=$parent['category'];?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="child">Child Category*:</label>
    <select class="form-control" id="child" name="child"></select>
  </div>
  <div class="form-group col-md-3">
    <label for="price">Price*:</label>
    <input type="text" name="price"  id="price" class="form-control" value="<?=((isset($_POST['price']))?sanitize($_POST['price']):'');?>">
  </div>
  <div class="form-group col-md-3">
    <label for="list_price"> List Price*:</label>
    <input type="text" name="list_price"  id="list_price" class="form-control" value="<?=((isset($_POST['list_price']))?sanitize($_POST['list_price']):'');?>">
  </div>
  <!-- <div class="form-group col-md-3">
    <label for="">Quantity & Sizes</label> -->
    <!-- <button type="button" class="btn btn-default btn-success" onclick="jQuery('#sizesModal').modal('toggle'); return false" name="button">Quantity & Sizes</button> -->

    <!-- <button type="button" class="btn btn-default btn-success" data-toggle="modal" data-target="#formModal">Quantity & Sizes</button>
  </div> -->
  <div class="form-group col-md-5">
    <label for="sizes">Qty & Sizes Preview</label>
    <input placeholder="e.g Size:Quantity, Size:Quantity, etc" type="text" class="form-control" name="sizes" id="sizes" value="<?=((isset($_POST['sizes']))?sanitize($_POST['sizes']):'');?>">
  </div>
  <form action="productsForm.php" method="post" class="form-group" enctype="multipart/form-data">
    <div class="form-group col-md-6">
      <label for="image">Product Image*:</label>
      <input type="file" name="image" id="image" class="form-control" value="">
      <button type="submit" name="submit">UPLOAD</button>
    </div>
  </form>
  <div class="form-group col-md-6">
    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="6" class="form-control"><?=((isset($_POST['description']))?sanitize($_POST['description']):'');?></textarea>
  </div>
  <div class="form-group col-md-3">
  </div>
  <div class="form-group col-md-3">
  </div>
  <div class="form-group col-md-3">
  </div>
  <div class="form-group col-md-3">
    <input type="submit" name="add_product" value="Add Product" class="form-control btn btn-success">
  </div>
</div>
</div>
</form>

<?php



// To upload filled form to database     **From Me**

if(isset($_GET['child'])){
$id = (int)$_GET['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$list_price = $_POST['list_price'];
$brand = $_POST['brand'];
$categories = $_POST['$id'];
$image = $_POST['image'];
$description = $_POST['description'];
// $featured = $_POST['featured'];
$sizes = $_POST['sizes'];


if (empty($title)){
    header("Location: product.php?error=empty");
    exit();
    }else{
        $sql = "INSERT INTO product1 (title, price, list_price, brand, categories, image, description, sizes)
        VALUES ('$title', '$price', '$list_price', '$brand', '$categories', '$image', '$description', '$sizes')";
        $result = $conn->query($sql);
          header('Location: product.php?success');
    }
}

}else{

$sql = "SELECT * FROM product1 WHERE deleted = 0";
$productresult = $dbh->query($sql);
if(isset($_GET['featured'])){
  $id = (int)$_GET['id'];
  $featured = (int)$_GET['featured'];
  $featuredSql = "UPDATE product1 SET featured = '$featured' WHERE id = '$id'";
  $dbh->query($featuredSql);
  header('Location: products.php');
}
?>

<?php

//Delete Product
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id = (int)$_GET['delete'];
  $delete_id = sanitize($delete_id);
  $sql2 = "DELETE FROM product1 WHERE id = '$delete_id'";
  $dbh->query($sql2);
  header('Location: products.php');
}

 ?>

<div class="container">
    <h2 class="text-center">Products</h2><br>
    <a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a>
    <div class="clearfix"></div><hr>
  <table class="table table-bordered table-condensed table-striped">
    <thead>
      <th></th><th>Products</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th>
    </thead>
    <tbody>
<?php while ($product = mysqli_fetch_assoc($productresult)) :
  $childID = $product['categories'];
  $categorySql = "SELECT * FROM categories WHERE id = '$childID'";
  $result = $dbh->query($categorySql);
  $child = mysqli_fetch_assoc($result);
  $parentID = $child['parent'];
  $parentSql = "SELECT * FROM categories WHERE id = '$parentID'";
  $parentResult = $dbh->query($parentSql);
  $parent = mysqli_fetch_assoc($parentResult);
  $category = $parent['category'].'-'.$child['category'];
  ?>
  <tr>
    <td>
      <a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn-default"><span>Edit</span></a>
      <a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-default"><span>Delete</span></a>
    </td>
    <td><?=$product['title'];?></td>
    <td><?=money($product['price']);?></td>
    <td><?=$category;?></td>
    <td> <a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
      <span class="nothing-<?=(($product['featured'] == 1)?'minus':'plus');?>">toggle</span></a>
      &nbsp <?=(($product['featured'] == 1)?'Featured Product':''); ?></td>
    <td>0</td>
  </tr>
<?php endwhile; ?>
    </tbody>
  </table>
</div>
<br><br>

<?php
}

include 'includes/footer.php'; ?>




<!-- Modal to add sizes and qty -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="coolStuffLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentLabel">Enter the Size and Quantity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <div class="row">
      <div class="col-sm-12">
    <div class="modalFormWrapper">
    <form class="sign-form" action="products.php?add=1" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" name="first" id="sizeInput" placeholder="Sizes" style="width: 350px; height:40px;margin: 5px">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="pwd" id="qtyInput" placeholder="Quantity" style="width: 350px; height:40px;margin: 5px">
      </div>
        <button type="submit" class="btn btn-success btn-lg">Add</button>
        </form>
      </div>
    </div>
      </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: 0px">Close</button>
      </div>
    </div>
  </div>
</div>
