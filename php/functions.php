<?php
    function text_filter($text){
        return trim(filter_var($text, FILTER_SANITIZE_STRING));
    }

    function text_filter_lowercase($text){
        return trim(strtolower(filter_var($text, FILTER_SANITIZE_STRING)));
    }

    function text_filter_uppercase($text){
        return trim(strtoupper(filter_var($text, FILTER_SANITIZE_STRING)));
    }

    function text_filter_encrypt($text){
        return hash('md5', $text);
    }
    function php_alert($text){
      echo "<script>alert('".$text."')</script>";
    }
    function php_log($text){
      echo "<script>console.log('".$text."')</script>";
    }
    function profilePicture($email, $filePath){
      include "php/db_connection.php";
      // Controlla se la foto profilo esiste, altrimenti usa quella default
      $default = 'uploads/default.png';
      if (!file_exists($filePath)) {
        $sql = "UPDATE t_utenti SET FotoProfilo = '$default' WHERE Email = '$email' ";
        $update = mysqli_query($db_conn, $sql);
        return $default;
      }
      return $filePath;
    }
?>
