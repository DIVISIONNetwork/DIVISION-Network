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
  $key = "email";

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
 * @param $form_errors_array: ein Array, welches alle Fehler enthält.
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

 ?>
