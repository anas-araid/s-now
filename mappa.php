<!doctype>
<html>
  <head>
  <?php
    include "include/header.html";
    include 'php/functions.php';
    session_start();
   ?>
 </head>
  <body class="stile-main">
    <div class="mdl-layout mdl-js-layout">
      <header class="mdl-layout__header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">s-<i>now</i></span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation -->
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="index.html">Home</a>
            <a class="mdl-navigation__link" href="#">Mappa</a>
            <a class="mdl-navigation__link" href="login.php">Accedi</a>
            <a class="mdl-navigation__link" href="https://github.com/asdf1899/s-now">Github <i class="fa fa-github"></i></a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer stile-main-vertical" style="border:none">
        <span class="mdl-layout-title mdl-color-text--white">s-<i>now</i></span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link stile-text-azzurro" href="index.html">Home</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="#">Mappa</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="login.php">Accedi</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="https://github.com/asdf1899/s-now">Github <i class="fa fa-github"></i></a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <section>
          <!-- mappa-->
          <div id="mappa" class="mdl-grid">
            <div class="mdl-card mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--16dp stile-card" style="border:none;border-radius:17px;">
              <h1 class="stile-testo-bianco"><b><i>Mappa</i></b></h1>
               <hr style="width:100px;border:5px solid white;border-radius:10px;background:white;">
               <?php
                if(!$_SESSION['isLogged']){
                  echo "<script>document.getElementById('aggiungiSegnalazione')</script>";
                }
               ?>
               <button id="aggiungiSegnalazione" class="stile-bottone-generico stile-button-fill"
               style="width:100%;margin:16px 0px;"
               onclick="location.href='login.php'">
               Aggiungi una nuova segnalazione
             </button>
               <div id="mapdiv" style="height:50%;width:100%;"></div>
               <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
               <script>
               map = new OpenLayers.Map("mapdiv");
               console.log(map);
               map.addLayer(new OpenLayers.Layer.OSM());
               var lonLat = new OpenLayers.LonLat(42.088,12.564)
               .transform(
                 new OpenLayers.Projection("EPSG:3004"), // Sistema di riferimento
                 map.getProjectionObject() // Proiezione Mercatore
               );
               var zoom=16;
               //marker
               var markers = new OpenLayers.Layer.Markers( "Markers" );
               map.addLayer(markers);
               markers.addMarker(new OpenLayers.Marker(lonLat));
               map.setCenter (lonLat, zoom);
               </script>
            </div>
          </div>
          <!-- footer -->
          <div class="stile-main" style="padding:10px;text-align:center;">
            <div class="stile-footer">
             <p class="stile-testo-bianco"><i class="fa fa-code"></i> with <i class="fa fa-coffee"></i> by Anas Araid <i class="fa fa-copyright"></i> 2018</p>
            </div>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>
