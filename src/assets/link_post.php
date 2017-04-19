<div class="container-fluid post">
  <div class="row">
    <div class="col-sm-12">
      <div class="post_avatar_cell">
        <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded post_user_avatar">
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
      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
      At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor
      sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
      et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
    </div>
  </div>
    <a class="btn btn-default comment_btn" href="http://www.division-network.de/2017/02/01/gutes-thumbnail-design/"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i> http://www.division-network.de/2017/02/01/gutes-thumbnail-design/</a>
  <div class="row post_interaction_row">
    <button type="button" class="btn btn-default btn-sm comment_btn">Kommentieren (3)</button>
    <button type="button" class="btn btn-default btn-sm like_button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
    <button type="button" class="btn btn-default btn-sm dislike_button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
  </div>
</div>
