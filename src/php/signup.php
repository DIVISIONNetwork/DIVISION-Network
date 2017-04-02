<?php

include ("./../src/php/database_connection.php");
include ("./..//src/php/signup_utilities.php");

if(isset($_POST["signup_button"])) {

  // Initialisiert ein Array in dem alle Fehlermeldungen gespeichert werden
  $form_errors = array();

  // Definiert alle Pflichfelder, die zu überprüfen sind
  $required_fields = array("email", "username", "password");

  // Ruft die Funktion check_empty_fields() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  // Ein assoziatives Array mit allen Pflichtfeldern mit einer minimalen Zeichenanzahl.
  $fields_to_check_length = array ("username" => 2, "password" => 8);

  // Ruft die Funktion check_min_length() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

  // Ruft die Funktion check_email() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_email($_POST));

  //Wenn das $form_errors-Array leer ist, werden die Daten in die Database eingespeist.
  if (empty($form_errors)) {

    /**
     * Fragt ab, ob das Registrierungs-Formular abgeschickt wurde und speichert
     * dann die Variablen aus dem Array in einzelnen Variablen ab.
     */
      $email = $_POST["email"];
      $username = $_POST["username"];
      $password = $_POST["password"];

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
          $result = '<p style="color = green;">Registrierung erfolgreich!</p>';
        }

      /**
       * Fängt jegliche PDO-Exceptions ab und gibt "Registrierung fehlgeschlagen:"
       * mit der dazugehörigen Fehlermeldung aus.
       */
      } catch (PDOException $ex) {
        $result = '<p style="color = red;">Registrierung fehlgeschlagen:' . $ex->getMessage() . '</p>';
      }
    // Es wird eine Liste der vorliegenden Fehler (unausgefüllten Felder im Formular) ausgegeben.
    } else {
      if (count($form_errors) == 1) {
        $result = "<p>Eine deiner Angaben ist nicht korrekt:<br />";
      } else {
        $result = "<p>" . count($form_errors) . " deiner Angaben sind nicht korrekt:";
      }
    }
}





?>
