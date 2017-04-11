<?php

// Wenn der Login-Button gedrückt wurde,
if (isset($_POST['login_button'])) {

    // wird ein Array in dem alle Fehlermeldungen gespeichert werden initialisiert,
    $form_errors = array();

    // werden alle Pflichfelder, die zu überprüfen sind, definiert.
    $required_fields = array('Benutzername', 'Passwort');

    // wird die Funktion check_empty_fields() aufgerufen und die Rückgabewerte werden in das $form_errors Array gemerged.
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    // Wenn außerdem das $form_errors-Array leer ist (also keine Fehler vorliegen),
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

        // Wenn $statement->fetch() einen Rückgabewert liefert, wird die gefetchte Row in $row gespeichert,
        if ($row = $statement->fetch()) {

          // wird $id auf $row['id'] (die User-ID) gesetzt,
          $id = $row['id'];
          // wird $hashed_password auf $row['password'] (das gehashte Passwort) gesetzt
          $hashed_password = $row['password'];
          // und wird $username auf $row['username'] (den Benutzernamen) gesetzt.
          $username = $row['username'];

          // Wenn password_verify() true zurückgibt (also $password [das eingegebene Passwort] und
          // $hashed_password[das in der Database gespeicherte Passwort] übereinstimmen),
          if (password_verify($password, $hashed_password)){

            // wird $_SESSION['id'] auf die User-ID gesetzt
            $_SESSION['id'] = $id;
            // und wird $_SESSION['username'] auf den Benutzernamen gesetzt.
            $_SESSION['username'] = $username;

            // Wenn außerdem $remember auf "yes" gesetzt ist,
            if ($remember === "yes") {

              // wird auf dem PC des Benutzers eine Cookie mit der verschlüsselten User-ID angelegt, der nach 30 Tagen verfällt.
              rememberMe($id);
            }

            // Und der Benutzer wird zur Startseite redirectet.
            redirectTo("index");

            // Wenn password_verify() false zurückgibt (also $password [das eingegebene Passwort] und
            // $hashed_password[das in der Database gespeicherte Passwort] nicht übereinstimmen),
          } else {
            // wird eine Fehlermeldung ausgegeben.
            $result = flashMessage("Benutzername oder Passwort nicht korrekt!");
         }
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
}

?>
