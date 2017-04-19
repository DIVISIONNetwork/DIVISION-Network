<?php
include_once ("./../src/php/login_system/database_connection.php");
include_once ("./../src/php/login_system/utilities.php");

// Wenn der Login-Button gedrückt wurde,
if (isset($_POST['login_button'], $_POST["token"])) {

    //token validieren
    if (validate_token($_POST["token"])) {

      // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
      $form_errors = array();

      // werden alle Pflichfelder, die zu überprüfen sind, definiert.
      $required_fields = array('Benutzername', 'Passwort');

      // wird die Funktion check_empty_fields() aufgerufen und die Rückgabewerte werden in das $form_errors-Array gemerged.
      $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

      // Wenn das $form_errors-Array bis hierhin leer ist (also keine Fehler vorliegen),
      if (empty($form_errors)){

          // wird $username auf $_POST['Benutzername']
          $username = $_POST['Benutzername'];
          // und $password auf $_POST['Passwort'] gesetzt.
          $password = $_POST['Passwort'];

          // Wenn auch $_POST["remember"] ("Remember me"-Funktion) gesetzt ist,
          if (isset($_POST["remember"])) {

            // wird $remember auf $_POST["remember"] (also: "yes") gesetzt.
            $remember = $_POST["remember"];

          } else {

            // Sonst wird $remember auf einen leeren String gesetzt.
            $remember = "";

          }

          // Es wird ein SQL-Statement in der Variablen $sqlQuery zusammengesetzt.
          $sqlQuery = "SELECT * FROM users WHERE username = :username";

          // Das SQL-Statement wird mit prepare($sqlQuery) vorbereitet.
          $statement = $db->prepare($sqlQuery);

          // Das SQL-Statement wird ausgeführt.
          $statement->execute(array(':username' => $username));

          // Wenn $statement->fetch() einen Rückgabewert liefert, wird die gefetchte Row in $row gespeichert und
          if ($row = $statement->fetch()) {

            // wird $id auf $row['id'] (die User-ID) gesetzt,
            $id = $row['id'];
            // wird das übermittelte Passwort enkodiert und in $hashed_password gespeichert,
            $hashed_password = $row['password'];
            // wird $username auf $row['username'] (den Benutzernamen) gesetzt
            $username = $row['username'];
            // und $activated auf $row['activated'] gesetzt.
            $activated = $row['activated'];

            // Wenn $activated === "0" ist (also der Account noch nicht aktiviert wurde),
            if ($activated === "0") {

              // wird die Fehlermeldung "Bitte aktiviere deinen Account." ausgegeben.
              $result = flashMessage("Bitte aktiviere deinen Account.");

              // Wenn $activated != "0" ist (also der Account bereits aktiviert wurde),
            } else {

              // wird, wenn password_verify() true zurückgibt (also $password [das eingegebene Passwort] und $hashed_password [das in der Database gespeicherte Passwort] übereinstimmen),
              if (password_verify($password, $hashed_password)){

                // $_SESSION['id'] auf die User-ID gesetzt
                $_SESSION['id'] = $id;
                // $_SESSION['username'] auf den Benutzernamen gesetzt,
                $_SESSION['username'] = $username;

              /**
                * @REMOTE_ADDR: Die IP-Adresse des Nutzers.
                * @HTTP_USER_AGENT: Der vom Benutzer verwendete Browser.
                * @md5(): Errechnet (verschlüsselt) den MD5-Hash eines Strings.
                * @$_SERVER: Informationen über Server und Ausführungsumgebung.
                */

                // eine Fingerprint des Benutzers (mit IP-Adresse und Browser) gespeichert,
                $fingerprint = md5($_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"]);
                // $_SESSION["last_active"] auf die aktuelle Zeit gesetzt,
                $_SESSION["last_active"] = time();
                //   $_SESSION["fingerprint"] auf den Fingerprint des Benutzers gesetzt und
                $_SESSION["fingerprint"] = $fingerprint;

                // zur Begrüßung per Sweet Alert "Willkommen zurück" ausgegeben.
                echo $welcome = "<script type=\"text/javascript\">
                                swal({
                                title: \"Hallo {$username}!\",
                                text: \"Du hast dich erfolgreich angemeldet.\",
                                type: \"success\",
                                timer: 3000,
                                showConfirmButton: false });

                                setTimeout(function(){
                                window.location.href = 'index.php';
                              }, 2000);
                                </script>";

                // Wenn außerdem $remember auf "yes" gesetzt ist,
                if ($remember === "yes") {
                  // wird auf dem PC des Benutzers eine Cookie mit der verschlüsselten User-ID angelegt, der nach 30 Tagen verfällt.
                  rememberMe($id);

                }

                // Wenn password_verify() false zurückgibt (also $password [das eingegebene Passwort] und $hashed_password[das in der Database gespeicherte Passwort] nicht übereinstimmen),
              } else {

                // wird eine Fehlermeldung ausgegeben.
                $result = flashMessage("Benutzername und/oder Passwort nicht korrekt!");

              }

            }

            // Wenn $statement->fetch() keine Row zurückgibt (also ein Falscher Benutzername angegeben wurde),
          } else {

            // wird eine Fehlermeldung ausgegeben.
            $result = flashMessage("Benutzername und/oder Passwort nicht korrekt!");

         }

         // Wenn das $form_errors-Array nicht leer ist (also Fehler vorliegen),
       } else {

         // und nur ein Fehler vorliegt,
         if (count($form_errors) == 1) {

           // wird die Fehlermeldung für einen Fehler ausgegeben.
           $result = flashMessage("Eine deiner Angaben ist nicht korrekt:");

           // Sonst,
          } else {

            // wird die Fehlermeldung für mehrere Fehler ausgegeben.
            $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");

          }

      }

    } else {

      $result = "<script type='text/javascript'>swal('Error', 'Diese Anfrage stammt von einer unbekannten Quelle. Es handelt sich möglicher Weise um einen Angriff.', 'error');</script>";

    }

}

?>
