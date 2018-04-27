<?php
  include 'php/functions.php';
  include "php/db_connection.php";
  session_start();
  try{
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // error_reporting per togliere il notice quando non trova isLogged
    error_reporting(0);
    if($_SESSION["isLogged"]){
      header("location:dashboard.php");
    }else{
      $_SESSION = array();
    }
  }catch(Exception $e){
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

<?php


  if (!$error_message) {
    // isset ritorna true se una variabile è stata assegnata
    if (isset($_POST['username']) && isset($_POST['password'])){
      $username = text_filter_lowercase($_POST['username']);
      $password = $_POST['password'];
      $sql = "SELECT * FROM t_utenti WHERE Email='$username'";
      $risultato = mysqli_query($db_conn, $sql);
      if ($risultato == false){
        die("error");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $db_password = $ris['Password'];
        if (text_filter_encrypt($password) == $db_password) {
          $_SESSION['Nome'] = $ris['Nome'];
          $_SESSION['ID_utente'] = $ris['ID'];
          $_SESSION['email'] = $ris['Email'];
          $_SESSION['fotoProfilo'] = $ris['FotoProfilo'];
          $_SESSION['isLogged'] = true;
          //php_alert('Login corretto');
          echo "
          <script>
            flatAlert(' ', 'Login avvenuto con successo', 'success', 'dashboard.php');
          </script>";
          //header("location:dashboard.php");
          //echo "<script>location.href='dashboard.php'</script>";
        }
      }
      $_POST['username']="";
      $_POST['password']="";
      if (!$_SESSION['isLogged']) {
        //php_alert('Username o password errati');
        echo "
        <script>
            flatAlert('Accesso', 'Username o password errati', 'error', '');
        </script>";
      }
      //mysqli_close($conn);
    }
  }else{
    //php_alert('Impossibile connettersi al database');
    echo "
    <script>
        flatAlert('Accesso', 'Impossibile connettersi al database', 'error', '');
    </script>";
  }
?>
