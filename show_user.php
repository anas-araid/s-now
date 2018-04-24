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
      $user = getUserData($_SESSION['email']);
      if ($user['ID'] == null){
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
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--1-col"></div>
          <div class="mdl-card mdl-cell mdl-cell--10-col mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners">
            <h2 class="stile-text-azzurro ">
              Dettagli
            </h2>
            <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">

            <div style="text-align:center">

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">FOTO PROFILO</p>
                <img src="<?php echo $user['FotoProfilo'] ?>"
                     style="border-radius:50%;width:100px;height:100px;"></img>
              </div>

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">NOME</p>
                <p>
                  <?php
                   echo $user['Nome'];
                  ?>
                </p>
              </div>

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">COGNOME</p>
                <p>
                  <?php
                   echo $user['Cognome'];
                  ?>
                </p>
              </div>

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">DATA DI NASCITA</p>
                <p>
                  <?php
                   echo $user['DataDiNascita'];
                  ?>
                </p>
              </div>

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">GENERE</p>
                <p>
                  <?php
                   echo $user['Genere'] == 'M' ? "Uomo" : "Donna" ;
                  ?>
                </p>
              </div>

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">RESIDENZA</p>
                <p>
                  <?php
                   echo $user['Residenza'];
                  ?>
                </p>
              </div>

              <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                <p class="stile-text-azzurro">EMAIL</p>
                <p>
                  <?php
                   echo $user['Email'];
                  ?>
                </p>
              </div>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--1-col"></div>
        </div>

        <!-- Floating button espandibile-->
        <script>
          $(document).ready(() => {
              nitemarket.MaterialUtils.activateExpandableFAB();
          });
        </script>
        <div class="mdl-fab-bottom-right mdl-button--fab-expandable bottom right mdl-fab-expandable--snack">
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
                      class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--orange"
                      onclick="location.href='edit_user.php'">
                <i class="material-icons">mode_edit</i>
              </button>
              <div class="mdl-fab-expandable--child-label mdl-color-text--orange">
                <label>Modifica</label>
              </div>
            </div>

            <div class="mdl-fab-expandable--child">
              <button id="button-delete"
                      class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--red"
                      onclick="alertElimina()">
                <i class="material-icons">delete_forever</i>
              </button>
              <div class="mdl-fab-expandable--child-label mdl-color-text--red">
                <label>Elimina</label>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>



<!--

<dialog class="mdl-dialog stile-card-corners">
  <h4 class="mdl-dialog__title mdl-color-text--blue">Sei sicuro?</h4>
  <div class="mdl-dialog__content">
    <p>
      Perderai tutti i dati relativi al tuo account
    </p>
  </div>
  <div class="mdl-dialog__actions">
    <button type="button"
            class="mdl-button mdl-color--red mdl-color-text--white"
            style="border-radius:30px;"
            onclick="location.href='php/delete_user.php'">Continua</button>
    <button type="button" class="mdl-button close mdl-color-text--blue" style="border-radius:30px;">Annulla</button>
  </div>
</dialog>
<script>
  var dialog = document.querySelector('dialog');
  var showDialogButton = document.querySelector('#button-delete');
  if (! dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  showDialogButton.addEventListener('click', function() {
    dialog.showModal();
  });
  dialog.querySelector('.close').addEventListener('click', function() {
    dialog.close();
  });
</script>



-->
