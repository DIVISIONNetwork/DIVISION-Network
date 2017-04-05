<?php
/**
 * @check_empty_fields():
 *
 * @isset():
 *
 * @$form_errors: ein Array, in das alle nicht ausgefüllten Pflichfelder gespeichert werden.
 * @$required_fields_array: ein Array, welches eine Liste der Pflichpfelder enthält.
 * @$name_of_field:
 * @$_POST:
 *
 * @return: gibt ein Array mit allen nicht ausgefüllten Pflichpfeldern zurück.
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
 * @check_min_length():
 *
 * @strlen():
 * @trim():
 *
 * @$fields_to_check_length: ein assoziatives Array, das die Namen aller Felder enthält
 * und die dazugehörige Mindestlänge z.B. array = ("username" => 2, "email" => 12).
 * @$form_errors:
 * @$name_of_field:
 * @$minimum_length_required:
 * @$_POST:
 *
 * @return: gibt ein Array mit allen Fehlern aus.
 */
function check_min_length ($fields_to_check_length) {

  $form_errors = array();

  foreach ($fields_to_check_length AS $name_of_field => $minimum_length_required) {

    if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
      $form_errors[] = $name_of_field . " muss mindestens aus {$minimum_length_required} Zeichen bestehen.";
    }
    
  }

  return $form_errors;
}



/**
 * @check_email():
 *
 * @array_key_exists():
 * @filter_var():
 *
 * @$data: enthält ein assoziatives Array in dem Key der Name des zu prüfenden
 * Form-Elements (hier "email") und Value die vom Nutzer eingegebene Zeichenfolge ist.
 * @$form_errors:
 * @$key:
 * @$_POST:
 *
 * @return: gibt ein Array mit dem E-Mail-Error aus.
 */
function check_email ($data) {

  $form_errors = array();
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
 * @show_errors(): eine Funktion, die alle Fehlermeldungen ausgibt.
 *
 * @$form_errors_array: ein Array, welches alle Fehler enthält.
 * @$errors: eine Variable, in der die Fehlermeldungen gespeichert werden.
 * @$the_error:
 *
 * @return: gibt einen String (HTML-Markup) aus, der eine Liste mit allen
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
 * @flashMessage(): Eine Funktion, die Fehler- bzw. Erfolgsnachrichten ausgibt.
 *
 * @$message: Die auszugebende Fehler-/Erfolgsnachricht.
 * @$passOrFail: gibt an, ob es sich um eine Fehler- oder Erfolgsnachricht handelt. "Fail" ist dabei das Default-Value.
 * @$data: eine Variable, in der die Erfolgs- bzw. Fehlernachrichten gespeichert werden.
 *
 * @return: gibt die Fehler- bzw. Erfolgsnachricht zurück.
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
 * @redirectTo(): eine Funktion, die einen Redirect vornimmt.
 *
 * @header():
 *
 * @$page: die Seite zu der redirected werden soll.
 */
function redirectTo($page) {

  header("Location: {$page}.php");
}



/**
 * @checkDuplicateEntries(): eine Funktion die anhand der vier Parameter
 * $table, $column_name, $value und $db das Registrierungsformular auf doppelte
 * Einträge überprüft.
 *
 * @$db->prepare():
 * @$statement->execute():
 * @$statement->fetch():
 *
 * @$table: der Name des Datenbank-Tables, der überprüft werden soll.
 * @$column_name: der Name der Table-Spalte, die überprüft werden soll.
 * @$value: der Names des Formular-Feldes, das überprüft werden soll.
 * @$db: das Datenbank-Objekt.
 * @$sqlQuery: eine Variable in der das SQL-Statement erzeugt wird.
 * @$statement: eine Variable, in der das SQL-Statement vorbereitet wird.
 * @$row:
 * @$result:
 *
 * @return:
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



/**
 * @rememberMe():
 *
 * @base64_encode():
 * @setCookie():
 * @time():
 *
 * @$user_id:
 * @$encryptCookieData:
 */
function rememberMe ($user_id) {

  $encryptCookieData = base64_encode("Uh5R5tfzU3JüU1qHf9tFSTQR{$user_id}");
  // Cookie an der Stelle rememberUserCookie auf $encryptCookieData gesetzt und läuft in 30 Tagen ab.
  setCookie("rememberUserCookie", $encryptCookieData, time()+60*60*24*100, "/");
}



/**
 * @isCookieValid():
 *
 * @base64_decode():
 * @explode():
 * @$db->prepare():
 * @execute():
 * @fetch():
 * @signout():
 *
 * @$db:
 * @$isValid:
 * @$decryptCookieData:
 * @$user_id:
 * @$userID:
 * @$sqlQuery:
 * @$statement:
 * @$row:
 * @$id:
 * @$username:
 * @$_COOKIE:
 * @$_SESSION:
 *
 * @return:
 */
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



/**
 * @signout():
 *
 * @unset():
 * @setCookie():
 * @session_destroy():
 * @session_regenerate_id():
 * @redirectTo():
 *
 * @$_COOKIE:
 * @$_SESSION:
 */
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
