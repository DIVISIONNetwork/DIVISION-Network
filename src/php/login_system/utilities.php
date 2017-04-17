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
 * @$db->prepare(): Bereitet das in $sqlQuery gespeicherte Statement zur Ausführung vor und gibt ein
 * Statement-Objekt zurück.
 * @$statement->execute(): Führt dass durch $db->prepare() vorbereitete Statement aus.
 * @$statement->fetch(): ??????????????????????????????
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
 * @rememberMe(): eine Funktion, die die User ID übergeben bekommt und diese verschlüsselt - als Cookie
 * der nach 30 Tagen verfällt - speichert.
 *
 * @base64_encode(): PHP-Funktion, die die User ID MIME base64 codiert, damit die Benutzerdaten
 * verschlüsselt sind.
 * @setCookie(): PHP-Funktion, die einen Cookie setzt.
 * @time(): gibt den aktuellen Unix-Timestamp (Sekunden seit Beginn der Unix-Epoche
 * [Januar 1 1970 00:00:00 GMT]) zurück.
 *
 * @$user_id: Parameter, der der Funktion übergeben wird und dann in der Funktion verschlüsselt wird.
 * @$encryptCookieData: Variable, in der die verschlüsselte User ID gespeichert wird.
 */
function rememberMe ($user_id) {

  // Die User-ID wird verschlüsselt und in der Variablen $encryptCookieData gespeichert
  $encryptCookieData = base64_encode("Uh5R5tfzU3JüU1qHf9tFSTQR{$user_id}");
  // Cookie an der Stelle rememberUserCookie auf $encryptCookieData gesetzt und läuft in 30 Tagen ab.
  setCookie("rememberUserCookie", $encryptCookieData, time()+60*60*24*100, "/");
}



/**
 * @isCookieValid():
 *
 * @base64_decode(): PHP-Funktion, die die MIME base64 verschlüsselten Daten dekodiert.
 * @explode(): PHP-Funktion, die einen String in die angegebenen Teil zerlegt in ein Array speichert.
 * @$db->prepare(): PHP-Funktion, die das in $sqlQuery gespeicherte Statement zur Ausführung vorbuereitet und ein
 * Statement-Objekt zurückgibt.
 * @execute(): führt dass durch $db->prepare() vorbereitete Statement aus.
 * @fetch(): fetchet die nächste Row des angehängten Statements (hier: $statement).
 * @signout(): eine Funktion, die alle Benutzerdaten aus den Cookies und Sessions löscht und den Benutzer zur
 * Startseite weiterleitet.
 *
 * @$db: das Datenbank-Objekt.
 * @$isValid: eine Variable in der gespeichert wird, ob der Cookie gültig ("true") oder ungültig ("false") ist.
 * @$decryptCookieData: eine Variable, in der die durch base64_decode dekodierten Daten (hier: die User ID) gespeichert werden.
 * @$user_id: eine Variable in der das durch die explode()-Funktion erzeugte Array, welches die User ID enthält
 * gespeichert wird.
 * @$userID: eine Variable in der die unverschlüsselte User ID gespeichert wird.
 * @$sqlQuery: eine Variable in der das SQL-Statement erzeugt wird.
 * @$statement: eine Variable, in der das SQL-Statement vorbereitet wird.
 * @$row: die nächste Reihe, die durch fetch() geholt wurde.
 * @$id: eine Variable in der die User-ID aus der gefetchten Row gespeichert wird.
 * @$username: eine Variable in der der Benutzername aus der gefechten Row gespeichert wird.
 * @$_COOKIE: ein assoziatives Array von Variablen, die dem aktuellen Skript mittels HTTP-Cookies übergeben werden.
 * @$_SESSION: ein assoziatives Array, das die Sessionvariablen enthält und dem aktuellen Skript zur Verfügung stellt.
 *
 * @return:
 */
function isCookieValid ($db) {

  // $isValid wird auf false gesetzt
  $isValid = false;

  // Wenn $_COOKIE["rememberUserCookie"] gesetzt ist,
  if (isset($_COOKIE["rememberUserCookie"])) {

    // werden die Daten in $_COOKIE["rememberUserCookie"] entschlüsselt und in $decryptCookieData gespeichert,
    $decryptCookieData = base64_decode($_COOKIE["rememberUserCookie"]);
    // wird ein Array erzeugt in dem an Position 0 der Verschlüsselungszusatz und an Position 1 die entschlüsselte
    // User-ID gespeichert wird,
    $user_id = explode("Uh5R5tfzU3JüU1qHf9tFSTQR", $decryptCookieData);
    // wird die $userID auf die entschlüsselte User-ID gesetzt,
    $userID = $user_id[1];
    // wird eine SQL-Statement zusammengesetzt, welches nach dem Benutzer mit der entsprechenden User-ID in der Datenbank sucht,
    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    // wird das SQL-Statement vorbereitet,
    $statement = $db->prepare($sqlQuery);
    // wird das SQL-Statement mit der User-ID ausgeführt.
    $statement->execute(array(":id" => $userID));

    // Wenn außerdem $statement->fetch() eine Rückgabe liefert,
    if ($row = $statement->fetch()) {

      // wird $id auf die ID des zurückgegebenen Benutzers gesetzt,
      $id = $row["id"];
      // wird $username auf den Benutzernamen des zurückgegebenen Benutzers gesetzt,
      $username = $row["username"];
      // wird die User-ID in der Session abgespeichert,
      $_SESSION["id"] = $id;
      // wird der Benutzername in Session abgespeichert,
      $_SESSION["username"] = $username;
      // und wird $isValid auf true gesetzt.
      $isValid = true;
      // Sonst,
    } else {

      // wird $isValid auf false gesetzt
      $isValid = false;
      // und es werden alle Benutzerdaten aus den Cookies und Sessions enterfent und der
      // Benutzer wird zur Startseite weitergeleitet.
      signout();
    }

  }

  // $isValid wird zurückgegeben.
  return $isValid;
}



