<?php
//Accesses PHP server and accesses data for 
include 'php/serverlogin.php';
//Gets current page theme name
$temp_theme = trim($_GET["theme"]);
//Create the query and use the connection to pass the query
$myquery = "SELECT * FROM artists JOIN artwork ON artists.ArtistID=artwork.ArtistID JOIN themes ON artwork.ThemeID = themes.ThemeID WHERE `theme` = '$temp_theme';";         //create SQL query and save it as a String
$result = mysqli_query ($conn,$myquery);    //query database
if ($result = $conn->query($myquery)) {     //query again using OO approach to ensure not empty
    while ($row = $result->fetch_assoc()) { //result as assoc. array
        // //Extracts variables from associative array
        $theme = $row["Theme"];
        $title = $row["Title"];
        $name = $row["Name"];
        $art_image = $row["ArtImage"];
        // Heredoc used to populate themes section using variables from sql database
        $thiscard = <<<THEMECARD
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="files/themes/$theme/$art_image" alt="..." />
                        <div class="card-body p-4">
                        <a class="text-decoration-none link-dark stretched-link" href="aboutArtist.php?artist=$name">
                            <h5 class="card-title mb-3"><strong>$name</strong></h5>
                            <!-- Button removed here -->
                            <h5 class="card-title mb-3">$title</h5>
                        </a>
                            <!--paragraph removed here -->
                        </div>
                        <!-- Div removed here -->
                    </div>
                </div>
            THEMECARD;
            echo $thiscard;
        }
    }
$stmt->close(); //Close statement
$conn->close(); //Close connection
?>