<?php
$dbh = mysqli_connect('localhost', 'root', '', 'boutique');

// this check for errors and if there are any, it kills the database so everything stop working
if (mysqli_connect_error()) {
  echo "Database connection failed with the following errors: ". mysqli_connect_error();
  die();

}

// define('BASEURL', '/BootstrapBou/');

require_once $_SERVER['DOCUMENT_ROOT'].'/Habitual/config.php';
require_once BASEURL.'helpers/helpers.php';
