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
              onclick="alertEliminaUtente()">
        <i class="material-icons">delete_forever</i>
      </button>
      <div class="mdl-fab-expandable--child-label mdl-color-text--red">
        <label>Elimina</label>
      </div>
    </div>
  </div>
</div>
