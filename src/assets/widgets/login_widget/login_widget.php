<?php if (!isset($_SESSION["username"])): ?>
  <div id="login_or_signup_container">
    <div class="form-group">
      <form method="post" action="">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <label for="login_username" class="sr-only">Benutzername:</label>
                <input type="text" class="form-control" id="login_username" name="Benutzername" placeholder="Benutzername">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <label for="login_password" class="sr-only">Passwort:</label>
                <input type="password" class="form-control" id="login_password" name="Passwort" placeholder="Passwort">
                <div id="forgot_password_cell">
                  <a href="./forgot_password.php" id="forgot_password_text">Passwort vergessen?</a>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="checkbox" id="remember_me_checkbox_cell">
                <label><input class="pull-right" type="checkbox" value="" id="remember_me_checkbox"><span id="remember_me_checkbox_text">Angemeldet bleiben</span></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="login_or_signup">
                <button type="submit" href="index.php" class="btn btn-danger pull-center" id="login_button" name="login_button">Anmelden</button>
                <div id="or_between_login_and_signup">oder</div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="login_or_signup">
              <a href="signup.php">
                <button class="btn btn-default pull-center" id="go_to_signup_button">Registrieren</button>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <?php if (isset($result)) {echo $result;} ?>
            <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
            <?php if (isset($result)) {echo '</div>';} ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif ?>
