<script>
  $(document).ready(() => {
      nitemarket.MaterialUtils.activateExpandableFAB();
  });
</script>
<div id="info-mobile" class="mdl-grid">
  <div class="mdl-card mdl-grid mdl-cell mdl-cell--12-col mdl-cell--middle mdl-shadow--4dp mdl-color--white stile-card-corners">
    <div class="mdl-cell mdl-cell--12-col">
      <h2 class="stile-text-azzurro ">
        Ciao <?php echo $_SESSION['Nome'] ?>
      </h2>
      <hr class="stile-azzurro" style="width:100px;height:8px;border:5px solid white;border-radius:10px;">
    </div>
  </div>
  <div class="mdl-fab-bottom-right mdl-button--fab-expandable bottom right mdl-fab-expandable--snack">
    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--blue">
      <i class="material-icons">more_vert</i>
    </button>
    <div class="mdl-fab-expandable--children">
      <div class="mdl-fab-expandable--child">
        <button id="button-settings-mobile"
                class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--orange">
          <i class="material-icons">account_circle</i>
        </button>
        <div class="mdl-fab-expandable--child-label mdl-color-text--orange">
          <label>Account</label>
        </div>
      </div>
      <div class="mdl-fab-expandable--child">
        <button id="button-chat-mobile"
                class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--green">
            <i class="material-icons">chat</i>
        </button>
        <div class="mdl-fab-expandable--child-label mdl-color-text--green">
          <label>Chat</label>
        </div>
      </div>
      <div class="mdl-fab-expandable--child">
        <button id="button-maps-mobile"
                class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--red">
            <i class="material-icons">add_location</i>
        </button>
        <div class="mdl-fab-expandable--child-label mdl-color-text--red">
          <label>Nuova segnalazione</label>
        </div>
      </div>
    </div>
  </div>

</div>
