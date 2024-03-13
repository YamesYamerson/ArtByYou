<!-- PHP to grab values from form POST information that is submitted -->
<?php
//Starts Session for Login and Site Functionality and unsets session status
$_SESSION["signin"] = FALSE;
unset($_SESSION["artist_id"]);
/// Initialize PHP variables to store form data
$name='';
$artist_type='';
$about_artist='';
$artist_img='';
$username ='';
$password='';
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
           <!-- Navigation - Links and titles changed from bootstrap-->
           <?php require_once "php/navbar.php" ?>
            <!-- Page content-->
            <section class="py-5">
                <div class="container px-5">
                <?php 
                include 'php/createAccount_regex_form.php';
                //If form submit button has been pushed, saves form POST info as PHP variables
                if(isset($_POST["Submit"])){
                    // Reinitializes variables
                    $name = '';
                    $artist_type = '';
                    $about_artist = '';
                    $artist_img = '';
                    $username = '';
                    $password = '';
                }
                ?>   
                </div>
            </section>
        
        </main>
        <!-- Footer-->
        <?php require_once "php/footer_card.php" ?>
    </body>
</html>
