<!doctype>
<html>
  <head>
  <?php
    include "include/header.html";
    include 'php/functions.php';
    include 'php/get_user_data.php';
    session_start();
    $user = getUserData($_SESSION['email']);
    if(!$_SESSION['isLogged'] or $_SESSION['isLogged'] == ""){
      session_destroy();
      header("location:login.php");
    }
   ?>
   <style>
    .mdl-layout__drawer-button{
      color: black!important;
    }
   </style>
 </head>

  <body class="mdl-color--grey-200">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
                mdl-layout--fixed-header">
      <header class="mdl-layout__header mdl-color--grey-200">
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
        <div class="page-content">
          <section>
            <!-- Info-->
            <div id="info">
              <div class="mdl-grid mdl-card mdl-cell mdl-cell--12-col mdl-shadow--16dp mdl-color--white"
                   style="border:none;border-radius:17px;padding:20px;">
                <div class="mdl-cell--2-col" style="text-align:center">
                  <img src=" <?php echo $_SESSION['fotoProfilo'] ?>"
                       style="width:150px;height:150px;border-radius:20px;" />
                </div>
                <div class="mdl-cell--1-col"></div>
                <div class="mdl-cell--9-col">
                  <h1 class="stile-text-azzurro">
                    <b><i>Ciao <?php echo $_SESSION['nome'] ?></i></b>
                  </h1>
                   <hr class="stile-azzurro" style="width:100px;height:10px;border:5px solid white;border-radius:10px;">
                   <div class="mdl-grid">
                     <div class="stile-dashboard-card mdl-cell mdl-cell--4-col mdl-shadow--4dp mdl-color--white">
                       <p class="stile-text-azzurro">EMAIL</p>
                       <p>
                         <?php
                          echo $user['Email'];
                         ?>
                       </p>
                     </div>
                     <div class="stile-dashboard-card mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp mdl-color--white">
                       <p class="stile-text-azzurro">CITTA'</p>
                       <p>
                         <?php
                          echo $user['Residenza'];
                         ?>
                       </p>
                     </div>
                     <div class="stile-dashboard-card mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp mdl-color--white">
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
            <!-- footer
            <div class="stile-main" style="padding:10px;text-align:center;">
              <div class="stile-footer">
               <p class="stile-testo-bianco"><i class="fa fa-code"></i> with <i class="fa fa-coffee"></i> by Anas Araid <i class="fa fa-copyright"></i> 2018</p>
              </div>
            </div>-->
          </section>
        </div>
      </main>
    </div>
  </body>
</html>
