<!doctype>
<html>
  <head>
    <?php
      include "include/header.html";
      include 'php/functions.php';
      include 'php/get_user_data.php';
      session_start();
      // Controlla se la foto profilo esiste, altrimenti usa quella default
      $_SESSION['fotoProfilo'] = profilePicture($_SESSION['email'], $_SESSION['fotoProfilo']);
      // getUserData ritorna un array con tutte le info dell'utente
      $user = getUserData($_SESSION['email'], "php/db_connection.php");
      if ($user['ID'] == null){
        header("location:php/logout.php");
      }

      $receiverData = null;
      if ($_GET['username'] != null){
        $receiverEmail =  $_GET['username'];
        $receiverData = getUserData($receiverEmail, "php/db_connection.php");
      }else{
        "Inserisci email...";
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
      .swal-modal {
        border-radius: 20px;
      }
      .swal-title {
        color: #03a9f4;
        font-family: 'Quicksand', sans-serif;
      }
      .swal-button--button {
        background-color: #e74c3c;
        border: none!important;
        outline: none!important;
        border-radius: 10px;
      }
      .swal-button--cancel {
        color: #3498db;
        border-radius: 10px;
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
          <a class="mdl-navigation__link" href="dashboard.php">Dashboard</a>
          <a class="mdl-navigation__link" href="https://github.com/asdf1899/s-now">GitHub <i class="fa fa-github"></i></a>
          <a class="mdl-navigation__link" href="php/logout.php">Esci</a>
        </nav>
      </div>
      <main class="mdl-layout__content">

        <!-- Floating button espandibile-->
        <div class="mdl-fab-bottom-right mdl-button--fab-expandable bottom right mdl-fab-expandable--snack" style="z-index:100">
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--blue">
            <i class="material-icons">more_vert</i>
          </button>
          <div class="mdl-fab-expandable--children">

            <div class="mdl-fab-expandable--child">
              <button id="button-dashboard"
                      class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--green"
                      onclick="location.href='dashboard.php'">
                <i class="material-icons">dashboard</i>
              </button>
              <div class="mdl-fab-expandable--child-label mdl-color-text--green">
                <label>Dashboard</label>
              </div>
            </div>

            <div class="mdl-fab-expandable--child">
              <button id="button-edit"
                      class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--red"
                      onclick="location.href='show_user.php'">
                <i class="material-icons">account_circle</i>
              </button>
              <div class="mdl-fab-expandable--child-label mdl-color-text--red">
                <label>Dettagli utente</label>
              </div>
            </div>

            <div class="mdl-fab-expandable--child">
              <button id="button-delete"
                      class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--orange"
                      onclick="location.refresh()">
                <i class="material-icons">refresh</i>
              </button>
              <div class="mdl-fab-expandable--child-label mdl-color-text--orange">
                <label>Aggiorna</label>
              </div>
            </div>
          </div>
        </div>

        <div class="mdl-grid">
          <div id="chat" class="mdl-card mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners">
            <h2 class="stile-text-azzurro ">
              Chat
            </h2>
            <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">
            <form action="php/send_message.php" method="post" enctype="multipart/form-data">
              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners" style="text-align:center">
                <p class="stile-text-azzurro">username destinatario</p>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label stile-text-azzurro" style="text-align:center">
                  <input class="mdl-textfield__input"
                         type="text"
                         id="receiverEmail"
                         name="receiverEmail"
                         required=""
                         maxlength="50"
                         placeholder="<?php echo $receiverData['Nome'] != null ? $receiverData['Email'] : "Inserisci email..." ?>"
                         style="text-align:center"/>
                </div>
              </div>
              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners" style="text-align:center">
                <p class="stile-text-azzurro">Messaggio</p>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label stile-text-azzurro" style="text-align:center">
                  <input class="mdl-textfield__input"
                         type="text"
                         id="message"
                         name="message"
                         required=""
                         maxlength="130"
                         style="text-align:center"/>
                </div>
              </div>
              <button id="button-send"
                      class="mdl-button mdl-js-button mdl-button--raised"
                      style="width:100%;height:35px;color:white;background-color:#2ecc71;border:none;border-radius:20px;text-align:center;margin:20px 0px"
                      type="submit">
                <i class="material-icons">send</i>
              </button>
            </form>
          </div>
          <!-- overflow: auto mette lo scroll-->
          <div id="messages" class="mdl-card mdl-cell mdl-cell--8-col mdl-cell--12-col-phone mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners" style="max-height:640px;">
            <h2 class="stile-text-azzurro ">
              Messaggi
            </h2>
            <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">
            <button id="button-refresh"
                    class="mdl-button mdl-js-button mdl-button--raised mdl-color--orange"
                    style="width:80%;height:35px;color:white;border:none;border-radius:20px;text-align:center;margin:20px 0px"
                    onclick="location.reload()">
              <i class="material-icons">refresh</i>
            </button>
            <div style="overflow:auto; mdl-grid">
              <?php include "php/getMessagesByUser.php" ?>
            <div>
          </div>
        </div>


        <!-- Floating button espandibile-->
        <script>
          $(document).ready(() => {
              nitemarket.MaterialUtils.activateExpandableFAB();
          });
          // SISTEMA L'ALTEZZA DEL DIV MESSAGGI CON QUELLO DELLA CHAT
          jQuery('#messages').css('max-height', jQuery('#chat').css('height'));
          jQuery('#messages').css('min-height', jQuery('#chat').css('height'));

        </script>

      </main>
    </div>
  </body>
</html>
