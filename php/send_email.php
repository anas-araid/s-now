<?php
  function sendEmail($senderEmail, $receiverEmail, $message, $date){
    $msg = $message."\n Messaggio inviato da ".$senderEmail." il ".date('d-m-Y', strtotime($date)).".";
    mail($receiverEmail, "Hai un nuovo messaggio su s-now", $msg);
  }


 ?>
