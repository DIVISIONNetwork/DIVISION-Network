<div class="container-fluid post">
  <div class="row">
    <div class="col-sm-12">
      <div class="post_avatar_cell">
        <img src="./../src/img/Profilbild.jpg" class="img-rounded post_user_avatar">
      </div>
      <div class="dropdown pull-right">
        <button class="btn btn-default dropdown-toggle btn-xs post_options_btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post_options_symbol" aria-hidden="true"></i></button>
        <ul class="dropdown-menu post_options_dropdown">
          <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</a></li>
          <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
        </ul>
      </div>
      <h4 class="posted_by_username">RUBEN</h4>
      <h5 class="posted_at_text">vor 5 Stunden</h5><br />
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 post_text">

      <p><?php var_dump ($_POST); ?></p>

      <p>Du bist aktuell nicht angemeldet. Bitte melde dich an!<br />Noch kein Mitglied? Registriere dich jetzt!</p>

      <p>Du bist angemeldet als {username} <a href="logout.php">Abmelden</a></p>
    </div>
  </div>
  <div class="row post_interaction_row">
    <button type="button" class="btn btn-default btn-sm comment_btn">Kommentieren (3)</button>
    <button type="button" class="btn btn-default btn-sm like_button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
    <button type="button" class="btn btn-default btn-sm dislike_button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
  </div>
</div>
