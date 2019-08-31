<?php
date_default_timezone_set('Africa/Lagos');
require_once 'core/dbh.php';
include 'includes/001head.php';
include 'includes/002navbar.php';
include 'includes/003jingo.php';
include 'comments.inc.php';

$sql = "SELECT * FROM product1 WHERE featured = 1";
$featured = $dbh->query($sql);
 ?>

 <!-- Display of Promo Products -->
 <div class="sectionDark">
   <h2 class="feature text-center">Promo Sales</h2>
   <div class="row feature">
       <?php while ($product = mysqli_fetch_assoc($featured)) : ?>
     <div class="col-sm-12 col-lg-1">
      <div class="coolSttuffWrapper"></div>
     </div>
   <div class="col-sm-12 col-lg-2">
     <div class="coolSttuffWrapper">
       <h6 class="itemName"><?php echo $product['title']; ?></h6>
       <img src="<?php echo $product['image']; ?>" class="displayImg" alt="<?php echo $product['title']; ?>">
       <h6 class="listPrice">List Price: <s><?php echo money($product['list_price']); ?></s><br></h6>
       <h6 class="sellingPrice">Promo Price: <?php echo money($product['price']); ?></h6>
       <button type="button" class="btn btn-lg coolStuffBtn" onclick="detailsmodal(<?= $product['id']; ?>)">Order</button>
     </div>
   </div>
       <?php endwhile; ?>
 </div>
 </div> <br><br>

<!-- Feedback Comment -->
 <div class="container-fluid">
   <div class="row">
     <div class="col-sm-12 col-md-3"></div>
     <div class="col-sm-12 col-md-6">
       <h4 class="text-center">Your Feedback is Important</h4>
<?php
     echo "<form class='textarea text-center' method='POST' action='".setComments($dbh)."'>
         <input type='hidden' name='uid' value='Anonymous'>
         <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
         <textarea name='message'></textarea><br>
         <button type='submit' name='commentSubmit' class='btn btn-info btnComment'>Submit</button>
         </form>";

getComments($dbh);
?>
     </div>
     <div class="col-sm-12 col-md-3"> </div>
   </div>
 </div>

 <br><br><br><br><br><br>


<?php
 include 'includes/006footer.php';
?>


<!-- Modal for vacancies -->
<div class="modal fade" id="coolStuffModal" tabindex="-1" role="dialog" aria-labelledby="coolStuffLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentLabel">Current Openings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 text-center">
              <img class="img-fluid" src="assets/JnSmix.png">
            </div>
          </div>
        <div class="row">
      <div class="col-sm-12">
        <h6 class="cv">Kindly upload you CV and our HR team will get back to you. Thanks.</h6>
        <form action="upload.php" method="post" class="form-group" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">UPLOAD</button>
            <p>Kindly ensure it is of these format: 'pdf', 'doc', 'docx', 'rft'</p>
        </form>
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

<!-- Modal for Contact -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="coolStuffLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentLabel">Contact Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 text-center">
              <img class="img-fluid" src="assets/JnSmix.png">
            </div>
          </div>
        <div class="row">
      <div class="col-sm-12">
        <h5 class="cv text-center">e-mail: biodun.agbolade@gmail.com</h5>
        <h5 class="text-center">Mobile: 0816-8886-000</h5>
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

 </body>
 </html>
