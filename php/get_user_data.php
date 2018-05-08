<?php
  function getUserData($email, $dbConnPath){
    include $dbConnPath;
    if ($_SESSION['isLogged']){
      $user = array();
      $sql = "SELECT * FROM t_utenti WHERE (Email='$email')";
      $risultato = mysqli_query($db_conn, $sql);
      if ($risultato == false){
        die("error");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $user['ID'] = $ris['ID'];
        $user['Nome'] = $ris['Nome'];
        $user['Cognome'] = $ris['Cognome'];
        $user['DataDiNascita'] = date('d-m-Y', strtotime($ris['DataDiNascita']));
        $user['Genere'] = $ris['Genere'];
        $user['Residenza'] = $ris['Residenza'];
        $user['FotoProfilo'] = $ris['FotoProfilo'];
        $user['Email'] = $ris['Email'];
        $user['Password'] = $ris['Password'];
      }
      return $user;
    }
  }
?>
