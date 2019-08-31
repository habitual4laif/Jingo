<?php

function setComments($dbh){
    if(isset($_POST['commentSubmit'])){
      $uid = $_POST['uid'];
      $date = $_POST['date'];
      $message = $_POST['message'];
      $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
      $result = $dbh->query($sql);
  }
}

function getComments($dbh){
    $sql = "SELECT * FROM comments";
    $result = $dbh->query($sql);
    while ($row = $result->fetch_assoc()) {
    echo "<div class='commentsDisplay'><p>";
    echo $row['uid']."<br>";
    echo $row['date']."<br>";
    echo nl2br($row['message']);
    echo "</p>
     <form class='deleteButton' method='POST' action='".deleteComments($dbh)."'>
       <input type='hidden' name='cid' value='".$row['cid']."'>
       <button type='submit' name='commentDelete'>Delete</button>
     </form>
       <form class='editButton' method='POST' action='editComment.php'>
       <input type='hidden' name='cid' value='".$row['cid']."'>
       <input type='hidden' name='uid' value='".$row['uid']."'>
       <input type='hidden' name='date' value='".$row['date']."'>
       <input type='hidden' name='message' value='".$row['message']."'>
       <button class='btn btn-absolute'>Edit</button>
     </form";

     echo "<form class='editButton' method='POST' action='replycomment.php'>
     <input type='hidden' name='date' value='".$row['date']."'>
     <input type='hidden' name='message' value='".$row['message']."'>
     <button>Reply</button>
     </form>
    </div>";
}
}



function editComments($dbh){
$cid = $_POST['cid'];
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];

$sql = "UPDATE comments SET message='$message'";
$result = $dbh->query($sql);
header("Location: index.php");
}


function deleteComments($dbh){
if(isset($_POST['commentDelete'])){
$cid = $_POST['cid'];

$sql = "DELETE FROM comments WHERE cid='$cid'";
$result = $dbh->query($sql);
header("Location: index.php");
}
}
