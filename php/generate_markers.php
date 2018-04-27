<?php
  include "db_connection.php";
  $selectQuery = "SELECT * FROM t_segnalazioni";
  $select = mysqli_query($db_conn, $selectQuery);
  if ($select == null){
    die("error");
  }
  // ogni segnalazione trovata, crea un marker sulla mappa
  while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
    $reportID = $ris["ID"];
    $lat = $ris["Latitudine"];
    $long = $ris["Longitudine"];
    $address = $ris["Via"];
    $city = $ris["Citta"];
    $description = $ris["Descrizione"];
    $severity = $ris["Pericolosita"];
    $date = $ris["Data"];
    $userID = $ris["FK_utente"];
    $nameQuery = "SELECT Nome FROM t_utenti WHERE ID='$userID'";
    $getName = mysqli_query($db_conn, $nameQuery);
    if ($getName == null){
      die("error");
    }
    while($ris = mysqli_fetch_array ($getName, MYSQLI_ASSOC)){
      $username = $ris["Nome"];
    }
    switch($severity){
      case 1:
          $icon = 'img/marker_low.png';
          $pericolosita = "Bassa";
          break;
      case 2:
          $icon = 'img/marker_lowMiddle.png';
          $pericolosita = "Medio-Bassa";
          break;
      case 3:
          $icon = 'img/marker_middle.png';
          $pericolosita = "Media";
          break;
      case 4:
          $icon = 'img/marker_middleHigh.png';
          $pericolosita = "Medio-Alto";
          break;
      case 5:
          $icon = 'img/marker_high.png';
          $pericolosita = "Alto";
          break;
    }
    echo "
    var myLatLng = {lat: $lat, lng: $long};
    var marker = new google.maps.Marker({
      animation: google.maps.Animation.BOUNCE,
      position: myLatLng,
      map: map,
      title: 'Pericolosità $pericolosita',
      icon: '$icon'
    });

    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', (function(marker) {
      return function() {
        infowindow.setContent('$description segnalata da $username');
        infowindow.open(map, marker);
      }
    })(marker));";
  }

?>
