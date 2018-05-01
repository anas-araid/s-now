<?php
  include "db_connection.php";
  session_start();
  $msgID = $_GET['id'];
  $receiver = $_GET['receiver'];
  $sql = "DELETE FROM t_messaggi WHERE ID='$msgID'";
  $deleteQuery = mysqli_query($db_conn, $sql);
  if ($deleteQuery == null){
    die("error");
  }
  header("location:../chat.php?username=$receiver");
?>
