<!doctype>
<html>
  <head>
  <?php
    include "include/header.html";
    include 'php/functions.php';
    session_start();
    if(!$_SESSION['isLogged']){
      echo "<script>alert('Sessione scaduta')</script>";
      session_destroy();
      header('location:login.php');
    }
   ?>
 </head>
  <body class="stile-main">
    <script>
    function logout(){
      <?php
        $_SESSION["isLogged"] = false;
        session_destroy();
      ?>
      location.href = 'index.html';
    }
    </script>
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
            <a class="mdl-navigation__link" href="mappa.php">Mappa</a>
            <a class="mdl-navigation__link" href="https://github.com/asdf1899/s-now">Github <i class="fa fa-github"></i></a>
            <a class="mdl-navigation__link" href="" onclick="logout()">Esci</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title stile-text-azzurro">s-<i>now</i></span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link stile-text-azzurro" href="index.html">Home</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="mappa.php">Mappa</a>
          <a class="mdl-navigation__link stile-text-azzurro" href="https://github.com/asdf1899/s-now">Github <i class="fa fa-github"></i></a>
          <a class="mdl-navigation__link stile-text-azzurro" href="#" onclick="logout()">Esci</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <section>
          <!-- login-->
          <div id="cose" class="mdl-grid">
            <div class="mdl-card mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--16dp stile-card" style="border:none;border-radius:17px;">
              <h1 class="stile-testo-bianco"><b><i>Ciao <?php echo $_SESSION["Nome"] ?></i></b></h1>
               <hr style="width:100px;border:5px solid white;border-radius:10px;background:white;">
               <div class="mdl-card mdl-cell mdl-cell--7-col mdl-cell--middle mdl-shadow--4dp stile-card" style="text-align:center;background:rgba(255,255,255,0.7);border:none;border-radius:17px;">



               </div>
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
