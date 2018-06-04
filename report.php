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
          <a class="mdl-navigation__link" href="include/help.html">Serve aiuto?</a>
          <a class="mdl-navigation__link" href="php/logout.php">Esci</a>
        </nav>
      </div>
      <main class="mdl-layout__content">

        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--1-col"></div>
          <div class="mdl-card mdl-cell mdl-cell--10-col mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners">
            <h2 class="stile-text-azzurro ">
              Aggiungi segnalazione
            </h2>
            <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">

            <div style="text-align:center">
              <form action="php/add_report.php" method="post" enctype="multipart/form-data">

                <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                  <p class="stile-text-azzurro">LUOGO</p>

                  <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                    <p class="stile-text-azzurro">via</p>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label stile-text-azzurro">
                      <input class="mdl-textfield__input"
                             type="text"
                             id="address"
                             name="address"
                             required=""
                             maxlength="50"
                             style="text-align:center"/>
                    </div>
                  </div>

                  <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                    <p class="stile-text-azzurro">città</p>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label stile-text-azzurro">
                      <input class="mdl-textfield__input"
                             type="text"
                             id="city"
                             name="city"
                             required=""
                             maxlength="50"
                             style="text-align:center"/>
                    </div>
                  </div>
                </div>

                <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                  <p class="stile-text-azzurro">DESCRIZIONE</p>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label stile-text-azzurro">
                    <input class="mdl-textfield__input"
                           type="text"
                           id="description"
                           name="description"
                           required=""
                           maxlength="50"
                           style="text-align:center"/>
                  </div>
                </div>

                <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
                  <p class="stile-text-azzurro">PERICOLOSITA'</p>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label stile-text-azzurro">
                    <select name="severity" required="" class="stile-text-azzurro" style="border-radius:15px;outline:none">
                      <option value="1">Bassa</option>
                      <option value="2">Medio-bassa</option>
                      <option value="3">Media</option>
                      <option value="4">Medio-alta</option>
                      <option value="5">Alta</option>
                     </select>
                  </div>
                </div>

                <div class="mdl-grid">
                  <div class="mdl-cell mdl-cell--6-col">
                    <button id="button-report"
                            class="mdl-button mdl-js-button mdl-button--raised"
                            style="width:100%;height:35px;color:white;background-color:#2ecc71;border:none;border-radius:20px;text-align:center"
                            type="submit">
                      <i class="material-icons">done</i>
                    </button>
                  </div>
                  <div class="mdl-cell mdl-cell--6-col">
                    <button class="mdl-button mdl-js-button mdl-button--raised"
                            style="width:100%;height:35px;color:white;background-color:#e74c3c;border:none;border-radius:20px;;text-align:center"
                            type="reset"
                            onclick="location.href='dashboard.php'">
                      <i class="material-icons">cancel</i>
                    </button>
                  </div>
                </div>
              </form>

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
                      onclick="location.href='show_user.php'">
                <i class="material-icons">account_circle</i>
              </button>
              <div class="mdl-fab-expandable--child-label mdl-color-text--orange">
                <label>Dettagli utente</label>
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
