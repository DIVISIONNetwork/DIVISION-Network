<?php
include ("./session.php");

session_destroy();
$URL="http://localhost/DIVISION-Network/DIVISION-Network/pages/";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

 ?>
