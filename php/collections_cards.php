<?php
//Accesses PHP server and accesses data for 
include 'php/serverlogin.php';
//Prepared statement to get theme data
$stmt = $conn -> prepare("SELECT ThemeID, Theme, ThemeImage FROM themes");
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($theme_id, $theme, $theme_image);
//For each entry in themes, populates page with a theme card
while ($stmt -> fetch()) {
    $thiscard = <<<COLLECTIONSCARD
    <div class="col-lg-4 mb-5">
        <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="$theme_image" alt="..." />
            <div class="card-body p-4">
                <!-- Button removed here -->
                <a class="text-decoration-none link-dark stretched-link" href="themes.php?theme=$theme"><h5 class="card-title mb-3">$theme</h5></a>
                <!--paragraph removed here -->
            </div>
            <!-- Div removed here -->
        </div>
    </div>
    COLLECTIONSCARD;
    echo $thiscard; //outputs collection card
 }
$stmt->close(); //close statement
$conn->close(); //close connection
?>