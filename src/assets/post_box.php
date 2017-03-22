<script>
function change_postbox (a) {
  if (a == "video") {
    var video = `<form>
                  <div class="row">
                    <div class="col-sm-12 hidden-xs">
                      <div id="post_box_avatar_cell">
                        <img src="./../src/img/Profilbild.jpg" class="img-rounded" id="post_box_avatar">
                      </div>
                      <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues RUBEN?</h4></span>
                      <textarea class="form-control" name="post_youtube_link" id="postbox_link" placeholder="YouTube-Link"></textarea><br />
                      <textarea class="form-control" name="post_textarea" id="postbox_textarea" placeholder="Videobeschreibung"></textarea><br />
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                      <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues RUBEN?</h4></span>
                      <textarea class="form-control" name="post_youtube_link" id="postbox_link_mobile" placeholder="YouTube-Link"></textarea><br />
                      <textarea class="form-control" name="post_textarea" id="postbox_textarea_mobile" placeholder="Videobeschreibung"></textarea><br />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="hidden-xs" id="select_post_content_and_post_button">
                        <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                        <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                        <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
                        <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
                      </div>
                      <div class="hidden-lg hidden-md hidden-sm" id="select_post_content_and_post_button_mobile">
                        <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                        <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                        <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
                        <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
                      </div>
                    </div>
                  </div>
                </form>`;
    document.getElementById('post_box').innerHTML = video;
  } else if (a == "photo") {
    var photo = `  <form>
                    <div class="row">
                      <div class="col-sm-12 hidden-xs">
                        <div id="post_box_avatar_cell">
                          <img src="./../src/img/Profilbild.jpg" class="img-rounded" id="post_box_avatar">
                        </div>
                        <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues RUBEN?</h4></span>
                        <textarea class="form-control" name="post_link" id="postbox_link" placeholder="Foto-Link"></textarea><br />
                        <textarea class="form-control" name="post_textarea" id="postbox_textarea" placeholder="Fotobeschreibung"></textarea><br />
                      </div>
                      <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                        <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues RUBEN?</h4></span>
                        <textarea class="form-control" name="post_link" id="postbox_link_mobile" placeholder="Foto-Link"></textarea><br />
                        <textarea class="form-control" name="post_textarea" id="postbox_textarea_mobile" placeholder="Fotobeschreibung"></textarea><br />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="hidden-xs" id="select_post_content_and_post_button">
                          <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm" id="select_post_content_and_post_button_mobile">
                          <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_link_button" onclick="change_postbox('link');"><i class="fa fa-link fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
                        </div>
                      </div>
                    </div>
                  </form>`;
    document.getElementById('post_box').innerHTML = photo;
    } else if (a == "link") {
      var link = `<form>
                    <div class="row">
                      <div class="col-sm-12 hidden-xs">
                        <div id="post_box_avatar_cell">
                          <img src="./../src/img/Profilbild.jpg" class="img-rounded" id="post_box_avatar">
                        </div>
                        <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues RUBEN?</h4></span>
                        <textarea class="form-control" name="post_link" id="postbox_link" placeholder="Link"></textarea><br />
                        <textarea class="form-control" name="post_textarea" id="postbox_textarea" placeholder="Linkbeschreibung"></textarea><br />
                      </div>
                      <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                        <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues RUBEN?</h4></span>
                        <textarea class="form-control" name="post_link" id="postbox_link_mobile" placeholder="Foto-Link"></textarea><br />
                        <textarea class="form-control" name="post_textarea" id="postbox_textarea_mobile" placeholder="Fotobeschreibung"></textarea><br />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="hidden-xs" id="select_post_content_and_post_button">
                          <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm" id="select_post_content_and_post_button_mobile">
                          <button class="btn btn-default select_post_content_buttons" id="post_box_text_button" onclick="change_postbox('text');"><i class="fa fa-align-left fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_video_button" onclick="change_postbox('video');"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default select_post_content_buttons" id="post_box_photo_button" onclick="change_postbox('photo');"><i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i></button>
                          <button class="btn btn-default" id="post_box_posten_button" type="submit">Posten</button>
                        </div>
                      </div>
                    </div>
                  </form>`;
      document.getElementById('post_box').innerHTML = link;
    } else {
      var text = `<form>
                    <div class="row">
                      <div class="col-sm-12 hidden-xs">
                        <div id="post_box_avatar_cell">
                          <img src="./../src/img/Profilbild.jpg" class="img-rounded" id="post_box_avatar">
                        </div>
                        <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues RUBEN?</h4></span>
                        <textarea class="form-control" name="post_textarea" id="postbox_textarea"></textarea><br />
                      </div>
                      <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                        <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues RUBEN?</h4></span>
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
                  </form>`;
      document.getElementById('post_box').innerHTML = text;
      }
}
</script>
<div class="container-fluid" id="post_box">
  <form>
    <div class="row">
      <div class="col-sm-12 hidden-xs">
        <div id="post_box_avatar_cell">
          <img src="./../src/img/Profilbild.jpg" class="img-rounded" id="post_box_avatar">
        </div>
        <span id="whats_new_text_span"><h4 id="whats_new_text">Was gibt's Neues RUBEN?</h4></span>
        <textarea class="form-control" name="post_textarea" id="postbox_textarea"></textarea><br />
      </div>
      <div class="hidden-lg hidden-md hidden-sm col-xs-12">
        <span id="whats_new_text_span_mobile"><h4 id="whats_new_text_mobile">Was gibt's Neues RUBEN?</h4></span>
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
