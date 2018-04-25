<section class="stile-image-parallax">
  <div id="info-desktop" class="mdl-grid">
    <br>
    <div class="mdl-grid mdl-card mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners">
      <div class="mdl-cell--2-col" style="text-align:center">
        <img src=" <?php echo $_SESSION['fotoProfilo'] ?>"
             style="width:120px;height:120px;border-radius:50%;">
        </img>
       <div style="margin:50px">
         <button id="button-settings" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--blue"
                 onclick="location.href='show_user.php'">
           <i class="material-icons">settings</i>
         </button>
         <!--Descrizione del pulsante mostra utente -->
         <div class="mdl-tooltip mdl-tooltip--large" for="button-settings">
           Mostra Utente
         </div>
       </div>
      </div>
      <div class="mdl-cell--1-col"></div>
      <div class="mdl-cell--9-col">
        <h2 class="stile-text-azzurro ">
          Ciao <?php echo $user['Nome'] ?>
        </h2>
         <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">
         <div class="mdl-grid">
           <div class="stile-dashboard-card mdl-cell mdl-cell--4-col mdl-shadow--4dp mdl-color--white">
             <p class="stile-text-azzurro">EMAIL</p>
             <p>
               <?php
                echo $user['Email'];
               ?>
             </p>
           </div>
           <div class="stile-dashboard-card mdl-cell mdl-cell--4-col mdl-shadow--4dp mdl-color--white">
             <p class="stile-text-azzurro">CITTA'</p>
             <p>
               <?php
                echo $user['Residenza'];
               ?>
             </p>
           </div>
           <div class="stile-dashboard-card mdl-cell mdl-cell--4-col mdl-shadow--4dp mdl-color--white">
             <p class="stile-text-azzurro">VALUTAZIONE</p>
             <p>
               <?php
                $valutazione = $user['Valutazione'];
                for ($i=0; $i < 5; $i++){
                  if ($i < $valutazione){
                    echo '<span class="fa fa-star stile-star-checked"></span>';
                  }else{
                    echo '<span class="fa fa-star"></span>';
                  }
                }
               ?>
             </p>
           </div>
         </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="mdl-grid">
    <div class="mdl-card mdl-cell mdl-cell--8-col mdl-shadow--4dp mdl-color--white stile-card-corners">
      <h2 class="stile-text-azzurro ">
        Mappa
      </h2>
      <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">

      <!-- don't send HTTP referer for privacy purpose and to use Google Maps Geocoding API without key -->
      <meta name="referrer" content="no-referrer">
      <div>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
        // ################################################################################################
        // Script trovato su internet per bypassare il controllo sulla chiave api per google mpas
        var target = document.head;
        var observer = new MutationObserver(function(mutations) {
            for (var i = 0; mutations[i]; ++i) { // notify when script to hack is added in HTML head
                if (mutations[i].addedNodes[0].nodeName == "SCRIPT" && mutations[i].addedNodes[0].src.match(/\/AuthenticationService.Authenticate?/g)) {
                    var str = mutations[i].addedNodes[0].src.match(/[?&]callback=.*[&$]/g);
                    if (str) {
                        if (str[0][str[0].length - 1] == '&') {
                            str = str[0].substring(10, str[0].length - 1);
                        } else {
                            str = str[0].substring(10);
                        }
                        var split = str.split(".");
                        var object = split[0];
                        var method = split[1];
                        window[object][method] = null; // remove censorship message function _xdc_._jmzdv6 (AJAX callback name "_jmzdv6" differs depending on URL)
                        //window[object] = {}; // when we removed the complete object _xdc_, Google Maps tiles did not load when we moved the map with the mouse (no problem with OpenStreetMap)
                    }
                    observer.disconnect();
                }
            }
        });
        var config = { attributes: true, childList: true, characterData: true }
        observer.observe(target, config);
        //######################################################################################################
        var initialize = function() {
          <?php
            $coordResidenza = getCoordinatesFromAddress($user['Residenza'], "Italia")
          ?>
          // fornisce latitudine e longitudine
          var latlng = new google.maps.LatLng(<?php echo $coordResidenza['lat'] ?>,<?php echo $coordResidenza['long'] ?>);
          // imposta le opzioni di visualizzazione
          var options = { zoom: 12,
                          center: latlng,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
          // crea l'oggetto mappa
          var map = new google.maps.Map(document.getElementById('map'), options);
          // create a custom marker
          var myLatLng = {lat: <?php echo $coordResidenza['lat'] ?>, lng: <?php echo $coordResidenza['long'] ?>};
          var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!',
            icon: 'blue_marker.png'
          });

          var infowindow = new google.maps.InfoWindow();
          google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
              infowindow.setContent("ciao");
              infowindow.open(map, marker);
            }
          })(marker));
        }
        window.onload = initialize;
        </script>
        <div id="map" style="width:100%; height:480px; border-radius:20px"></div>
      </div>

    </div>
    <div class="mdl-card mdl-cell mdl-cell--4col mdl-shadow--4dp mdl-color--white stile-card-corners">
      <h2 class="stile-text-azzurro ">
        Chat
      </h2>
       <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">
    </div>
  </div>
</section>
