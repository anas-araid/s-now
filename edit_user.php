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
    // Controlla se la foto profilo esiste, altrimenti usa quella default
    $_SESSION['fotoProfilo'] = profilePicture($_SESSION['email'], $_SESSION['fotoProfilo']);
    // getUserData ritorna un array con tutte le info dell'utente
    $user = getUserData($_SESSION['email'], "php/db_connection.php");
    if(!$_SESSION['isLogged'] or $_SESSION['isLogged'] == "" or $user['ID'] == null){
      session_destroy();
      header("location:php/logout.php");
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
          <a class="mdl-navigation__link" href="include/help.html">Serve aiuto?</a>
          <a class="mdl-navigation__link" href="php/logout.php">Esci</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <?php include "include/edit.php"; ?>
      </main>
    </div>
  </body>
</html>

<?php
  include 'php/db_connection.php';
  if (!$error_message) {
      if (isset($_POST['nome']) &&
          isset($_POST['cognome']) &&
          isset($_POST['dataDiNascita']) &&
          isset($_POST['genere']) &&
          isset($_POST['residenza']) &&
          isset($_POST['email']) &&
          isset($_POST['password']))
      {
          $nome       = text_filter($_POST["nome"]);
          $cognome    = text_filter($_POST["cognome"]);
          $dataDiNascita = text_filter($_POST["dataDiNascita"]);
          $genere      = text_filter($_POST["genere"]);
          $residenza  = text_filter($_POST["residenza"]);
          $email      = text_filter_lowercase($_POST["email"]);
          $password   = text_filter_encrypt($_POST["password"]);
          $updateUser = true;
          $isValid = false;
          if ($_FILES["caricamentoFoto"]["size"] != 0){
            $directory = "uploads/";
            $fotoProfilo = $directory.basename($_FILES["caricamentoFoto"]["name"]);
            $estensioneImg = strtolower(pathinfo($fotoProfilo, PATHINFO_EXTENSION));
            $fotoProfilo = ".".$estensioneImg;
            // controlla se è realmente un immagine
            if($estensioneImg === "png" || $estensioneImg === "jpg" || $estensioneImg === "jpeg") {
              // Controlla la dimensione dell'immagine < 2mb
              if ($_FILES["caricamentoFoto"]["size"] > 2000000) {
                //php_alert("Immagine troppo grande");
                echo "
                <script>
                    flatAlert('Registrazione', 'Immagine troppo grande', 'error', 'edit_user.php');
                </script>";
                $updateUser = false;
                $fotoProfilo = $user['FotoProfilo'];
              }else{
                // l'immagine selezionata è valida quindi si può caricarla
                $isValid = true;
              }
            } else {
                echo "
                <script>
                    flatAlert('Registrazione', 'Immagine non valida', 'error', 'edit_user.php');
                </script>";
                $updateUser = false;
                //php_alert("Immagine non valida");
                $fotoProfilo = $user['FotoProfilo'];
            }
          }else{
            $fotoProfilo = $user['FotoProfilo'];
          }
          if ($updateUser){
          // se l'immagine ha passato i controlli
            if ($isValid){
              $fotoProfilo = "uploads/".$user['ID'].$fotoProfilo;
              if (!move_uploaded_file($_FILES["caricamentoFoto"]["tmp_name"], $fotoProfilo)){
                echo "Impossibile caricare l'immagine";
              }
            }
            $userID = $user['ID'];
            $query = "UPDATE t_utenti
                      SET Nome='$nome', Cognome='$cognome', DataDiNascita='$dataDiNascita', Genere='$genere', Residenza='$residenza', FotoProfilo='$fotoProfilo', Email='$email', Password='$password'
                      WHERE (ID = '$userID')";
            try{
                $update = mysqli_query($db_conn, $query);
                if ($update==null){
                    throw new exception ("Impossibile aggionare i dati");
                }
                // AGGIORNA ANCHE SESSION
                $user = getUserData($email, "php/db_connection.php");
                $_SESSION["email"] = $user["Email"];
                $_SESSION["fotoProfilo"] = $user["FotoProfilo"];
                $_SESSION["nome"] = $user["Nome"];

                echo "
                <script>
                flatAlert('Modifica', 'Aggiornamento dei dati completato!', 'success', 'show_user.php');
                </script>";
              } catch (Exception $e){
                  $message = $e->getMessage();
                  //php_alert($message);
                  echo "
                  <script>
                      flatAlert('Modifica', '$message' , 'error', 'edit_user.php');
                  </script>";
              }
          }
      }
    }
 ?>
