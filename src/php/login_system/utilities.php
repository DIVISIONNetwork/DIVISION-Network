<?php
/**
 * @check_empty_fields(): eine Funktion, die anhand eines Arrays mit allen Pflichpfeldern
 * ($required_fields_array) prüft, ob alle Pflichfelder ausgefüllt wurden und, wenn
 * dies nicht so ist, das nicht ausgefüllte Pflichfeld zusammen mit einer Fehlermeldung
 * in einem Array ($form_errors) speichert und dieses Array zurückgibt, wenn alle Felder
 * überprüft wurden.
 *
 * @!isset(): überprüft, ob $_POST[$name_of_field] nicht gesetzt wurde oder
 * $_POST[$name_of_field] gleich NULL ist und speichert, wenn dies der Fall sein sollte,
 * das nicht ausgefüllte Pflichfeld zusammen mit einer Fehlermeldung
 * in einem Array ($form_errors)
 *
 * @$form_errors: ein Array, in das alle nicht ausgefüllten Pflichfelder zusammen mit einer Fehlermeldung
 * gespeichert werden.
 * @$required_fields_array: ein Array, welches eine Liste der Pflichpfelder enthält.
 * @$name_of_field: eine Variable in der der Wert von $required_fields_array (also
 * immer der Name eines Pflichfelds) bei jedem Durchlauf der foreach-Schleife gespeichert werden.
 * @$_POST: ein assoziatives Array, welches als Key die Namen der Formularfelder (u.a.) hat und zu
 * jedem dieser Formularfelder den eingetragenen Wert speichert oder übermittelt, dass
 * der Wert für das Feld nicht gesetzt wurde (also das Feld nicht ausgefüllt wurde).
 *
 * @return: gibt ein Array mit allen nicht ausgefüllten Pflichpfeldern zurück.
 */
function check_empty_fields ($required_fields_array) {

  // Initialisierung eines Arrays in dem nicht ausgefüllte Pflichfelder mit einer Fehlermeldung
  // gespeichert werden gespeichert werden.
  $form_errors = array();

  // Loop durch das $required_fields_array-Array
  foreach ($required_fields_array AS $name_of_field) {

    // Wenn das Feld nicht ausgefüllt wurde oder der Wert des Feldes NULL ist,
    if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {

      // wird das Feldzusammen mit einer Fehlermeldung ins $form_errors-Array gespeichert.
      $form_errors[] = $name_of_field . " ist ein Pflichtfeld";
    }

  }
  // Gibt das $form_errors-Array mit allen darin gespeicherten Fehlern zurück.
  return $form_errors;
}



/**
 * @check_min_length(): eine Funktion, die anhand eines assoziativen Arrays mit den Namen aller
 * Pflichfelder als Key und der Mindestanzahl an eingegebenen Buchstaben als Value überprüft, ob
 * der Benutzer genug Buchstaben in die entsprechenden Felder eingetragen hat.
 *
 * @strlen(): gibt die länge der im jeweiligen Feld eingetragenen Zeichenkette zurück.
 * @trim(): entfernt Whitespaces am Anfang und Ende des eingegebenen Strings.
 *
 * @$fields_to_check_length: ein assoziatives Array, das die Namen aller Felder enthält
 * und die dazugehörige Mindestlänge z.B. array = ("username" => 2, "email" => 12).
 * @$form_errors: ein Array, in das alle Felder, in die nicht die Mindestanzahl an Buchstaben eingegeben wurde,
 * zusammen mit einer Fehlermeldung gespeichert werden.
 * @$name_of_field: eine Variable in der der Wert von $required_fields_array (also
 * immer der Name eines Feldes mit Mindestanzahl an Zeichen) bei jedem Durchlauf der foreach-Schleife
 * gespeichert wird.
 * @$minimum_length_required: die Mindestanzahl an Zeichen, die in das jeweilige Feld eingetragen werden müssen.
 * @$_POST: ein assoziatives Array, welches als Key die Namen der Formularfelder (u.a.) hat und zu
 * jedem dieser Formularfelder den eingetragenen Wert als Value speichert oder übermittelt, dass
 * der Wert für das Feld nicht gesetzt wurde (also das Feld nicht ausgefüllt wurde).
 *
 * @return: gibt ein Array mit allen Fehlern aus.
 */
