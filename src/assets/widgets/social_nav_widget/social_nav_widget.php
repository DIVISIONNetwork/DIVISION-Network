<?php if (!isset($_SESSION["username"])): ?>
  <?php else: ?>
    <div>
      <ul class="list-group" id="social_nav">
        <li class="list-group-item right_sidebar_nav_li"><span class="badge">3</span><a href="index.php" class="right_sidebar_nav_text">Nachrichten</a></li>
        <li class="list-group-item right_sidebar_nav_li"><span class="badge">5</span><a href="index.php" class="right_sidebar_nav_text">Benachrichtigungen</a></li>
        <li class="list-group-item right_sidebar_nav_li"><span class="badge">7</span><a href="index.php" class="right_sidebar_nav_text">Folge ich</a></li>
        <li class="list-group-item right_sidebar_nav_li"><span class="badge">2</span><a href="index.php" class="right_sidebar_nav_text">Gruppen</a></li>
      </ul>
    </div>
<?php endif ?>
