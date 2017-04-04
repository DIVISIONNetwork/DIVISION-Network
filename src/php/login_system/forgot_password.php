<?php

if (isset($_POST["password_reset_button"])) {

  // Initialisiert ein Array in dem alle Fehlermeldungen gespeichert werden.
  $form_errors = array();

  // Definiert alle Pflichfelder, die zu überprüfen sind.
  $required_fields = array("E-Mail", "Neues_Passwort", "Neues_Passwort_bestätigen");

  // Ruft die Funktion check_empty_fields() auf und merged die Rückgabewerte in das $form_errors Array.
  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  // Ein assoziatives Array mit allen Pflichtfeldern mit einer minimalen Zeichenanzahl.
  $fields_to_check_length = array ("Neues_Passwort" => 8, "Neues_Passwort_bestätigen" => 8);

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
      $email = $_POST["E-Mail"];
      $password1 = $_POST["Neues_Passwort"];
      $password2 = $_POST["Neues_Passwort_bestätigen"];

      // Überprüft, ob die eingegebenen Passwörter übereinstimmen.
      if ($password1 != $password2) {
        $result = "<p>Die eingegebenen Passwörter stimmen nicht überein.</p>";
      } else {
        try {
          // Definiert das SQL-Insert Statement in der Variablen $sqlQuery.
          $sqlQuery = "SELECT email FROM users WHERE email =:email";

          /**
           * Bereitet aus dem in $sqlInsert gespeicherten
           * SQL-Statement ein SQL-Statement-Objekt vor und speichert dieses
           * (wenn erfolgreich) in der Variablen $statement (wenn nicht erfolreich
           * wird false zurückgegeben).
           *
           * @method prepare(): Bereitet ein Statement zur ausführung vor und gibt ein
           * Statement-Objekt zurück.
           */
           $statement = $db->prepare($sqlQuery);

          // Führt das vorbereitete SQL-Statement aus.
           $statement->execute(array("email" => $email));

          // Überprüft, ob Eintrag bereits existiert.
          if ($statement->rowCount() == 1) {

            // Verschlüselung des Passworts mit der Funktion password_hash().
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Definiert das SQL-Insert Statement in der Variablen $sqlQuery.
            $sqlUpdate = "UPDATE users SET password =:password WHERE email =:email";

           /**
            * Bereitet aus dem in $sqlInsert gespeicherten
            * SQL-Statement ein SQL-Statement-Objekt vor und speichert dieses
            * (wenn erfolgreich) in der Variablen $statement (wenn nicht erfolreich
            * wird false zurückgegeben).
            *
            * @method prepare(): Bereitet ein Statement zur ausführung vor und gibt ein
            * Statement-Objekt zurück.
            */
            $statement = $db->prepare($sqlUpdate);

            // Führt das vorbereitete SQL-Statement aus.
            $statement->execute(array(":password" => $hashed_password, ":email" => $email));

            // Gibt "Passwort wurde geändert" aus, wenn das Passwort erfolgreich geändert wurde.
            $result = "<p>Passwort wurde geändert.</p>";
          } else {
            // Gibt "Die von dir eingegebene E-Mail Adresse existiert nicht." aus, wenn keine übereinstimmende E-Mail Adresse gefunden wurde.
            $result = "<p>Die von dir eingegebene E-Mail Adresse existiert nicht.</p>";
          }
        } catch (PDOException $ex) {
          $result = '<p>Passwort ändern fehlgeschlagen:' . $ex->getMessage() . '</p>';
        }
      }
    } else {
      if (count($form_errors) == 1) {
        $result = "<p>Eine deiner Angaben ist nicht korrekt:<br />";
      } else {
        $result = "<p>" . count($form_errors) . " deiner Angaben sind nicht korrekt:";
        }
    }
}

 ?>