function check_min_length ($fields_to_check_length) {

  // Initialisierung eines Arrays in dem alle Felder, deren eingegebene Zeichenkette nicht lang genug ist,
  // zusammen mit einer Fehlermeldung gespeichert werden.
  $form_errors = array();

  // Loop durch das $fields_to_check_length-Array
  foreach ($fields_to_check_length AS $name_of_field => $minimum_length_required) {

    // Wenn vom Benutzer weniger Zeichen in ein Feld mit Mindestanzahl an Zeichen eingetragen wurden als nötig, wird der
    // Name des Feldes zusammen mit einer Fehlermeldung in das $form_errors-Array gespeichert.
    if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {

      // wird der Name des Feldes zusammen mit einer Fehlermeldung in das $form_errors-Array gespeichert.
      $form_errors[] = $name_of_field . " muss mindestens aus {$minimum_length_required} Zeichen bestehen.";
    }

  }
  // Gibt das $form_errors-Array mit allen darin gespeicherten Fehlern zurück.
  return $form_errors;
}



/**
 * @check_email():
 *
 * @array_key_exists(): überprüft, ob ein bestimmter Key (hier: "E-Mail") in einem Array existiert.
 * @filter_var(): Filter einer Variablen (hier: $key) mit einem angegebenen Filter
 * @FILTER_SANITIZE_EMAIL: Filter um E-Mail-Adressen zu bereinigen. Entfernt alle Zeichen außer
 * Buchstaben, Zahlen und !#$%&'*+-/=?^_`{|}~@.[].
 * @FILTER_VALIDATE_EMAIL: Prüft, ob es sich um eine gülitige E-Mail-Adresse handelt.
 *
 * @$form_errors: ein Array, in das wenn eine ungültige E-Mail-Adresse eingegeben wurde, die
 * angegebene E-Mail und eine Fehlermeldung gespeichert wird.
 * @$key: eine Variable, die den Key definiert, welches Feld im Formular überprüft werden soll (hier: "E-Mail").
 * @$_POST: ein assoziatives Array, welches als Key die Namen der Formularfelder (u.a.) hat und zu
 * jedem dieser Formularfelder den eingetragenen Wert als Value speichert oder übermittelt, dass
 * der Wert für das Feld nicht gesetzt wurde (also das Feld nicht ausgefüllt wurde).
 *
 * @return: gibt ein Array mit dem E-Mail-Error aus.
 */
 function check_email () {

   // Initialisierung eines Arrays in das bei einer nicht gültigen E-Mail-Adresse die E-Mail-Adresse und eine
   // Fehlermeldung gespeichert werden.
   $form_errors = array();
   // $key wird als "E-Mail" definiert.
   $key = "E-Mail";

   // Wenn der Key ($key) im Array ($data) existiert,
   if (array_key_exists($key, $_POST)) {

     // und wenn für $_POST[$key] ein Wert existiert,
     if ($_POST[$key] != NULL) {

       // wird $key auf die bereinigte E-Mail-Adresse gesetzt.
       $email = filter_var($_POST[$key], FILTER_SANITIZE_EMAIL);

       // und wenn es sich um keine gültige E-Mail-Adresse handelt,
       if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

         // wird die E-Mail-Adresse zusammen mit einer Fehlermeldung ins $form_errors-Array gespeichert.
         $form_errors[] = $email . " ist keine gültige E-Mail Adresse.";
       }

     }

   }
   // Gibt das $form_errors-Array mit allen darin gespeicherten Fehlern zurück.
   return $form_errors;
 }



/**
 * @show_errors(): eine Funktion, die alle gefundenen Fehlermeldungen in einer Liste ausgibt
 * und diese Liste zurückgibt.
 *
 * @$form_errors_array: ein Array, welches alle Fehler enthält.
 * @$errors: eine Variable, in der die Fehlermeldungen gespeichert werden.
 * @$the_error: eine Variable, in der bei jedem Schleifen-Durchlauf eine Fehlermeldung
 * gespeichert wird.
 *
 * @return: gibt eine Liste aller Fehlermeldungen zurück.
 */
 function show_errors ($form_errors_array) {

   // In der Variablen $errors wird das öffnende <ul>-Tag gespeichert.
   $errors = "<ul>";

   // Das $form_errors_array-Array wird in einer foreach-Schleife durchlaufen.
   foreach ($form_errors_array AS $the_error) {

     // An den in $errors gespeicherten String wird ein Listen-Element mit der nächsten
     // Fehlermeldung angehangen.
     $errors .= "<li>{$the_error}</li>";
   }

   // Die in $errors gespeicherte Liste wird mit dem </ul>-Tag geschlossen.
   $errors .= "</ul>";
   // Die gesamte Fehler-Liste wird zurückgegeben.
   return $errors;
 }



