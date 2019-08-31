
<div class="container-fluid">
    <nav class="navbar navbar-light navbar-toggleable-md navbar-fixed-top">
<!-- <nav class="nav navbar navbar-fixed-top"> -->
  <!-- <nav class="nav navbar navbar-light navbar-expand-lg"> -->
    <div class="row">
      <div class=" col-sm-12 col-md-4">
        <a href="index.php" class="navbar-brand">Jingo & Sabainah</a>
      </div>
<?php
if(isset($_SESSION['id'])){
      echo "<div class='col-md-8'>
      <form action='includes/logoutcode.php' method='POST'>
      <div class='row nav navbar-nav navbar-expand-lg'>
        <div class='col-sm-12 col-md-3 navAdmin'>
          <li class='navSpacing'><a href='brands.php'>Brands</a></li></div>
        <div class='col-sm-12 col-md-3 navAdmin'>
          <li class='navSpacing'><a href='categories.php'>Categories</a></li></div>
        <div class='col-sm-12 col-md-3 navAdmin'>
          <li class='navSpacing'><a href='products.php'>Products</a></li></div>
        <div class='col-sm-12 col-md-3 navAdmin'>
           <button class='btn btn-danger pull-right' type='submit'>LOGOUT</button></div></div>
        </form></div>";
            } else{
             echo "<div class='col-md-8'>
             <form action='includes/logincode.php' method='POST'>
             <div class='row'>
             <div class='col-sm-12 col-md-3'>
             <input class='form-control' type='text' name='userID' placeholder='Username' class='log'>
             </div>
             <div class='col-sm-12 col-md-3'>
            <input class='form-control' type='password' name='pwd' placeholder='Password' class='log'>
             </div>
             <div class='col-sm-12 col-md-3'>
            <button type='submit' class='btn btn-success'>LOGIN</button>
             </div>
             <div class='col-sm-12 col-md-3'>
             <div id='signUp' class='nav-item coolStuffBtn pull-right' data-toggle='modal' data-target='#coolStuffModal'>
                 <a class='nav-link'>Sign Up</a>
             </div>
             </div>
             </div>
             </form>
             </div>";
           }
?>
  </div>
  </nav>
</div>


<?php
if(isset($_SESSION['id'])){
  $uid = $_SESSION['id'];
  $sql = "SELECT * FROM user WHERE id='$uid'";
  $result = $dbh->query($sql);
  $row = $result->fetch_assoc();
  // $row = $result->fetch_assoc();         Both does same thing
  //             OR
  // $row = mysqli_fetch_assoc($result);
  echo "<hr><h5 class='text-center'>".$row['userID'].'! You are logged in'."</h5><hr>";
}
 ?>


<!-- Modal -->
<div class="modal fade" id="coolStuffModal" tabindex="-1" role="dialog" aria-labelledby="coolStuffLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contentLabel">Please Enter Yours Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <div class="row">
      <div class="col-sm-12">
    <div class="modalFormWrapper">
    <form class="sign-form" action="includes/signupcode.php" method="POST">
      <div class="form-group">
        <input type="text" class="form-control" name="first" id="first" placeholder="First Name" style="width: 350px; height:40px;margin: 5px">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="last" id="last" placeholder="Last Name" style="width: 350px; height:40px;margin: 5px">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="userID" id="userID" placeholder="UserName" style="width: 350px; height:40px;margin: 5px">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="pwd" id="passwordInput" placeholder="Password" style="width: 350px; height:40px;margin: 5px">
      </div>
        <button type="submit" class="btn signin-btn btn-lg btn-info coolStuffBtn">Sign Up</button>
          <div class="form-check checck">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Remember me <a href="#"> Need Help?</a></label>
          </div>
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
