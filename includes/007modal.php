
<!-- Basic code for running something over and over again -->
<?php
require_once '../core/dbh.php';
$id = $_POST['id'];
$id = (int)$id;
$sql = "SELECT * FROM product1 WHERE id = '$id'";
$result = $dbh->query($sql);
$product = mysqli_fetch_assoc($result);

$brandID = $product['brand'];
$sqlBrand = "SELECT brand FROM brand WHERE id = '$brandID'";
$brandQuery = $dbh->query($sqlBrand);
$brand = mysqli_fetch_assoc($brandQuery);
$sizeString = $product['sizes'];
$sizeArray = explode(',', $sizeString);
 ?>

<?php ob_start(); ?>

<!-- Modal -->
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-l" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentLabel"><?= $product['title'];?></h5>
        <!-- <button class="close" type="button" onclick="closeModel()" aria-label="close">
          <span aria-hidden="true">&times;</span></button> -->
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="center-block">
                  <img class="img-fluid details img-responsive" src="<?= $product['image'];?>" alt="Levis Jeans">
              </div>
            </div>
            <div class="col-sm-6">
              <h4>Details</h4>
              <p><?= $product['description']; ?></p>
              <p>Price : <?= money($product['price']); ?></p>
              <p>Brand: <?= $brand['brand']; ?></p>
              <form class="" action="" method="post">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3"><label for="quantity">Quantity:</label></div>
                    <input type="text" name="quantity" id="quantity" class="form-control form-brand" value="">
                  </div>
                  <div class="col-xs-9"></div>
                </div>
                <div class="form-group">
                  <label for="size">Size :</label>
                  <select class="form-control" name="size" id="size">
                    <option value=""></option>
        <?php foreach ($sizeArray as $string) {
              $stringArray = explode(':', $string);
              $size = $stringArray[0];
              $quantity = $stringArray[1];
              echo '<option value="'.$size.'">'.$size.' ('.$quantity.' Available)</option>';
        } ?>
                  </select>
                </div>
              </form>
            </div>
            <div class="col-sm-6 modal-footer"></div>
            <div class="modal-footer col-sm-6">
              <button type="button" class="btn btn-info" onclick="closeModel()">Close</button>
              <button type="submit" class="btn btn-warning" onclick="closeModel()">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<?php echo ob_get_clean(); ?>
