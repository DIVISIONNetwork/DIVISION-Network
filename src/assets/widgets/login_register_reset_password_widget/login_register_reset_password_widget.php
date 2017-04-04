<!-- register_or_login.js wird eingebunden -->
<script type="text/javascript" src="./../src/assets/widgets/login_register_reset_password_widget/login_register_reset_password_widget.js"></script>

<!-- signup.php wird eingebunden -->
<?php include ("./../src/php/login_system/signup.php"); ?>
<!-- login.php wird eingebunden -->
<?php include ("./../src/php/login_system/login.php"); ?>
<!-- forgot_password.php wird eingebunden -->
<?php include ("./../src/php/login_system/forgot_password.php"); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <p id="login_register_reset_password_widget_errors">
        <?php if (isset($result)) {echo $result;} ?>
        <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
      </p>
    </div>
  </div>
</div>

<div id="login_or_register_container">
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
                <a href="" onclick="login_or_register_or_reset_password('reset_password'); return false;" id="forgot_password_text">Passwort vergessen?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login_or_register">
              <button type="submit" href="index.php" class="btn btn-danger pull-center" id="login_button" name="login_button">Anmelden</button>
              <div id="or_between_login_and_register">oder</div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="login_or_register">
            <button class="btn btn-default pull-center" onclick="login_or_register_or_reset_password('register');" id="go_to_signup_button">Registrieren</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
