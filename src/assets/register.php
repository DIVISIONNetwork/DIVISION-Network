<div class="form-group">
  <form method="post" action="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <label for="register_username" class="sr-only">E-Mail:</label>
            <input type="text" class="form-control" id="register_email" placeholder="E-Mail" name="register_email">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <label for="register_username" class="sr-only">Benutzername:</label>
            <input type="text" class="form-control" id="register_username" placeholder="Benutzername" name="register_username">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <label for="register_password" class="sr-only">Passwort:</label>
            <input type="password" class="form-control" id="register_password" placeholder="Passwort" name="register_password">
            <div id="show_login_again_text_cell">
              <a href="" id="show_login_again_text" onclick="login_or_register('login'); return false;">Doch anmelden?</a>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div id="login_or_register">
            <button class="btn btn-default pull-center" id="register_button">Registrieren</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
