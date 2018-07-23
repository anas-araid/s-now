<?php
  $sql = "DELETE FROM t_segnalazioni WHERE Data < ADDDATE(CURDATE(), INTERVAL -2 MONTH)";
  $deleteQuery = mysqli_query($db_conn, $sql);
  if ($deleteQuery == null){
    die("error");
  }
?>
