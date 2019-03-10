<?php
  @ob_start();
  session_start();
?>
<!doctype>
<html>
  <head>
  <?php
    include "include/header.html";
    include 'php/functions.php';
    include 'php/get_user_data.php';
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // error_reporting per togliere il notice quando non trova isLogged
    error_reporting(0);
    if ($_SESSION['isLogged']){
      // getUserData ritorna un array con tutte le info dell'utente
      $user = getUserData($_SESSION['email'], "php/db_connection.php");
    }

   ?>
 </head>
  <body class="stile-main">
    <div id="loading-div" class="stile-parent" style="height:100%;background-color:white;z-index:10000">
      <div class="stile-child">
        <img src="img/loading.gif"></img>
      </div>
    </div>
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
            <a class="mdl-navigation__link" href="include/help.html">Serve aiuto?</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer stile-main-vertical" style="border:none">
        <span class="mdl-layout-title mdl-color-text--white">s-<i>now</i></span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link stile-text-azzurro" href="index.html">Home</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="#">Mappa</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="login.php">Accedi</a>
          <a class="mdl-navigation__link" href="include/help.html">Serve aiuto?</a>
        </nav>
      </div>
      <main id="main" class="mdl-layout__content">
        <section>
          <!-- mappa-->
          <div id="mappa" class="mdl-grid">
            <div class="mdl-card mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--16dp stile-card" style="border:none;border-radius:17px;">
              <h1 class="stile-testo-bianco"><b><i>Mappa</i></b></h1>
               <hr style="width:100px;border:5px solid white;border-radius:10px;background:white;">
               <form action="" method="post">
                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="color:white">
                   <input class="mdl-textfield__input" type="text" name="position" autofocus="" maxlength="50" style="color:white">
                   <label class="mdl-textfield__label" for="position" style="color:white">Inserisci la tua posizione...</label>
                 </div>
                 <button id="button-position" type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white ">
                  <i class="material-icons mdl-color-text--blue">person_pin_circle</i>
                 </button>
               </form>
               <?php
                if(!$_SESSION['isLogged']){
                  $coordResidenza = getCoordinatesFromAddress('Trento');
                }else{
                  // restituisce le coordinate(Lat e Long) della residenza per la mappa
                  $coordResidenza = getCoordinatesFromAddress($user['Residenza']);
                }
                if ($_GET['position']){
                  $getPosition = text_filter($_GET['position']);
                  $coordResidenza = getCoordinatesFromAddress($getPosition);
                }
                if ($_POST['position']){
                  $coordResidenza = getCoordinatesFromAddress($_POST['position']);
                }
               ?>
               <button id="aggiungiSegnalazione" class="stile-bottone-generico stile-button-fill"
                 style="width:100%;margin:16px 0px;"
                 onclick="location.href='report.php'">
                 Aggiungi una nuova segnalazione
              </button>
              <div id="map" style="width:100%; height:420px;border-radius:20px"></div>
              <?php include "include/maps.php" ?>
            </div>
          </div>
        </section>
        <script>
          // nasconde il contenuto della pagina per 2 secondi per mostrare il loading
          document.getElementById("main").style.display = "none";
          setTimeout(function(){
            document.getElementById("loading-div").remove();
            document.getElementById("main").style.display = "block";
          }, 2000);
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgwoQUpZNuWrgKJseSI53sQvWZAFkBzQ4&callback=initMap" type="text/javascript"></script>
      </main>
    </div>
  </body>
</html>
