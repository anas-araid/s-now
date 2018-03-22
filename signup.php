<?php
    include 'php/db_connection.php';
    include 'php/functions.php';
    session_start();
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

            if (isset($_FILES["fotoDaCaricare"])){
              $directory = "uploads/";
              $fotoProfilo = $directory.basename($_FILES["fotoDaCaricare"]["name"]);
              $estensioneImg = strtolower(pathinfo($fotoProfilo, PATHINFO_EXTENSION));
              $fotoProfilo = $directory.basename($email).".".$estensioneImg;
              php_alert($fotoProfilo);
              // controlla se è realmente un immagine
              if($estensioneImg === "png" || $estensioneImg === "jpg" || $estensioneImg === "jpeg") {
                // Controlla la dimensione dell'immagine < 1mb
                if ($_FILES["fotoDaCaricare"]["size"] > 1000000) {
                  php_alert("Immagine troppo grande");
                  $fotoProfilo = "uploads/default.png";
                }else{
                  if (!move_uploaded_file($_FILES["fotoDaCaricare"]["tmp_name"], $fotoProfilo)) {
                      echo "Impossibile caricare l'immagine";
                  }
                }
              } else {
                  php_alert("Immagine non valida");
                  $fotoProfilo = "uploads/default.png";
              }
            }else{
              php_alert("Immagine non valida, utilizzare solamente il formato png e jpg");
              $fotoProfilo = "uploads/default.png";
            }
            $_SESSION['fotoProfilo'] = $fotoProfilo;
            $query = "INSERT INTO t_utenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password)
                      VALUES('$nome', '$cognome', '$data', '$genere', '$residenza', '$fotoProfilo', '$email', '$password')";
            try{
                $insert = mysqli_query($db_conn, $query);
                if ($insert==null)
                    throw new exception ("Utente già esistente");
                php_alert('Registrazione completata');
                $_SESSION['Nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['fotoProfilo'] = $fotoProfilo;
                $_SESSION['isLogged'] = true;
                header("Location: dashboard.php");
            } catch (Exception $e){
                $message = $e->getMessage();
                php_alert($message);
            }
        }
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
      include "include/signup.html";
    ?>
  </body>
</html>
