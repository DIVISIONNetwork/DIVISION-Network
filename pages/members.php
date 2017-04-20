<?php
$page_title = "Mitglieder - DIVISION Network";
include_once("./../src/assets/head.php");
include_once("./../src/assets/header.php");
?>

<div class="container-fluid" id="content">
    <?php include_once("./../src/assets/left_sidebar.php"); ?>
    <div class="col-md-6 col-sm-8 col-xs-12" id="chronik">
    <div class="container-fluid member_container">
      <div class="row">
        <div class="col-sm-12">
          <div class="member_avatar_cell">
            <img src="<?php if (isset($profile_picture)) { echo $profile_picture; } elseif (file_exists("./../avatar_uploads/{$_SESSION['username']}.jpg")) { echo "./../avatar_uploads/{$_SESSION['username']}.jpg"; } ?>" class="img-rounded post_user_avatar">
          </div>
          <div class="dropdown pull-right">
            <button class="btn btn-default dropdown-toggle btn-xs post_options_btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h fa-lg post_options_symbol" aria-hidden="true"></i></button>
            <ul class="dropdown-menu post_options_dropdown">
              <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Post löschen</a></li>
              <li><a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Post melden</a></li>
            </ul>
          </div>
          <h4 class="member_username">RUBEN</h4>
          <h5 class="member_youtube_link">https://www.youtube.com/channel/UCZlbWLH_1VBAHY4afIVaFJw</h5><br />
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="member_profile_data_container">
            <table class="member_profile_data_table">
              <tr><th>Videokategorie:</th><td>RUBEN</td></tr>
              <tr><th>Abonnenten:</th><td><?php if (isset($email)) {echo $email;} ?></td></tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="col-lg-2 col-md-4 col-sm-4 hidden-xs" id="right_sidebar_col">
      <?php include_once("./../src/assets/widgets/social_nav_widget/social_nav_widget.php"); ?>
    </div>
    <?php include_once("./../src/assets/widgets/chat_widget/chat_widget.php"); ?>
</div>
<?php include_once("./../src/assets/footer.php"); ?>
