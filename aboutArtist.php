<!-- Starts Session for Login and Site Functionality -->
<?php 
session_start();
$signin = $_SESSION["signin"];
$artist_id = $_SESSION["artist_id"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Art By You</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet"/>
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
        </pre>
            <!-- Navigation -->
            <!-- PHP statement to include navigation bar -->
           <?php include "php/navbar.php" ?>
            <!-- About artist section -->
            <!-- Include php file to populate about top card section -->           
            <?php include 'php/about_artist_topcard.php';?>
            </section>
            <!-- Artist collection -->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5">  
                    <!-- Include php file to populate about bottom card section -->
                    <?php include 'php/about_artist_bottomcard.php'; ?> 
                    </div>     
                </div> 
                </div>
            </section>
        </main>
        <!-- Footer-->
        <?php require_once "php/footer_card.php" ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
