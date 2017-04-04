<?php
if(isset($_POST['login_button'])) {

    // Initialisiert ein Array in dem alle Fehlermeldungen gespeichert werden.
    $form_errors = array();

    // Definiert alle Pflichfelder, die zu überprüfen sind.
    $required_fields = array('Benutzername', 'Passwort');

    // Ruft die Funktion check_empty_fields() auf und merged die Rückgabewerte in das $form_errors Array.
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)){

       /**
        * Fragt ab, ob das Registrierungs-Formular abgeschickt wurde und speichert
        * dann die Variablen aus dem Array in einzelnen Variablen ab.
        */
        $username = $_POST['Benutzername'];
        $password = $_POST['Passwort'];

        isset($_POST["remember"]) ? $remember = $_POST["remember"] : $remember = "";

        // Überprüft, ob der Eintrag bereits in der Database existiert.
        $sqlQuery = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':username' => $username));

       while ($row = $statement->fetch()){
           $id = $row['id'];
           $hashed_password = $row['password'];
           $username = $row['username'];

           if (password_verify($password, $hashed_password)){
               $_SESSION['id'] = $id;
               $_SESSION['username'] = $username;

               if ($remember === "yes") {
                 rememberMe($id);
               }

               redirectTo("index");
           } else {
            $result = flashMessage("Benutzername oder Passwort nicht korrekt!");
           }
       }

    } else {
        if (count($form_errors) == 1) {
          $result = flashMessage("Eine deiner Angaben ist nicht korrekt:");
        } else {
          $result = flashMessage(count($form_errors) . " deiner Angaben sind nicht korrekt:");
        }
    }
}

 ?>
