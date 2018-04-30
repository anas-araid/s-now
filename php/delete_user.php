<?php
include "db_connection.php";
  session_start();
  $ID_utente = $_SESSION['ID_utente'];
  $fotoProfilo = $_SESSION['fotoProfilo'];
  if ($fotoProfilo != 'uploads/default.png'){
    unlink("../".$fotoProfilo);
  }
  $sql = "DELETE FROM t_utenti WHERE (ID='$ID_utente')";
  $delete = mysqli_query($db_conn, $sql);
  if ($delete == null){
    echo $_SESSION['ID_utente'];
  }
  //header("location:logout.php");
?>
