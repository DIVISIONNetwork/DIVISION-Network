function login_or_register_or_reset_password (a) {

  if (a == "register") {
    var register = `<div class="form-group">
                      <form method="post" action="">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-xs-12">
                              <label for="register_username" class="sr-only">E-Mail:</label>
                                <input type="text" class="form-control" id="register_email" placeholder="E-Mail" name="E-Mail">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12">
                              <label for="register_username" class="sr-only">Benutzername:</label>
                                <input type="text" class="form-control" id="register_username" placeholder="Benutzername" name="Benutzername">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12">
                              <label for="register_password" class="sr-only">Passwort:</label>
                                <input type="password" class="form-control" id="register_password" placeholder="Passwort" name="Passwort">
                                <div id="show_login_again_text_cell">
                                  <a href="" id="show_login_again_text" onclick="login_or_register_or_reset_password('login'); return false;">Doch anmelden?</a>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12">
                              <div id="login_or_register">
                                <button class="btn btn-default pull-center" id="signup_button" name="signup_button">Registrieren</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>`;
  document.getElementById('login_or_register_container').innerHTML = register;
} else if (a == "reset_password") {
  var reset_password = `<div class="form-group">
                          <form method="post" action="">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-xs-12">
                                  <label for="reset_password_email" class="sr-only">E-Mail:</label>
                                    <input type="text" class="form-control" id="password_reset_email" placeholder="E-Mail" name="E-Mail">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <label for="password_reset_new_password" class="sr-only">Neues Passwort:</label>
                                    <input type="password" class="form-control" id="password_reset_new_password" placeholder="Neues Passwort" name="Neues_Passwort">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <label for="password_reset_confirm_password" class="sr-only">Neues Passwort:</label>
                                    <input type="password" class="form-control" id="password_reset_confirm_password" placeholder="Neues Passwort" name="Neues_Passwort_bestätigen">
                                    <div id="show_login_again_text_cell">
                                      <a href="" id="show_login_again_text" onclick="login_or_register_or_reset_password('login'); return false;">Doch anmelden?</a>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div id="login_or_register">
                                    <button class="btn btn-default pull-center" id="password_reset_button" name="password_reset_button">Passwort ändern</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>`;
  document.getElementById('login_or_register_container').innerHTML = reset_password;
} else {
  var login = `<div class="form-group">
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
              </div>`;
  document.getElementById('login_or_register_container').innerHTML = login;
  }
}
