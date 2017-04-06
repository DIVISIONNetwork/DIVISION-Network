<?php

include_once ("./../src/php/login_system/database_connection.php");
include_once ("./../src/php/login_system/utilities.php");

if(isset($_POST["E-Mail"])) {

  // Initialisiert ein Array in dem alle Fehlermeldungen gespeichert werden.
  $form_errors = array();

  // Definiert alle Pflichfelder, die zu überprüfen sind.
  $required_fields = array("E-Mail", "Benutzername", "Passwort");

  // Ruft die Funktion check_empty_fields() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  // Ein assoziatives Array mit allen Pflichtfeldern mit einer minimalen Zeichenanzahl.
  $fields_to_check_length = array("Benutzername" => 2, "Passwort" => 8);

  // Ruft die Funktion check_min_length() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

  // Ruft die Funktion check_email() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_email());

  /**
   * Fragt ab, ob das Registrierungs-Formular abgeschickt wurde und speichert
   * dann die Variablen aus dem Array in einzelnen Variablen ab.
   */
    $email = $_POST["E-Mail"];
    $username = $_POST["Benutzername"];
    $password = $_POST["Passwort"];

    if (checkDuplicateEntries("users", "email", $email, $db)) {
      $result = flashMessage("Registrierung nicht möglich: E-Mail Adresse ist bereits vergeben, bitte verwende eine andere.");
      // Ist die E-Mail nicht schon in Verwendung, so wird geprüft, ob der Benutzername schon vergeben ist
    } elseif (checkDuplicateEntries("users", "username", $username, $db)) {
      $result = flashMessage("Registrierung nicht möglich: Benutzername ist bereits vergeben, bitte verwende einen anderen.");
      // Ist der Benutzername nicht schon vergeben, so wird geprüft, ob es sonst Fehler gibt
      } elseif (empty($form_errors)) {

      // Verschlüselung des Passworts mit der Funktion password_hash().
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      /**
       * Im try-Block wird versucht die Daten aus dem Registrierungs-Formular in die
       * Datenbank zu speichern. Schlägt dies fehl werden die Exceptions im
       * catch-Block abgefangen.
      */
      try {
        // Definiert das SQL-Insert Statement in der Variablen $sqlInsert.
        $sqlInsert = "INSERT INTO users (username, email, password, join_date) VALUES (:username, :email, :password, now())";

        /**
         * Bereitet aus dem in $sqlInsert gespeicherten
         * SQL-Statement ein SQL-Statement-Objekt vor und speichert dieses
         * (wenn erfolgreich) in der Variablen $statement (wenn nicht erfolreich
         * wird false zurückgegeben).
         *
         * @method prepare(): Bereitet ein Statement zur ausführung vor und gibt ein
         * Statement-Objekt zurück.
         */
         $statement = $db->prepare($sqlInsert);

         // Führt das vorbereitete SQL-Statement aus.
         $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

       /**
        * Wenn nur eine Zeile betroffen ist, wird "Registrierung erfolgreich!"
        * ausgegeben.
        *
        * @method rowCount(): gibt die Anzahl der vom letzten INSERT-, DELETE- oder
        * UPDATE-Statement betroffenen Datenbank-Zeilen zurück.
        */
        if ($statement->rowCount() == 1) {
          $result = flashMessage("Registrierung erfolgreich!", "Pass");
        }

      /**
       * Fängt jegliche PDO-Exceptions ab und gibt "Registrierung fehlgeschlagen:"
       * mit der dazugehörigen Fehlermeldung aus.
       */
      } catch (PDOException $ex) {
        $result = flashMessage("Registrierung fehlgeschlagen: " . $ex->getMessage());
      }
    // Es wird eine Liste der vorliegenden Fehler (unausgefüllten Felder im Formular) ausgegeben.
    } else {
      if (count($form_errors) == 1) {
        $result = flashMessage("Eine deiner Angaben ist nicht korrekt: ");
      } else {
        $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");
      }
    }
}

?>
