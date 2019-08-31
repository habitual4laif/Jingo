<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Habitual/core/dbh.php';
$parentID = (int)$_POST['parentID'];
$childQuery = $dbh->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY category");
ob_start();  //Pre-built PHP function that start buffering
 ?>
<option value=""></option>
<?php while($child = mysqli_fetch_assoc($childQuery)): ?>
  <option value="<?=$child['id'];?>"><?=$child['category'];?></option>
<?php endwhile; ?>
<?php echo ob_get_clean(); ?>
