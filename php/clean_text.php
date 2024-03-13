<?php 
// Remove whitespace and slashes and format text for HTML
function clean_text($string){
    $string = trim($string); //removes whitespace
    $string = stripslashes($string); //removes slashes
    $string = htmlspecialchars($string); //encodes to UTF 8
    return $string;
}
?>