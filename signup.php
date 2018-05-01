<?php
  session_start();
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
      include "include/signup.html";
    ?>
  </body>
</html>
<?php
    include 'php/db_connection.php';
    include 'php/functions.php';
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
            $data       = text_filter($_POST["dataDiNascita"]);
            $genere      = text_filter($_POST["genere"]);
            $residenza  = text_filter($_POST["residenza"]);
            $email      = text_filter_lowercase($_POST["email"]);
            $password   = text_filter_encrypt($_POST["password"]);
            $addUser = true;
            if (isset($_FILES["fotoDaCaricare"])){
              $isValid = false;
              $directory = "uploads/";
              $fotoProfilo = $directory.basename($_FILES["fotoDaCaricare"]["name"]);
              $estensioneImg = strtolower(pathinfo($fotoProfilo, PATHINFO_EXTENSION));
              $fotoProfilo = ".".$estensioneImg;
              // controlla se è realmente un immagine
              if($estensioneImg === "png" || $estensioneImg === "jpg" || $estensioneImg === "jpeg") {
                // Controlla la dimensione dell'immagine < 2mb
                if ($_FILES["fotoDaCaricare"]["size"] > 2000000) {
                  //php_alert("Immagine troppo grande");
                  echo "
                  <script>
                      flatAlert('Registrazione', 'Immagine troppo grande', 'error', 'signup.php');
                  </script>";
                  $addUser = false;
                  $fotoProfilo = "uploads/default.png";
                }else{
                  // l'immagine selezionata è valida quindi si può caricarla
                  $isValid = true;
                }
              } else {
                if ($estensioneImg === "" || $estensioneImg === " "){
                  $addUser = true;
                  $fotoProfilo = "uploads/default.png";
                }else{
                  echo "
                  <script>
                  flatAlert('Registrazione', 'Immagine non valida', 'error', 'signup.php');
                  </script>";
                  $addUser = false;
                  //php_alert("Immagine non valida");
                  $fotoProfilo = "uploads/default.png";
                }
              }
            }else{
              $fotoProfilo = "uploads/default.png";
            }
            if ($addUser){
              $userID = null;
              $insertQuery = "INSERT INTO t_utenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password)
                        VALUES('$nome', '$cognome', '$data', '$genere', '$residenza', '$fotoProfilo', '$email', '$password')";
              try{
                  $insert = mysqli_query($db_conn, $insertQuery);
                  if ($insert==null){
                      throw new exception ("Utente già esistente");
                  }
                  // SCONSIGLIATO: mysqli_insert_id restituisce l'ultimo id della tupla creata
                  // $userID = mysqli_insert_id($db_conn);

                  // Estraggo l'id dell'utente
                  $selectQuery = "SELECT ID FROM t_utenti WHERE Email='$email'";
                  $select = mysqli_query($db_conn, $selectQuery);
                  if ($select==null){
                    throw new exception ("Errore nel restituire l'id");
                  }
                  while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
                    $userID = $ris["ID"];
                  }
                  // se l'immagine ha passato i controlli
                  if ($isValid){
                    $fotoProfilo = "uploads/".$userID.$fotoProfilo;
                    $updateQuery = "UPDATE t_utenti SET FotoProfilo='$fotoProfilo' WHERE (Email='$email')";
                    $update = mysqli_query($db_conn, $updateQuery);
                    if ($update==null){
                        throw new exception ("Impossibile aggiornare l'utente");
                    }
                    if ($isValid) {
                      if (!move_uploaded_file($_FILES["fotoDaCaricare"]["tmp_name"], $fotoProfilo)){
                        echo "Impossibile caricare l'immagine";
                      }
                    }
                  }
                  $_SESSION['Nome'] = $nome;
                  $_SESSION['email'] = $email;
                  $_SESSION['fotoProfilo'] = $fotoProfilo;
                  $_SESSION['ID_utente'] = $userID;
                  $_SESSION['isLogged'] = true;
                  //php_alert('Registrazione completata');
                  // HEADER STRANAMENTE NON FA NIENTE
                  //header("Location: dashboard.php");
                  //echo "<script>location.href='dashboard.php'</script>";
                  echo "
                  <script>
                  flatAlert('Registrazione', 'Registrazione completata', 'success', 'dashboard.php');
                  </script>";
              } catch (Exception $e){
                  $message = $e->getMessage();
                  //php_alert($message);
                  echo "
                  <script>
                      flatAlert('Registrazione', '$message' , 'error', 'signup.php');
                  </script>";
              }
            }

        }
    }
?>
