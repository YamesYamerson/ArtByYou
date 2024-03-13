 <?php 
include 'php/serverlogin.php';
//Create the query and use the connection to pass the query
$stmt = $conn -> prepare("SELECT Homepage, AboutImage FROM about");
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($homepage, $about_image);
//Loop to populate artists cards on page
while ($stmt -> fetch()) {
    $indexheader = <<<INDEXHEADER
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Art by You</h1>
                        <p class="lead fw-normal text-white-50 mb-4">$homepage</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="createAccount.php">Sign Up</a>
                            <a class="btn btn-outline-light btn-lg px-4" href="about.php">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="files/index/$about_image" alt="..."/></div>
            </div>
        </div>
    </header>
    INDEXHEADER;
    echo $indexheader; //outputs index header
}
$stmt->close(); //close statement
$conn->close(); //close connection
?>