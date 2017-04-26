<?php

// Es wird ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt.
$get_posts_query = "SELECT * FROM posts";

$get_posts_statement = $db->prepare($get_posts_query);

$get_posts_statement->execute();

foreach ($get_posts_statement AS $single_post) {

  $user_id = $single_post["user_id"];
  $post_type = $single_post["post_type"];
  $text = $single_post["text"];
  $posted_at = $single_post["posted_at"];

  // Es wird ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt.
  $get_user_query = "SELECT * FROM users WHERE id = :user_id LIMIT 1";

  $get_user_statement = $db->prepare($get_user_query);

  $get_user_statement->execute(array(":user_id" => $user_id));

  if ($user = $get_user_statement->fetch()) {

    $username = $user["username"];

    $user_avatar = "./../avatar_uploads/{$username}.jpg";

    $default_avatar = "./../avatar_uploads/default_avatar.jpg";

    if (file_exists($user_avatar)) {

      $avatar = $user_avatar;

    } else {

      $avatar = $default_avatar;

    }

  }

  if ($post_type === "text") {

    $post = '<div class="container-fluid post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="post_avatar_cell">
                    <img src="'.$avatar.'" class="img-rounded post_user_avatar">
                  </div>
                  <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle btn-xs post_options_btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post_options_symbol" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu post_options_dropdown">
                      <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</a></li>
                      <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
                    </ul>
                  </div>
                  <h4 class="posted_by_username">'.$username.'</h4>
                  <h5 class="posted_at_text">'.$posted_at.'</h5><br />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 post_text">'.$text.'</div>
              </div>
              <div class="row post_interaction_row">
                <button type="button" class="btn btn-default btn-sm comment_btn">Kommentieren (3)</button>
                <button type="button" class="btn btn-default btn-sm like_button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
                <button type="button" class="btn btn-default btn-sm dislike_button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
              </div>
            </div>';

    echo $post;

  } elseif ($post_type === "video") {

    $youtube_link = $single_post["youtube_link"];

    $post = '<div class="container-fluid post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="post_avatar_cell">
                    <img src="'.$avatar.'" class="img-rounded post_user_avatar">
                  </div>
                  <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle btn-xs post_options_btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post_options_symbol" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu post_options_dropdown">
                      <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</a></li>
                      <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
                    </ul>
                  </div>
                  <h4 class="posted_by_username">'.$username.'</h4>
                  <h5 class="posted_at_text">'.$posted_at.'</h5><br />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 post_text">'.$text.'</div>
              </div>
              <div class="video_container_container">
                <div class="video_container">
                  <iframe frameBorder="0" src="'.$youtube_link.'" allowfullscreen></iframe>
                </div>
              </div>
              <div class="row post_interaction_row">
                <button type="button" class="btn btn-default btn-sm comment_btn">Kommentieren (3)</button>
                <button type="button" class="btn btn-default btn-sm like_button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
                <button type="button" class="btn btn-default btn-sm dislike_button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
              </div>
            </div>';

    echo $post;

  } elseif ($post_type === "link") {

    $link = $single_post["link"];

    $post = '<div class="container-fluid post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="post_avatar_cell">
                    <img src="'.$avatar.'" class="img-rounded post_user_avatar">
                  </div>
                  <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle btn-xs post_options_btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post_options_symbol" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu post_options_dropdown">
                      <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</a></li>
                      <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
                    </ul>
                  </div>
                  <h4 class="posted_by_username">'.$username.'</h4>
                  <h5 class="posted_at_text">'.$posted_at.'</h5><br />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 post_text">'.$text.'</div>
              </div>
                <a class="btn btn-default comment_btn" href="'.$link.'" target="_blank"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i>'." ".$link.'</a>
              <div class="row post_interaction_row">
                <button type="button" class="btn btn-default btn-sm comment_btn">Kommentieren (3)</button>
                <button type="button" class="btn btn-default btn-sm like_button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
                <button type="button" class="btn btn-default btn-sm dislike_button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
              </div>
            </div>';

    echo $post;

  } else {

    $image_name = $single_post["image_directory"];

    $image_directory_path = "./../image_uploads/{$image_name}.jpg";

    $post = '<div class="container-fluid post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="post_avatar_cell">
                    <img src="'.$avatar.'" class="img-rounded post_user_avatar">
                  </div>
                  <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle btn-xs post_options_btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post_options_symbol" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu post_options_dropdown">
                      <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</a></li>
                      <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
                    </ul>
                  </div>
                  <h4 class="posted_by_username">'.$username.'</h4>
                  <h5 class="posted_at_text">'.$posted_at.'</h5><br />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 post_text">'.$text.'</div>
              </div>
                <img src="'.$image_directory_path.'">
              <div class="row post_interaction_row">
                <button type="button" class="btn btn-default btn-sm comment_btn">Kommentieren (3)</button>
                <button type="button" class="btn btn-default btn-sm like_button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> (15)</button>
                <button type="button" class="btn btn-default btn-sm dislike_button"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i> (2)</button>
              </div>
            </div>';

    echo $post;

  }

}
