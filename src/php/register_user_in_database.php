<?php

// $required_fields = array("email", "username", "password");

/**
 * @param $required_fields_array: ein Array, welches eine Liste der Pflichpfelder enthält.
 * @param $form_errors: ein Array, in das alle nicht ausgefüllten Pflichfelder gespeichert werden.
 * @return gibt ein Array mit allen nicht ausgefüllten Pflichpfeldern zurück.
 */
function check_empty_fields ($required_fields_array) {

  // Initialisierung eines Arrays in dem eventuelle Fehler gespeichert werden.
  $form_errors = array();

  // Loop durch das $required_fields_array.
  foreach ($required_fields_array AS $name_of_field) {
    if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
      $form_errors[] = $name_of_field . " ist ein Pflichtfeld";
    }
  }
  return $form_errors;
}

  //Wenn das $form_errors-Array leer ist, werden die Daten in die Database eingespeist.
  if (empty($form_errors)) {

    /**
     * Fragt ab, ob das Registrierungs-Formular abgeschickt wurde und speichert
     * dann die Variablen aus dem Array in einzelnen Variablen ab.
     */
      $email = $_POST["register_email"];
      $username = $_POST["register_username"];
      $password = $_POST["register_password"];

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
          $success = '<p style="color = green;">Registrierung erfolgreich!</p>';
        }

        /**
         * Fängt jegliche PDO-Exceptions ab und gibt "Registrierung fehlgeschlagen:"
         * mit der dazugehörigen Fehlermeldung aus.
         */
      } catch (PDOException $ex) {
        $success = '<p style="color = red;">Registrierung fehlgeschlagen:' . $ex->getMessage() . '</p>';
      }
    // Es wird eine Liste der vorliegenden Fehler (unausgefüllten Felder im Formular) ausgegeben.
    } else {

      // Wenn nur ein Fehler vorliegt, wird dieser in einer Liste ausgegeben.
      if (count($form_errors) == 1) {
          $success = "<p>Es gibt einen Fehler im Registrierungs-Formular:<br /><ul>";
           foreach ($form_errors AS $error) {
             $success .= "<li>{$error}</li>";
           }
           $success .= "</ul></p>";
      // Liegen mehrere Fehler vor, werden diese in einer Liste ausgegeben.
      } else {
          $success = "<p>Es gibt " . count($form_errors) . " Fehler im Registrierungs-Formular:<br /><ul>";
          foreach ($form_errors AS $error) {
            $success .= "<li>{$error}</li>";
          }
          $success .= "</ul></p>";
        }
      }
}

?>
