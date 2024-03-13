<!-- PHP to grab values from form POST information that is submitted -->
<?php
//Functions
include "php/clean_text.php";
//Starts session
session_start();
$signin = $_SESSION["signin"];
$artist_id = $_SESSION["artist_id"];
//Test 
if(!$signin){
    header('Location: createAccount.php');
}
/// Initialize PHP variables to store form data
$name='';
$title='';
$theme='';
$filename='';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Art By You</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico"/>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <!-- Adapted from modern business contact.html page-->
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
           <!-- Navigation -->
            <?php include "php/navbar.php"; ?>
            <!-- Page content-->
            <?php require_once "php/post_form.php"; ?>  
        </main>
        <!-- Footer-->
        <?php require_once "php/footer_card.php"; ?>
    </body>
</html>
