<?php $page_title = "Passwort vergessen - DIVISION Network" ?>
<?php include_once("./../src/php/login_system/database_connection.php"); ?>
<?php include_once("./../src/php/login_system/utilities.php"); ?>
<?php include_once("./../src/php/login_system/forgot_password.php"); ?>
<?php include_once("./../src/assets/head.php"); ?>
<?php include_once("./../src/assets/header.php"); ?>
<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="chronik">
      <div id="login_or_signup_container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">
                <?php if (isset($result)) {echo $result;} ?>
                <?php if (!empty($form_errors)) {echo show_errors($form_errors);} ?>
                <?php if (isset($result)) {echo '</div>';} ?>
            </div>
          </div>
        </div>
        <div class="form-group">
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
                      <a href="./login.php" id="show_login_again_text">Doch anmelden?</a>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="login_or_signup">
                      <button type="submit" class="btn btn-default pull-center" id="password_reset_button" name="password_reset_button">Passwort ändern</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right_sidebar_col">
      <div id="right_sidebar">
      <?php include_once("./../src/assets/widgets/social_nav_widget/social_nav_widget.php"); ?>
      </div>
    </div>
    <?php include_once("./../src/assets/widgets/chat_widget/chat_widget.php"); ?>
</div>
