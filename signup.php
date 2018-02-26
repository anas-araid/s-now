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
            $data       = text_filter($_POST["dataDiNascita"]);
            $genere      = text_filter($_POST["genere"]);
            $residenza  = text_filter($_POST["residenza"]);
            $fotoProfilo= text_filter($_POST["fotoProfilo"]);
            $email      = text_filter_lowercase($_POST["email"]);
            $password   = text_filter_encrypt($_POST["password"]);
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
 <body>
   <?php
     include "include/sidebar.html";
    ?>
     <!-- ================================= CORPO  =======================================================
       Contenuto della pagina
       il margin left è a 340px per non sovrapporsi con la sidebar
   -->
   <div class="w3-main" style="margin-left:300px;">

     <form action="" method="post">
       <div class="w3-section">
         <label style="color:black">Nome: </label><br>
         <input type="text" id="nome" name="nome" style="border:1px solid black;color:black;"></input>
       </div>
       <div class="w3-section">
         <label style="color:black">Cognome: </label><br>
         <input type="text" id="cognome" name="cognome" style="border:1px solid black;color:black;"></input>
       </div>
       <div class="w3-section">
         <label style="color:black">Data di nascita: </label><br>
         <input type="date" id="dataDiNascita" name="dataDiNascita" style="border:1px solid black;color:black;"></input>
       </div>
       <div class="w3-section">
         <label style="color:black">Genere: </label><br>
         <select name="genere" id="genere">
          <option value="M">Maschio</option>
          <option value="F">Femmina</option>
         </select>
       </div>
       <div class="w3-section">
         <label style="color:black">Residenza: </label><br>
         <input type="text" id="residenza" name="residenza" style="border:1px solid black;color:black;"></input>
       </div>
       <div class="w3-section">
         <label style="color:black">Foto profilo: </label><br>
         <input type="text" id="fotoProfilo" name="fotoProfilo" style="border:1px solid black;color:black;"></input>
       </div>
       <div class="w3-section">
         <label style="color:black">Email: </label><br>
         <input type="text" id="email" name="email" style="border:1px solid black;color:black;"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" maxlength="50">
          </input>
       </div>
       <div class="w3-section">
         <label style="color:black">Password: </label><br>
         <input id="password" type="password" name="password" style="border:1px solid black;color:black;" required=""></input>
       </div>
       <div class="w3-section">
         <label style="color:black">Conferma password: </label><br>
         <input id="confermaPassword" type="password" name="confermaPassword" style="border:1px solid black;color:black;" required=""></input>
       </div>
       <button type="submit" id="btnRegistrazione" name="btnRegistrazione">Registrati</button>
     </form>

   </div>
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
