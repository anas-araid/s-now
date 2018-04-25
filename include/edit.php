<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--1-col"></div>
  <div class="mdl-card mdl-cell mdl-cell--10-col mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners">
    <h2 class="stile-text-azzurro ">
      Modifica
    </h2>
    <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">

    <div style="text-align:center">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">FOTO PROFILO</p>
          <img src="<?php echo $user['FotoProfilo'] ?>"
               style="border-radius:50%;width:100px;height:100px;">
          </img>
          <br>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label mdl-color-text--blue" for="fotoDaCaricare">Foto profilo (max 2mb)</label>
            <br>
            <input class="mdl-textfield__input" type="file" name="fotoDaCaricare">
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">NOME</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="nome"
                   name="nome"
                   required=""
                   maxlength="50"
                   style="text-align:center"
                   value="<?php echo $user['Nome']; ?>"/>
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">COGNOME</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="cognome"
                   name="cognome"
                   required=""
                   maxlength="50"
                   style="text-align:center"
                   value="<?php echo $user['Cognome']; ?>"/>
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">DATA DI NASCITA</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   id="dataDiNascita"
                   name="dataDiNascita"
                   type="date"
                   required=""
                   maxlength="50"
                   value="<?php echo date("Y-m-d", strtotime($user['DataDiNascita'])); ?>"
                   style="text-align:center;color:black"/>
          </div>
        </div>
        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">GENERE</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="genere" required="">
              <option value="M">Maschio</option>
              <option value="F">Femmina</option>
             </select>
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">RESIDENZA</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="residenza"
                   name="residenza"
                   required=""
                   maxlength="50"
                   style="text-align:center"
                   value="<?php echo $user['Residenza']; ?>"/>
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">EMAIL</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="email"
                   name="email"
                   required=""
                   maxlength="50"
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                   style="text-align:center"
                   value="<?php echo $user['Email']; ?>"/>
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">PASSWORD</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="password"
                   id="password"
                   name="password"
                   required=""
                   maxlength="50"
                   style="text-align:center"/>
          </div>
        </div>

        <div class="mdl-shadow--4dp mdl-color--white stile-card-corners">
          <p class="stile-text-azzurro">CONFERMA PASSWORD</p>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="password"
                   id="confermaPassword"
                   name="confermaPassword"
                   required=""
                   maxlength="50"
                   style="text-align:center"/>
          </div>
        </div>

        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--6-col">
            <button id="button-update"
                    class="mdl-button mdl-js-button mdl-button--raised"
                    style="width:100%;height:35px;color:white;background-color:#2ecc71;border:none;border-radius:20px;text-align:center"
                    type="submit">
              <i class="material-icons">done</i>
            </button>
          </div>
          <div class="mdl-cell mdl-cell--6-col">
            <button class="mdl-button mdl-js-button mdl-button--raised"
                    style="width:100%;height:35px;color:white;background-color:#e74c3c;border:none;border-radius:20px;;text-align:center"
                    onclick="location.href='show_user.php'">
              <i class="material-icons">cancel</i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--1-col"></div>
</div>
<script>
   var password          = document.getElementById("password");
   var conferma_password = document.getElementById("confermaPassword");
   //var registrati        = document.getElementById("signup");
   function validaPassword() {
       if (password.value != conferma_password.value){
         conferma_password.setCustomValidity("Le password non corrispondono o la lunghezza è insufficiente");
       }else{
         conferma_password.setCustomValidity("");
       }
   }
   password.onchange         = validaPassword;
   conferma_password.onkeyup = validaPassword;
</script>
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
        <label>Dettagli</label>
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
