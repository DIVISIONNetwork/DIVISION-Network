<?php
include_once("./../src/php/login_system/database_connection.php");
include_once("./../src/php/login_system/utilities.php");

// Wenn $_SESSION["id"] gesetzt ist (der Benutzer eingeloggt ist),
if (isset($_SESSION["id"])) {

  // wird $id auf $_SESSION["id"] gesetzt,
  $id = $_SESSION["id"];
  // ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt,
  $sqlQuery = "SELECT * FROM users WHERE id = :id";
  // das SQL-Statement vorbereitet und
  $statement = $db->prepare($sqlQuery);
  // das SQL-Statement ausgeführt.
  $statement->execute(array("id" => $id));

  // Wenn außerdem $statement->fetch() einen Rückgabewert liefert, wird dieser in $row gespeichert und
  if ($row = $statement->fetch()) {

    // $username auf $row["username"] gesetzt,
    $username = $row["username"];
    // $email auf $row["email"] gesetzt und
    $email = $row["email"];
    // das Beitrittsdatum auf $row["join_date"] gesetzt (die Funktionen dienen dazu aus time() ein Datum zu machen).
    $join_date = strftime("%d. %B %Y", strtotime($row["join_date"]));
  }
  // Dann wird die User-ID enkodiert (verschlüsselt).
  $encode_id = base64_encode("o9Öhs4Iqd1Üje8Ahf9g{$id}");
}

 ?>