/**
 * @signout(): eine Funktion, die alle Benutzerdaten aus den Cookies und Sessions löscht und den Benutzer zur
 * Startseite weiterleitet.
 *
 * @unset(): löscht die angegebene Variable.
 * @setCookie(): PHP-Funktion, die einen Cookie setzt.
 * @session_destroy(): löscht alle in einer Session registrierten Daten.
 * @session_regenerate_id(): ersetzt die aktuelle Session-ID durch eine neu erzeugte.
 * @redirectTo(): eine Funktion, die einen Redirect vornimmt.
 *
 * @$_COOKIE: ein assoziatives Array von Variablen, die dem aktuellen Skript mittels HTTP-Cookies übergeben werden.
 * @$_SESSION: ein assoziatives Array, das die Sessionvariablen enthält und dem aktuellen Skript zur Verfügung stellt.
 */
function signout () {

  // $_SESSION["username"] wird gelöscht.
  unset($_SESSION["username"]);
  // $_SESSION["id"] wird gelöscht.
  unset($_SESSION["id"]);

  // Wenn $_COOKIE["rememberUserCookie"] gesetzt ist,
  if(isset($_COOKIE["rememberUserCookie"])) {

    // wird $_COOKIE["rememberUserCookie"] gelöscht
    unset($_COOKIE["rememberUserCookie"]);
    // und $_COOKIE["rememberUserCookie"] auf NULL gesetzt.
    setCookie("rememberUserCookie", NULL, -1, "/");
  }

  // Die Session wird gelöscht.
  session_destroy();
  // Es wird dem Benutzer eine neue Session-ID zugewiesen.
  session_regenerate_id(true);
  // Der Benutzer wird auf die Startseite weitergeleitet.
  redirectTo("index");
}

/**
 * @guard: eine Sicherheits-Funktion, die überprüft, ob der aktuelle Fingerprint des Benutzers mit dem in der Session
 * gespeicherten Fingerprint übereinstimmt und den Benutzers ausloggt, wenn dies nicht der Fall ist.
 *
 * @$isValid: eine Variable, in der gespeichert wird, ob der Fingerprint (noch) gültig ist oder nicht.
 * @$inactive: eine Variable, in der die Zeit definiert wird bis ein Benutzer als inaktiv gilt.
 * @$fingerprint: eine Variable, in der der Fingerprint des Benutzers (bestehend aus IP-Adresse und Browser) gespeichert wird.
 * @signout(): eine Funktion, die alle Benutzerdaten aus den Cookies und Sessions löscht und den Benutzer zur
 * Startseite weiterleitet.
 *
 * @md5(): Errechnet (verschlüsselt) den MD5-Hash eines Strings.
 * @$_SERVER: Informationen über Server und Ausführungsumgebung.
 * @REMOTE_ADDR: Die IP-Adresse des Nutzers.
 * @HTTP_USER_AGENT: Der vom Benutzer verwendete Browser.
 * @$_SESSION: ein assoziatives Array, das die Sessionvariablen enthält und dem aktuellen Skript zur Verfügung stellt.
 * @time(): gibt den aktuellen Unix-Timestamp (Sekunden seit Beginn der Unix-Epoche
 * [Januar 1 1970 00:00:00 GMT]) zurück.
 *
 * @return: gibt $isValid zurück.
 */
 function guard () {

   // $isValid wird auf true gesetzt.
   $isValid = true;
   // $inactive (die Zeit bis der Benutzer als inaktiv gilt) wird auf 60 Minuten gesetzt.
   $inactive = 60 * 60;
   // Zum vergelich mit dem im Header erzeigen Fingerprint wird die IP-Adresse des Benutzers und der
   // Browser des Benutzers verschlüsselt in $fingerprint gespeichert.
   $fingerprint = md5($_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"]);

   // Wenn $_SESSION["fingerprint"] gesetzt ist aber $_SESSION["fingerprint"] nicht gleich $fingerprint (Fingerprint aus dieser Funktion) ist,
   if ((isset($_SESSION["fingerprint"]) && $_SESSION["fingerprint"] != $fingerprint)) {

     // wird $isValid auf false gesetzt und
     $isValid = false;
     // der Benutzer ausgeloggt.
     signout();

     // Sonst, wenn $_SESSION["last_active"] gesetzt ist und die aktuelle Zeit - $_SESSION["last_active"] größer als $inactive (60 min)
     // ist und der Benutzer eingeloggt ist,
   } elseif ((isset($_SESSION["last_active"]) && (time() - $_SESSION["last_active"]) > $inactive) && $_SESSION["username"]) {

     // wird $isValid auf false gesetzt und
     $isValid = false;
     // der Benutzer ausgeloggt.
     signout();

     // Sonst,
   } else {

     // wird $_SESSION["last_active"] auf die aktuelle Zeit gesetzt (refresht $_SESSION["last_active"]).
     $_SESSION["last_active"] = time();

   }

   // $isValid wird zurückgegeben.
   return $isValid;
 }




 function isValidImage ($file) {

   $form_errors = array();

   $parts = explode(".", $file);

   $extension = end($parts);

   switch (strtolower($extension)) {
     case "jpg":
     case "jpeg":
     case "png":

     return $form_errors;
   }

   $form_errors[] = $extension . " ist keine zulässiges Dateiformat.";

   return $form_errors;

 }



 function uploadProfilePicture ($username) {

    

 }



?>
