<?php

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



/**
 * @param $fields_to_check_length: ein assoziatives Array, das die Namen aller Felder enthält
 * und die dazugehörige Mindestlänge z.B. array = ("username" => 2, "email" => 12).
 * @return gibt ein Array mit allen Fehlern aus.
 */

function check_min_length ($fields_to_check_length) {

  $form_errors = array ();

  foreach ($fields_to_check_length AS $name_of_field => $minimum_length_required) {
    if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
      $form_errors[] = $name_of_field . " muss mindestens aus {$minimum_length_required} Zeichen bestehen.";
    }
  }
  return $form_errors;
}



/**
 * @param $data: enthält ein assoziatives Array in dem Key der Name des zu prüfenden
 * Form-Elements (hier "email") und Value die vom Nutzer eingegebene Zeichenfolge ist.
 * @return gibt ein Array mit dem E-Mail-Error aus.
 */

function check_email ($data) {

  $form_errors = array ();
  $key = "E-Mail";

  if (array_key_exists($key, $data)) {
    if ($_POST[$key] != NULL) {
      $key = filter_var($key, FILTER_SANITIZE_EMAIL);
      if (filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false) {
        $form_errors[] = $key . " ist keine gültige E-Mail Adresse.";
      }
    }
  }
  return $form_errors;
}


/**
 * @method show_errors(): eine Funktion, die alle Fehlermeldungen ausgibt.
 * @param $form_errors_array: ein Array, welches alle Fehler enthält.
 * @var $errors: eine Variable, in der die Fehlermeldungen gespeichert werden.
 * @return gibt einen String (HTML-Markup) aus, der eine Liste mit allen
 * Fehlermeldungen ausgibt.
 */
 function show_errors ($form_errors_array) {
   $errors = "<p><ul>";

   foreach ($form_errors_array AS $the_error) {
     $errors .= "<li>{$the_error}</li>";
   }
   $errors .= "</ul></p>";
   return $errors;
 }


/**
 * @method flashMessage(): Eine Funktion, die Fehler- bzw. Erfolgsnachrichten ausgibt.
 * @param $message: Die auszugebende Fehler-/Erfolgsnachricht.
 * @param $passOrFail: gibt an, ob es sich um eine Fehler- oder Erfolgsnachricht handelt. "Fail" ist dabei das Default-Value.
 * @var $data: eine Variable, in der die Erfolgs- bzw. Fehlernachrichten gespeichert werden.
 * @return gibt die Fehler- bzw. Erfolgsnachricht zurück.
 */
function flashMessage ($message, $passOrFail = "Fail") {

  // Wenn die Operation erfolgreich war, wird eine Erfolgsnachricht erzeugt
  if ($passOrFail === "Pass") {
    $data = "<div class='alert alert-success' role='alert' id='login_system_alertbox'>{$message}";
    // Wenn die Operation nicht erfolgreich war, wird eine Fehlernachricht erzeugt
  } else {
    $data = "<div class='alert alert-danger' role='alert' id='login_system_alertbox'>{$message}";
  }
  return $data;
}


/**
 * @method redirectTo(): eine Funktion, die einen Redirect vornimmt.
 * @param $page: die Seite zu der redirected werden soll.
 */
function redirectTo($page) {
  header("Location: {$page}.php");
}


/**
 * @method checkDuplicateEntries(): eine Funktion die anhand der vier Parameter
 * $table, $column_name, $value und $db das Registrierungsformular auf doppelte
 * Einträge überprüft.
 * @param $table: der Name des Datenbank-Tables, der überprüft werden soll.
 * @param $column_name: der Name der Table-Spalte, die überprüft werden soll.
 * @param $value: der Names des Formular-Feldes, das überprüft werden soll.
 * @param $db: das Datenbank-Objekt.
 * @var $sqlQuery: eine Variable in der das SQL-Statement erzeugt wird.
 * @var $statement: eine Variable, in der das SQL-Statement vorbereitet wird.
 */
function checkDuplicateEntries ($table, $column_name, $value, $db) {

  try {
    $sqlQuery = "SELECT * FROM " .$table. " WHERE " .$column_name. " =:$column_name";

    $statement = $db->prepare($sqlQuery);

    $statement->execute(array(":$column_name" => $value));

    if ($row = $statement->fetch()) {
      return true;
    }
    return false;
  } catch (PDOException $ex) {
    $result = flashMessage("Fehlgeschlagen: " . $ex->getMessage());
  }
}


function rememberMe ($user_id) {
  $encryptCookieData = base64_encode("Uh5R5tfzU3JüU1qHf9tFSTQR{$user_id}");
  // Cookie wird gesetzt und läuft in 30 Tagen ab
  setCookie("rememberUserCookie", $encryptCookieData, time()+60*60*24*100, "/");
}

function isCookieValid ($db) {
  $isValid = false;

  if (isset($_COOKIE["rememberUserCookie"])) {
    $decryptCookieData = base64_decode($_COOKIE["rememberUserCookie"]);
    $user_id = explode("Uh5R5tfzU3JüU1qHf9tFSTQR", $decryptCookieData);
    $userID = $user_id[1];

    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(":id" => $userID));

    if ($row = $statement->fetch()) {
      $id = $row["id"];
      $username = $row["username"];

      $_SESSION["id"] = $id;
      $_SESSION["username"] = $username;
      $isValid = true;
    } else {
      $isValid = false;
      signout();
    }
  }
  return $isValid;
}

function signout () {
  unset($_SESSION["username"]);
  unset($_SESSION["id"]);

  if(isset($_COOKIE["rememberUserCookie"])) {
    unset($_COOKIE["rememberUserCookie"]);
    setCookie("rememberUserCookie", NULL, -1, "/");
  }
  session_destroy();
  session_regenerate_id(true);
  redirectTo("index");
}


 ?>
