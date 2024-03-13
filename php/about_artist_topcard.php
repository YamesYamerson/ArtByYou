<?php
// Connects to MySQL database and accesses 'artbyyou'
include 'php/serverlogin.php';
// General Variables
$thisartist = trim($_GET['artist']);
//Prepared statement to get artist data
$stmt = $conn -> prepare("SELECT `Name`, ArtistImage, `Type`, `Description` FROM artists WHERE `Name` = ?");
mysqli_stmt_bind_param($stmt, "s", $thisartist);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($name, $artist_image, $type, $description);
mysqli_stmt_fetch($stmt);
//Heredoc to output artist photo and description in top card
$output = <<<ABOUTARTISTTOPCARD
                <!-- About section one-->
                <section class="py-5 bg-light" id="scroll-target">
                    <div class="container px-5 my-5">
                        <div class="row gx-5 align-items-center">
                            <div class="col-lg-6">
                                <img class="img-fluid rounded mb-5 mb-lg-0" src="$artist_image.jpg" alt="..." /></div>
                            <div class="col-lg-6">
                                <h2 class="fw-bolder">$name - $type</h2>
                                <p class="lead fw-normal text-muted mb-0">$description</p>
                            </div>
                        </div>
                    </div>
                </section>
            ABOUTARTISTTOPCARD;
            echo $output;
$stmt->close(); //close statment
$conn->close(); //close connection
?>