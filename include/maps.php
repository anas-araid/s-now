<script>
  function initMap() {
    // fornisce latitudine e longitudine
    var latlng = new google.maps.LatLng(<?php echo $coordResidenza['lat'] ?>,<?php echo $coordResidenza['long'] ?>);
    // imposta le opzioni di visualizzazione
    var options = { zoom: 15,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  };
    // crea l'oggetto mappa
    var map = new google.maps.Map(document.getElementById('map'), options);
  

    <?php include "php/generate_markers.php" ?>
  }
  </script>
