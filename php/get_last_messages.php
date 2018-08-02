<?php
  include "php/db_connection.php";
  $msgQuery = "SELECT * FROM t_messaggi WHERE (FK_Mittente = '".$user['ID']."') or (FK_Destinatario ='".$user['ID']."') ORDER BY ID DESC LIMIT 2";
  $getMsg = mysqli_query($db_conn, $msgQuery);
  if ($getMsg != null){
    while ($ris = mysqli_fetch_array($getMsg)){
      $senderID = $ris['FK_Mittente'];
      $receiverID = $ris['FK_Destinatario'];
      $senderData = getMessagingData($senderID, $db_conn);
      $receiverData = getMessagingData($receiverID, $db_conn);

      echo '
      <div class=" mdl-cell mdl-cell--8-col mdl-shadow--4dp mdl-cell-middle mdl-color--white stile-card-corners" style="width:80%">
      <a href="chat.php?username='.$senderData['Email'].'" style="color:#27ae60!important">'.$senderData['Nome'].': </a>
      <p>'.$ris['Messaggio'].'</p>
      <p class="stile-text-azzurro" style="display:inline!important">Inviato il '.date('d-m-Y', strtotime($ris['Data'])).' a '.$receiverData['Nome'].'</p>
      </div>';
    }
  }
  function getMessagingData($id, $db_conn){
    $user = array();
    $sql = "SELECT * FROM t_utenti WHERE (ID='$id')";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $user['ID'] = $ris['ID'];
      $user['Nome'] = $ris['Nome'];
      $user['Cognome'] = $ris['Cognome'];
      $user['Email'] = $ris['Email'];
    }
    return $user;
  }
 ?>
