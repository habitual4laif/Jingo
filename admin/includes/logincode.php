<?php
session_start();
// include 'databasehandler.php';
// include '../core/dbh.php';
// require_once '/Habitual/core/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Habitual/core/dbh.php';

$uid = $_POST['userID'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM user WHERE userID='$uid'";
$result = $dbh->query($sql);
$row = $result->fetch_assoc();
$hash_pwd = $row['pwd'];
$hash = password_verify($pwd, $hash_pwd);  //This function decrypt the password

if($hash == 0){
    header("Location: ../index.php?error=empty");
    exit();
}else {
    $sql = "SELECT * FROM user WHERE userID='$uid' AND pwd='$hash_pwd'";
        $result = $dbh->query($sql);

    if(!$row = $result->fetch_assoc()){
        echo "Your Username or Password is incorrect!";
    }else{
        $_SESSION['id'] = $row['id'];
    }

    header('Location: ../index.php');
}
