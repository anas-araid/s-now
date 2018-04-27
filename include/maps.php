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
    // create a custom marker
    var myLatLng = {lat: <?php echo $coordResidenza['lat'] ?>, lng: <?php echo $coordResidenza['long'] ?>};
    var marker = new google.maps.Marker({
      animation: google.maps.Animation.BOUNCE,
      position: myLatLng,
      map: map,
      title: '<?php echo $user["Residenza"] ?>',
      icon: 'img/marker_user.png'
    });

    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', (function(marker) {
      return function() {
        infowindow.setContent("<?php echo $user["Residenza"] ?>");
        infowindow.open(map, marker);
      }
    })(marker));
  }
</script>
