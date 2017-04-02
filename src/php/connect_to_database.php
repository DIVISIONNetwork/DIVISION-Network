<?php

/* Definition der nötigen Parameter zur Datenbankverbindung */
$dsn = "mysql:host=localhost;dbname=division network;charset=utf8";
$username = "ruben";
$password = "SFh2ze6ynMm7sp9a";

try {

  /* Mit der Datenbank mit dem Benutzer "ruben" verbinden und das generierte Passwort verwenden */
  $db = new PDO($dsn, $username, $password);

  /*Seltene Fälle von SQL-Injection werden mit "charset=utf8" (oberhalb) und dem
  "setAttribute"-Befehl (unterhalb) umgangen.*/
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  /* Nachricht bei erfolgreicher Verbindung zur Database */
  // echo "<br /><br />Verbindung mit DIVISION Network Database erfolgreich!";

} catch (PDOException $ex) {

    /* Nachricht bei fehlgeschlagener Verbindung zur Database */
    echo "<br /><br />Verbindung mit DIVISION Network Database fehlgeschlagen!<br />Fehler: " . $ex->getMessage();
}

?>
