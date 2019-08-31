<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/Habitual/core/dbh.php';

$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['userID'];
$pwd = $_POST['pwd'];

if (empty($first)){
    header("Location: ../index.php?error=empty");
    exit();
}
if (empty($last)){
    header("Location: ../index.php?error=empty");
    exit();
}
if (empty($uid)){
    header("Location: ../index.php?error=empty");
    exit();
}
if (empty($pwd)){
    header("Location: ../index.php?error=empty");
    exit();
}
else{
    $sql = "SELECT userID FROM user WHERE userID='$uid'";
    $result = $dbh->query($sql);
    $uidcheck = mysqli_num_rows($result);
    if ($uidcheck > 0){
        header("Location: ../index.php?error=username");
        exit();
    }else{
        $encrypted_password = password_hash($pwd, PASSWORD_DEFAULT); //This is how to encrypt passwords
        $sql = "INSERT INTO user (first, last, userID, pwd) VALUES ('$first', '$last', '$uid', '$encrypted_password')";
        $result = $dbh->query($sql);

        header('Location: ../index.php');  //This takes the user back to the home page after clicking submit button
    }
}
