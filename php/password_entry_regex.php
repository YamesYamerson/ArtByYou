<?php
function password_regex_check($password){
    //Variables
    $errors = [];
    $status = 1;
    //Password character conditions checks and error messages
    if ($password_entry != null && strlen($password_entry) < 7) {
        $errors[] = "Password must be at least 7 characters <br>";
    }
    if (!preg_match("/\d/", $password)) {
        $errors[] = "Password must contain at least one digit<br>";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Password must contain at least one capital letter<br>";
    }
    if (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Password must contain at least one small letter<br>";
    }
    if (!preg_match("/\W/", $password)) {
        $errors[] = "Password must contain at least one special character<br>";
    }
    if (preg_match("/\s/", $password)) {
        $errors[] = "Password must not contain any white space<br>";
    }
    return $errors;
}
?>