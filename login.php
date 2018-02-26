<?php
  include 'include/functions.php';
  include "include/db_connection.php";

  session_start();
  $_SESSION["Nome"] = "";
  $_SESSION['isLogged'] = false;
  if (!$error_message) {
    // isset ritorna true se una variabile è stata assegnata
    if (isset($_POST['username']) && isset($_POST['password'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql = "SELECT * FROM t_utenti";
      $risultato = mysqli_query($db_conn, $sql);
      if ($risultato == false){
        die("error");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $db_username = $ris['Email'];
        $db_password = $ris['Password'];
        if ($db_username == $username && $db_password == $password) {
          php_alert('Login corretto');
          $_SESSION['Nome'] = $ris['Nome'];
          $_SESSION['isLogged'] = true;
          //header("location:dashboard.php");
        }
      }
      /*$_POST['username']="";
      $_POST['password']="";
      if (!$_SESSION['isLogged']) {
        echo "<script>alert('Username o password errati')</script>";
      }*/
      //mysqli_close($conn);
    }
  }else{
    php_alert('Impossibile connettersi al database');
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
    <?php
      include "include/sidebar.html";
     ?>
      <!-- ================================= CORPO  =======================================================
        Contenuto della pagina
        il margin left è a 340px per non sovrapporsi con la sidebar
    -->
    <div class="w3-main" style="margin-left:300px;">
      <?php
        include "include/login.html";
        include "include/footer.html";
       ?>

    </div>
  </body>
</html>