/**
 * @flashMessage(): Eine Funktion, die einen String mit der auszugebenden Nachricht und den Indikator $passOrFail
 * (für Erfolgsnachricht "Pass", für Fehlermeldung nichts [weil "Fail" Default-Value ist]) übergeben bekommt die
 * und anhand dieses Strings eine Fehler- bzw. Erfolgsnachrichten erzeugt und zurückgibt.
 *
 * @$message: Die auszugebende Fehler-/Erfolgsnachricht.
 * @$passOrFail: gibt an, ob es sich um eine Fehler- oder Erfolgsnachricht handelt. "Fail" ist dabei das Default-Value.
 * @$alert: eine Variable, in der die Erfolgs- bzw. Fehlernachrichten gespeichert werden.
 *
 * @return: gibt die Fehler- bzw. Erfolgsnachricht zurück.
 */
function flashMessage ($message, $passOrFail = "Fail") {

  // Wenn $passOrFail auf "Pass" steht,
  if ($passOrFail === "Pass") {

    // wird eine Erfolgsmeldung ausgegeben.
    $alert = "<div class='alert alert-success' role='alert' id='login_system_alertbox'>{$message}";

    // Wenn $passOrFail auf "Fail" steht,
  } else {

    // wird eine Fehlermeldung ausgegeben.
    $alert = "<div class='alert alert-danger' role='alert' id='login_system_alertbox'>{$message}";
  }

  // Die Erfolgs- bzw. Fehlermeldung wird zurückgegeben.
  return $alert;
}



/**
 * @redirectTo(): eine Funktion, die einen Redirect vornimmt.
 *
 * @header(): Sendet einen HTTP-Header in Rohform.
 *
 * @$page: die Seite zu der redirected werden soll.
 */
function redirectTo($page) {

  // Redirected den Benutzer zu der in $page definierten Seite.
  header("Location: {$page}.php");
}



/**
 * @checkDuplicateEntries(): eine Funktion die anhand der vier Parameter
 * $table, $column_name, $value und $db die Eingaben aus dem  Registrierungsformular
 * mit der Datenbank abgleicht, prüft, ob es Dopplungen gibt und ggf. eine
 * Fehlermeldung zurückgibt.
 *
 * @$db->prepare():
 * @$statement->execute():
 * @$statement->fetch():
 *
 * @$table: der Name des Datenbank-Tables, der überprüft werden soll.
 * @$column_name: der Name der Table-Spalte, die überprüft werden soll.
 * @$value: der Name des Formular-Feldes, das überprüft werden soll.
 * @$db: das Datenbank-Objekt.
 * @$sqlQuery: eine Variable in der das SQL-Statement erzeugt wird.
 * @$statement: eine Variable, in der das SQL-Statement vorbereitet wird.
 * @$row: eine Variable in der das Ergebnis von $statement->fetch() gespeichert wird.
 * @$result: eine Variable in der eine Fehlermeldung, die mit der flashMessage()-Funktion
 * erzeugt wurde, gespeichert wird.
 *
 * @return: wird kein doppelter Datenbank-Eintrag gefunden, wird false zurückgegeben. Wird
 * ein doppelter Datenbank-Eintrag gefunden, wird true zurückgegeben.
 */
function checkDuplicateEntries ($table, $column_name, $value, $db) {

  try {

    // Eine Variable in der das SQL-Statement zusammengesetzt wird.
    $sqlQuery = "SELECT * FROM " .$table. " WHERE " .$column_name. " =:$column_name";
    // Eine Variable in der ein Statement zur Ausführung vorbereitet und das Statement-Objekt gespeichert wird.
    $statement = $db->prepare($sqlQuery);
    // Das Statement wird ausgeführt.
    $statement->execute(array(":$column_name" => $value));

    // Wenn $statement->fetch() einen Rückgabewert liefert,
    if ($row = $statement->fetch()) {

      // wird kein doppelter Datenbank-Eintrag gefunden, wird false zurückgegeben.
      return true;
    }

    // wird ein doppelter Datenbank-Eintrag gefunden, wird true zurückgegeben.
    return false;

    // Jegliche PDOException werden abgefangen.
  } catch (PDOException $ex) {

    // In der Variablen $result wird im Falle von PDOExceptions mit Hilfe der
    // flashMessage()-Funktion eine Fehlermeldung gespeichert.
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
