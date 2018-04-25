<?php
  session_start();
  include "db_connection.php";
  $email = $_SESSION['email'];
  $fotoProfilo = $_SESSION['fotoProfilo'];
  if ($fotoProfilo != 'uploads/default.png'){
    unlink("../".$fotoProfilo);
  }
  $sql = "DELETE FROM t_utenti WHERE (Email='$email')";
  $delete = mysqli_query($db_conn, $sql);
  header("location:logout.php");
?>
