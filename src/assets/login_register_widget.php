<!-- register_or_login.js wird eingebunden -->
<script type="text/javascript" src="./../src/js/login_or_register.js"></script>

<!-- signup.php wird eingebunden -->
<?php include ("./../src/php/signup.php"); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <p>
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
              <input type="text" class="form-control" id="login_username" placeholder="Benutzername">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <label for="login_password" class="sr-only">Passwort:</label>
              <input type="password" class="form-control" id="login_password" placeholder="Passwort">
              <div id="forgot_password_cell">
                <a href="index.php" id="forgot_password_text">Kontodaten vergessen?</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="login_or_register">
              <button type="submit" class="btn btn-danger pull-center" id="login_button">Anmelden</button>
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
            <button class="btn btn-default pull-center" onclick="login_or_register('register');" id="go_to_signup_button">Registrieren</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
