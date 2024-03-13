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
        <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation -->
            <!-- PHP statement to include navigation bar -->
           <?php include "php/navbar.php" ?>
            <!-- Themes collection-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder">Theme Collections</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">          
                            <!-- Include php file to populate collections page from sql database -->
                            <?php include 'php/collections_cards.php'; ?>
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
