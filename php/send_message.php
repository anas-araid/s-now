<?php
  include 'functions.php';
  include 'get_user_data.php';
  include "db_connection.php";
  session_start();
  $senderData = getUserData($_SESSION['email'], "db_connection.php");
  if (isset($_POST['receiverEmail']) && isset($_POST['message']) ){
    $receiverData = getUserData($_POST['receiverEmail'], "db_connection.php");
    $date = date("Y-m-d");
    $message = $_POST['message'];
    $senderID = $senderData['ID'];
    $receiverID = $receiverData['ID'];
    if ($receiverData != null){
      $sendMsgQuery = "INSERT INTO t_messaggi (Data, Messaggio, FK_Mittente, FK_Destinatario)
                      VALUES ('$date', '$message', '$senderID', '$receiverID')";
      $sendMsg = mysqli_query($db_conn, $sendMsgQuery);
      if ($sendMsg!=null){
        header("location:../chat.php?username=".$_POST['receiverEmail']);
      }
    }
  }
?>
