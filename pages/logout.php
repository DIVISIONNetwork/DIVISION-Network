<?php include ("./../src/php/login_system/session.php");
include("./../src/php/login_system/utilities.php");

session_destroy();
redirectTo("index");
