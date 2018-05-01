<?php
  include "db_connection.php";
  if ($receiverData['Email'] != null){
    $receiverEmail =  $_GET['username'];
    $receiverID = $receiverData['ID'];
    $senderID = $_SESSION['ID_utente'];
    $getMessagesQuery ="SELECT * FROM `t_messaggi` WHERE (FK_Mittente = $senderID) and (FK_Destinatario = $receiverID) or (FK_Mittente = $receiverID) and (FK_Destinatario = $senderID) ORDER BY ID DESC";
    $getMessages = mysqli_query($db_conn, $getMessagesQuery);
    if ($getMessages != false){
      while($ris=mysqli_fetch_array($getMessages)){
        $msgID = $ris['ID'];
        $msgIdSender = $ris['FK_Mittente'];
        $msgSender = ($msgIdSender == $senderID) ? $user['Nome'] : $receiverData['Nome'];
        echo '
        <div class=" mdl-cell mdl-cell--8-col mdl-shadow--4dp mdl-cell-middle mdl-color--white stile-card-corners" style="width:80%">
        <p style="color:#27ae60">'.$msgSender.': </p>
        <p>'.$ris['Messaggio'].'</p>
        <p class="stile-text-azzurro" style="display:inline!important">'.date('d-m-Y', strtotime($ris['Data'])).'</p>
        <a href="php/delete_message.php?id='.$msgID.'&receiver='.$receiverData['Email'].'" style="color:#e74c3c!important;display:inline!important">Cancella</a>
        </div>';
      }
    }
  }
 ?>
