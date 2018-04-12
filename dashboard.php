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
    .mdl-fab-bottom-right {
      position: fixed;
      bottom: 24px;
    	right: 24px;
    	transition: bottom .25s cubic-bezier(0,0,.2,1);
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
        <section class="mdl-cell--hide-phone mdl-cell--hide-tablet">
          <?php
            include "include/dashboard-desktop.php";
           ?>
        </section>
        <!-- INFO UTENTE PER MOBILE-->
        <section class="mdl-cell--hide-desktop">
          <?php
            include "include/dashboard-mobile.php";
           ?>
        </section>
      </main>
    </div>
  </body>
</html>
