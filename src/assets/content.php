<div class="container-fluid" id="content">
    <?php include("./../src/assets/left_sidebar.php"); ?>
    <?php include("./../src/assets/chronik.php"); ?>
    <?php include("./../src/assets/right_sidebar.php"); ?>
    <?php include("./../src/assets/chat_sidebar.php"); ?>

  <div class="popup-box chat-popup" id="'+ id +'">
    <div class="popup-head">
      <div class="popup-head-left">
      </div>
      <div class="popup-head-right">
        <a href="javascript:close_popup(\''+ id +'\');">&#10005;</a>
      </div>
      <div style="clear: both">
      </div>
    </div>
    <div class="popup-messages">
      <div class="chat_container">
        <div class="chat_massage_container">
          <div class="chat_massage_a">
            Nachricht A
          </div>
        </div>
        <div class="chat_massage_container">
          <div class="chat_massage_b">
            Nachricht B
          </div>
        </div>
        <div class="form-group">
          <textarea class="form-control" rows="1" id="chat_input"></textarea>
        </div>
      </div>
    </div>
  </div>

</div>
