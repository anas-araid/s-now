<?php
  include 'php/functions.php';
  include "php/db_connection.php";
  session_start();
  $_SESSION["Nome"] = "";
  $_SESSION['isLogged'] = false;
  if (!$error_message) {
    // isset ritorna true se una variabile è stata assegnata
    if (isset($_POST['username']) && isset($_POST['password'])){
      $username = text_filter_lowercase($_POST['username']);
      $password = $_POST['password'];
      $sql = "SELECT * FROM t_utenti";
      $risultato = mysqli_query($db_conn, $sql);
      if ($risultato == false){
        die("error");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $db_username = $ris['Email'];
        $db_password = $ris['Password'];
        if ($db_username == $username && $db_password == text_filter_encrypt($password)) {
          php_alert('Login corretto');
          $_SESSION['Nome'] = $ris['Nome'];
          $_SESSION['isLogged'] = true;
          header("location:dashboard.php");
        }
      }
      $_POST['username']="";
      $_POST['password']="";
      if (!$_SESSION['isLogged']) {
        php_alert('Username o password errati');
      }
      //mysqli_close($conn);
    }
  }else{
    php_alert('Impossibile connettersi al database');
  }
?>

<!doctype>
<html>
  <head>
  <?php
    include "include/header.html";
   ?>
 </head>
  <body class="stile-main">
      <?php
        include "include/login.html";
        ?>
  </body>
</html>
