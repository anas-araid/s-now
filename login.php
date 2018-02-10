<?php
  session_start();
  $_SESSION["Nome"] = "";
  $_SESSION['isLogged'] = false;
  // isset ritorna true se una variabile è stata assegnata
  if (isset($_POST['username']) && isset($_POST['password'])){
    include "connection.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM t_utenti";
    echo "<script>alert('asdf')</script>";
    $risultato = mysqli_query($conn, $sql);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $db_username = $ris['Email'];
      $db_password = $ris['Password'];
      //echo "user ".$db_username." ".$username;
      //echo "\npwd ".$db_password." ".md5($password);
      if ($db_username == $username && $db_password == md5($password)) {
        echo "<script>alert('Login corretto')</script>";
        $_SESSION['Nome'] = $ris['Nome'];
        $_SESSION['isLogged'] = true;
        //header("location:magazzino.php");
      }
    }
    /*$_POST['username']="";
    $_POST['password']="";
    if (!$_SESSION['isLogged']) {
      echo "<script>alert('Username o password errati')</script>";
    }*/
    //mysqli_close($conn);
  }
?>

<!doctype>
<html>
  <head>
    <title>s-now</title>
    <meta charset="utf-8"/>
    <meta name="theme-color" content="#2173b9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/reset.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <script src="js/script.js"></script>
  </head>
  <body>
    <!-- ========================== SIDEBAR ==========================================================

     w3-collapse nasconde la sidebar sui dispositivi mobili

    -->
    <nav id="menuLat" class="stile-azzurro w3-sidebar w3-collapse w3-large w3-top w3-padding" style="width:300px; z-index:3;font-weight:bold;">
      <!-- w3-hide-large classe che nasconde un elemento sui dispositivi grandi -->
      <button class="stile-small-round-button w3-hide-large" onclick="chiudiMenu()">X</button>
      <div class="w3-container">
        <h3 style="text-align:center;color:white;"><b>s-<i>now</i></b></h3>
      </div>
      <!-- w3-bar-block server per tenere la bar verticalmente-->
      <div class="w3-bar-block">
        <a href="index.html"
         onclick="chiudiMenu()"
         class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
         <p>Home</p>
        </a>
        <a href="mappa.html"
          onclick="chiudiMenu()"
          class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
          <p>Mappa</p>
        </a>
        <!--
        <a href="index.html#cose"
         onclick="chiudiMenu()"
         class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
         <p>Cos'è?</p>
        </a>
        <a href="index.html#situazione"
         onclick="chiudiMenu()"
         class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
         <p>Situazione</p>
        </a>
        <a href="index.html#consigli"
          onclick="chiudiMenu()"
          class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
          <p>Consigli</p>
        </a>
        <a href="index.html#gallery"
          onclick="chiudiMenu()"
          class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
          <p>Gallery</p>
        </a>
        -->
        <a href="#"
          onclick="chiudiMenu()"
          class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
          <p>Accedi</p>
        </a>
        <a href="https://github.com/asdf1899/s-now"
          class="stile-link w3-bar-item stile-bottone-generico w3-round-xxlarge">
          <p>GitHub <i class="fa fa-github"></i></p>
        </a>
      </div>
    </nav>

    <!-- =================================== Menu in alto per i disp. mobili ========================================= -->
    <header class="w3-container w3-top w3-hide-large stile-main w3-xlarge w3-padding">
      <button class="stile-small-round-button w3-hide-large" onclick="apriMenu();">☰</button>
      <span style="color:white">s-<i>now</i></span>
    </header>

    <!-- ================================== OPACITA' =================================================================

    Overlay è l'effetto di "opacità" sui disp. piccoli quando si apre il menu
    cursor:pointer cambia l'icona del cursore del mouse
    -->
    <div class="w3-overlay w3-hide-large" onclick="chiudiMenu()" style="cursor:pointer" id="opacita"></div>
    <!-- ================================= CORPO  =======================================================
        Contenuto della pagina
        il margin left è a 340px per non sovrapporsi con la sidebar
    -->
    <div class="w3-main" style="margin-left:300px;">
      <!-- Login -->
      <div class="w3-container stile-main" id="situazione" style="padding-top:100px;padding-bottom:72px;">
        <div class="w3-card-4 w3-panel w3-round-xlarge stile-card">
          <h1 class="w3-xxxlarge w3-text-white"><b><i>Login</i></b></h1>
          <hr style="width:100px;border:5px solid white" class="w3-round">
          <br>
          <form action="" method="post" style="color:white;text-align:center">
            <div class="w3-section">
              <label>Email <i class="fa fa-envelope"></i></label>
              <input style="color:white;background-color:rgba(255, 255, 255, 0.3);text-align:center;outline:none;border:none!important;"
                    class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required="">
            </div>
            <div class="w3-section">
              <label>Password <i class="fa fa-lock"></i></label>
              <input style="color:white;background-color:rgba(255, 255, 255, 0.3);text-align:center;outline:none;border:none!important;"
                     class="w3-input w3-border w3-round-xxlarge" type="password" name="password" required="">
            </div>
            <button type="submit" class="stile-bottone-generico stile-button-fill" style="width:50%;">Accedi <i class="fa fa-sign-in"></i></button>
          </form>
          <p class="w3-text-white" style="text-align:center;margin:2%;">Oppure</p>
          <div style="text-align:center;">
            <button class="stile-bottone-generico stile-button-fill" style="width:50%;" onclick="alert('Funzione non ancora disponibile')">Registrati</button>
          </div>
        </div>
      </div>
      <!-- footer -->
      <div class="stile-main" style="padding:16px;text-align:center;">
        <div class="stile-footer">
          <p class="w3-text-white"><i class="fa fa-code"></i> with <i class="fa fa-html5"></i> by Anas Araid <i class="fa fa-copyright"></i>2018</p>
        </div>
      </div>
    </div>
  </body>
</html>
