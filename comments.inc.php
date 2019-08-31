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
    echo "</p></div>";
  }
}
