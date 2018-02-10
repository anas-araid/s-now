<?php
  $host = 'localhost';
  $user = 'root';
  $pwd = '';
  $db = 'my_snow';
  $conn = new mysqli($host, $user, '');
  if(!$conn){
    die("error: ".mysql_error());
  }
  mysqli_select_db($conn, $db);
  //mysqli_close($conn);
 ?>
