<?php
  include "db_connection.php";
  session_start();
  if ($_SESSION['isLogged']){
    $reportID = $_GET['id'];
    $sql = "DELETE FROM t_segnalazioni WHERE ID='$reportID'";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("error");
    }
    header("location:../dashboard.php");
  }else{
    header("location:../login.php");
  }

?>
