<?php
// Connects to MySQL database and accesses 'artbyyou'
include 'php/serverlogin.php';
// General Variables
$thisartist = trim($_GET['artist']); //trims whitespace
// MySQL Variables
$myquery = "SELECT * FROM artists JOIN artwork ON artists.ArtistID=artwork.ArtistID JOIN themes ON artwork.ThemeID = themes.ThemeID WHERE `name` = '$thisartist';"; 
$result = mysqli_query ($conn,$myquery);    //query database
// Uses MySQL variables to query database and populate page
if ($result = $conn->query($myquery)) {     //query again using OO approach to ensure not empty
    while ($row = $result->fetch_assoc()) { //result as assoc. array
        // //Extracts variables from associative array
        $name = $row["Name"];
        $title = $row['Title'];
        $art_image = $row['ArtImage'];
        $theme = $row['Theme'];
        $theme_image = $row['ThemeImage'];
        //Heredoc to output queried data as artist artwork cards
        $output = <<<ABOUTARTISTBOTTOMCARD
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="files/themes/$theme/$art_image" alt="..." />
                        <div class="card-body p-4">
                        <a class="text-decoration-none link-dark stretched-link" href="">
                            <h5 class="card-title mb-3"><strong>$name</strong></h5>
                            <!-- Button removed here -->
                            <h5 class="card-title mb-3">$title</h5>
                        </a>
                            <!--paragraph removed here -->
                        </div>
                        <!-- Div removed here -->
                    </div>
                </div>
        ABOUTARTISTBOTTOMCARD;
echo $output;
    }
}else{
    printf("Nothing to see here!"); // If database is empty or error occurs
}
$conn->close(); //Close connection
?>