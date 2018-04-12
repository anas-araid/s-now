<!doctype>
<html>
  <head>
  <?php
    include "include/header.html";
    include 'php/functions.php';
    include 'php/get_user_data.php';
    session_start();
    // Controlla se la foto profilo esiste, altrimenti usa quella default
    $_SESSION['fotoProfilo'] = profilePicture($_SESSION['email'], $_SESSION['fotoProfilo']);
    // getUserData ritorna un array con tutte le info dell'utente
    $user = getUserData($_SESSION['email']);
    if(!$_SESSION['isLogged'] or $_SESSION['isLogged'] == ""){
      session_destroy();
      header("location:login.php");
    }
   ?>
   <style>
    .mdl-layout__drawer-button{
      color: #2173b9!important;
    }
   </style>
 </head>

  <body class="mdl-color--grey-100">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
      <header class="mdl-layout__header mdl-layout__header--transparent mdl-cell--hide-desktop">
        <div class="mdl-layout__header-row">
          <div class="mdl-layout-spacer"></div>
        </div>
      </header>
      <div class="mdl-layout__drawer stile-main-vertical" style="border:none">
        <div style="height:120px;text-align:center;padding:20px;">
          <span class="mdl-layout-title mdl-color-text--white"><b>s-<i>now</i></b></span>
        </div>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="index.html">Home</a>
          <a class="mdl-navigation__link" href="mappa.php">Mappa</a>
          <a class="mdl-navigation__link" href="https://github.com/asdf1899/s-now">GitHub <i class="fa fa-github"></i></a>
          <a class="mdl-navigation__link" href="php/logout.php">Esci</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <!-- INFO UTENTE PER DESKTOP-->
        <section class="stile-image-parallax">
          <div id="info-desktop" class="mdl-grid mdl-cell--hide-phone mdl-cell--hide-tablet">
            <br>
            <div class="mdl-grid mdl-card mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--4dp mdl-color--white"
                 style="border:none;border-radius:17px;padding:20px;margin-top:20px">
              <div class="mdl-cell--2-col" style="text-align:center">
                <img src=" <?php echo $_SESSION['fotoProfilo'] ?>"
                     style="width:120px;height:120px;border-radius:50%;">
                </img>
               <div style="margin:50px">
                 <button id="button-settings" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--blue">
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
                  Ciao <?php echo $_SESSION['Nome'] ?>
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
        <!-- INFO UTENTE PER MOBILE-->
        <section>
          <div id="info-mobile" class="mdl-grid mdl-cell--hide-desktop">
            <div class="mdl-card mdl-grid mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--4dp mdl-color--white"
                 style="border:none;border-radius:17px;padding:5px;margin-top:20px">
              <div class="mdl-cell mdl-cell--12-col">
                <h2 class="stile-text-azzurro ">
                  Ciao <?php echo $_SESSION['Nome'] ?>
                </h2>
                <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">
              </div>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--2-col">
                  <button id="button-settings-mobile"
                          class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--blue">
                    <i class="material-icons">settings</i>
                  </button>
                  <!--Descrizione del pulsante mostra utente -->
                  <div class="mdl-tooltip mdl-tooltip--large" for="button-settings-mobile">
                    Mostra Utente
                  </div>
                </div>
                <div class="mdl-cell mdl-cell--2-col">
                  <button id="button-chat-mobile"
                          class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--green">
                      <i class="material-icons">chat</i>
                  </button>
                  <!--Descrizione del pulsante mostra chat -->
                  <div class="mdl-tooltip mdl-tooltip--large" for="button-chat-mobile">
                    Chat
                  </div>
                </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>
