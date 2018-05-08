<?php
  include "db_connection.php";
  $nReportsQuery = "SELECT count(*) as n_reports FROM `t_segnalazioni` WHERE FK_Utente = '".$user['ID']."' ";
  $getReports = mysqli_query($db_conn, $nReportsQuery);
  if ($getReports != null){
    while ($ris = mysqli_fetch_array($getReports)){
      $nReports = $ris['n_reports'];
    }
    echo $nReports;
  }
 ?>
