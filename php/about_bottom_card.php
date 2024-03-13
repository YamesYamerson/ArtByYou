<?php
//Connects to MySQL and accesses database 'artforyou' 
include 'php/serverlogin.php';
// MySQL Variables
$about_id = 1;

$stmt = mysqli_prepare($conn, "SELECT HomePage, Story, AboutImage FROM about WHERE AboutID=?");
mysqli_stmt_bind_param($stmt, "i", $about_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $homepage, $story, $about_image);
mysqli_stmt_fetch($stmt);

$thiscard = <<<ABOUTCARD
<section class="py-5 bg-light" id="scroll-target">
    <div class="container px-5 my-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="files/index/$about_image" alt="..." /></div>
            <div class="col-lg-6">
                <h2 class="fw-bolder">Our Story</h2>
                <p class="lead fw-normal text-muted mb-0">$story</p>
            </div>
        </div>
    </div>
</section>
ABOUTCARD;
echo $thiscard; //outputs about card
$stmt->close(); //close statement
$conn->close(); //close connection
?>