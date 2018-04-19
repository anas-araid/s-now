<?php
  session_start();
  include "db_connection.php";
  $email = $_SESSION['email'];
  $sql = "DELETE FROM t_utenti WHERE (Email='$email')";
  mysqli_query($db_conn, $sql);
  header("location:logout.php");
?>
