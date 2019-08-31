
<?php
$sql = "SELECT * FROM categories WHERE parent = 0";
$parentquery = $dbh->query($sql);
?>

<div class="container-fluid">
  <nav class="navbar navbar-light navbar-expand-lg" id="dropdownClick">
    <ul class="nav navbar-nav navbar-expand-lg">
      <li><a href="index.php" class="navbar-brand navColor1">Jingo & Sabainah</a></li>
<?php
while ($parent = mysqli_fetch_assoc($parentquery)) :  ?>
<?php $parent_id = $parent['id'];
    $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
    $childquery = $dbh->query($sql2);
?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle navColor2" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $parent['category']; ?></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<?php
    while ($child = mysqli_fetch_assoc($childquery)) : ?>
          <a class="dropdown-item" href="#"><?php echo $child['category']; ?></a>
<?php endwhile; ?>
        </div>
      </li>
<?php endwhile; ?>
      <li id="vacancies" class="nav-item coolStuffBtn" data-toggle="modal" data-target="#coolStuffModal">
        <a class="nav-link copyRight navColor3">Vacancies</a>
      </li>
      <li id="vacancies" class="nav-item coolStuffBtn" data-toggle="modal" data-target="#contactModal">
        <a class="nav-link copyRight navColor3">Contact</a>
      </li>
    </ul>
    <div class="dropdownIcon"><a class="trigramIcon" href="javascript:void(0);" onclick="dropdownMenu()">&#9776;</a> </div>
  </nav>
</div>
