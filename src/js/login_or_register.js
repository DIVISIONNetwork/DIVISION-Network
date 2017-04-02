function login_or_register (a) {

  if (a == "register") {
    var register = `<div class="form-group">
                      <form method="post" action="">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-xs-12">
                              <label for="register_username" class="sr-only">E-Mail:</label>
                                <input type="text" class="form-control" id="email" placeholder="E-Mail" name="email">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12">
                              <label for="register_username" class="sr-only">Benutzername:</label>
                                <input type="text" class="form-control" id="username" placeholder="Benutzername" name="username">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12">
                              <label for="register_password" class="sr-only">Passwort:</label>
                                <input type="password" class="form-control" id="password" placeholder="Passwort" name="password">
                                <div id="show_login_again_text_cell">
                                  <a href="" id="show_login_again_text" onclick="login_or_register('login'); return false;">Doch anmelden?</a>
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
    } else {
      var login = `<div class="form-group">
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
                  </div>`;
      document.getElementById('login_or_register_container').innerHTML = login;
      }
}
