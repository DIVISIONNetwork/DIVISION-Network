<!-- postbox.js wird eingebunden -->
<script type="text/javascript" src="./../src/js/postbox.js"></script>
<!-- Wenn der Benutzer eingeloggt ist, wird die Postbox angezeigt. -->
<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
  <div class="container-fluid" id="post_box">
    <form>
      <div class="row">
        <div class="col-sm-12 hidden-xs">
          <div id="post_box_avatar_cell">
            <img src="./../src/img/Profilbild.jpg" class="img-rounded" id="post_box_avatar">
          </div>
          <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
          <textarea class="form-control" name="post_textarea" id="postbox_textarea"></textarea><br />
        </div>
        <div class="hidden-lg hidden-md hidden-sm col-xs-12">
          <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues <?php if(isset($_SESSION["username"]) || isCookieValid($db)) echo $_SESSION["username"]; ?>?</h4></span>
          <textarea class="form-control" name="post_textarea" id="postbox_textarea_mobile"></textarea><br />
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="hidden-xs" id="select_post_content_and_post_button">
            <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
          </div>
          <div class="hidden-lg hidden-md hidden-sm" id="select_post_content_and_post_button_mobile">
            <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
            <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Wenn der Benutzer nicht eingeloggt ist, wird anstatt der Postbox eine Begrüßungsbox angezeigt. -->
  <?php else: ?>
    <div class="container-fluid" id="post_box">
      <form>
        <div class="row">
          <div class="col-sm-12">
            <h3>Willkommen beim DIVISION Network!</h3>
            <p>Werde jetzt Mitglied und poste deine neusten Videos in der Chronik oder chatte mit anderen Mitgliedern!</p>
          </div>
        </div>
      </form>
    </div>
<?php endif ?>
