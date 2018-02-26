<?php
    include 'include/db_connection.php';
    include 'include/functions.php';
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
            $data       = text_filter($_POST["data"]);
            $genere      = text_filter($_POST["genere"]);
            $residenza  = text_filter($_POST["residenza"]);
            $fotoProfilo= text_filter($_POST["fotoProfilo"]);
            $email      = text_filter_lowercase($_POST["email"]);
            $password   = text_filter_encrypt($_POST["password"]);
            $query = "INSERT INTO tutenti (Nome, Cognome, DataDiNascita, Genere, Residenza, FotoProfilo, Email, Password)
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
  <body>

  </body>

</html>
