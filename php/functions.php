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
    function getCoordinatesFromAddress($indirizzo){
          $address = $indirizzo;
          $address = str_replace(" ", "+", $address);
          $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyBgwoQUpZNuWrgKJseSI53sQvWZAFkBzQ4";
          $json = file_get_contents($url);
          $json = json_decode($json);
          $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
          $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

          $status = $json->status;
          if($status=="OK"){
            $coordinates = array();
            $coordinates["lat"] = $lat;
            $coordinates["long"] = $long;
            return $coordinates;
          }
          return "error";
    }
?>
