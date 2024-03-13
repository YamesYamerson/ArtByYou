<?php
//Accesses PHP server and accesses data for 
include 'php/serverlogin.php';
//Creates prepared statement to get data from artists table
$stmt = $conn -> prepare("SELECT `Name`, ArtistImage, `Type` ,`Description` FROM artists");
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($name, $artist_image, $type, $description);
//Loop to populate artists cards on page
while ($stmt -> fetch()) {
    // Heredoc to insert database values into artistcards
    $thiscard = <<<ARTISTCARD
    <div class="col mb-5 pb-5 mb-5 mb-xl-0">
        <div class="text-center">
            <a href = "aboutArtist.php?artist=$name&artstyle=$type">
                <img class="img-fluid rounded-circle mb-4 px-4" src="$artist_image.jpg" alt="..." />
                <h5 class="fw-bolder">$name</h5>
            </a>
            <div class="fst-italic text-muted">$type</div>
        </div>
    </div> 
    ARTISTCARD;
echo $thiscard; //outputs artist card
}
$stmt->close(); //close statement
$conn->close(); //close connection
?>