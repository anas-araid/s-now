<?php
  include 'functions.php';
  include 'get_user_data.php';
  include "db_connection.php";
  session_start();
  $user = getUserData($_SESSION['email'], "db_connection.php");
  if (isset($_POST['address']) && isset($_POST['city']) && isset($_POST['description']) ){
    $address = $_POST["address"];
    $city = $_POST["city"];
    $coordinates = getCoordinatesFromAddress($address." ".$city);
    $description = $_POST["description"];
    $severity = removeAccents($_POST["severity"]);
    $lat = $coordinates["lat"];
    $long = $coordinates["long"];
    $userID = $user["ID"];
    $date = date("Y-m-d");
    $insertQuery = "INSERT INTO t_segnalazioni (Latitudine, Longitudine, Via, Citta, Descrizione, Pericolosita , Data, FK_utente)
                    VALUES ('$lat', '$long', '$address', '$city', '$description', '$severity', '$date', '$userID')";
    $insert = mysqli_query($db_conn, $insertQuery);
    if ($insert==null){
        throw new exception ("Impossibile aggiungere la segnalazione");
    }
  }
  header('location:../dashboard.php');
?>
