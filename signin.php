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
            // da far funzionare
            $fotoProfilo = text_filter($_POST["fotoProfilo"]);
            if (!isset($fotoProfilo)){
              $directory = "uploads/";
              $file = $directory.basename($_FILES["fotoProfilo"]["name"]);
              $target_file="";
              $immagineConEstensione = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            }
            $query = "INSERT INTO t_utenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password)
                      VALUES('$nome', '$cognome', '$data', '$genere', '$residenza', '$fotoProfilo', '$email', '$password')";
            try{
                $insert = mysqli_query($db_conn, $query);
                if ($insert==null)
                    throw new exception ("Utente gi&agrave; esistente");
                php_alert('Registrazione completata');
                $_SESSION['Nome'] = $nome;
                $_SESSION['isLogged'] = true;
                //header("Location: index.php");
            } catch (Exception $e){
                $message = $e->getMessage();
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
      include "include/signin.html";
    ?>
    <script>
       var password          = document.getElementById("password");
       var conferma_password = document.getElementById("confermaPassword");
       function validaPassword() {
           if (password.value != conferma_password.value)
               conferma_password.setCustomValidity("Le password non corrispondono!");
           else
               conferma_password.setCustomValidity("");
       }
       password.onchange         = validaPassword;
       conferma_password.onkeyup = validaPassword;
   </script>
  </body>
</html>
