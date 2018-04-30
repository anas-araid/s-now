<?php
  include "db_connection.php";
  session_start();
  $reportID = $_GET['id'];
  $sql = "DELETE FROM t_segnalazioni WHERE ID='$reportID'";
  $deleteQuery = mysqli_query($db_conn, $sql);
  if ($deleteQuery == null){
    die("error");
  }
  header("location:../dashboard.php")
?>
