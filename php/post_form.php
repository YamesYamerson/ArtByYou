<?php
// Accesses MAMP server an MySql server and accesses 
include 'php/serverlogin.php';
// Variables
$status = 1; // 0 for continue, 1 for exit, quits by default unless name exists in database
$artist_id_temp;
$theme_id_temp;
$errors = [];
$message = [];
$error_string;
$create_theme = TRUE;
// Form submitted variables with whitespace removed
$name_entry = clean_text($_POST["name"]);
$title_entry = clean_text($_POST["title"]);
$theme_entry = clean_text($_POST["theme"]);
$filename_entry = clean_text($_POST["filename"]);
// SQL Variables
// Prepared SQL statement to search existing usernames
$stmt = $conn -> prepare("SELECT Theme, ThemeID FROM themes");
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($theme, $theme_id);
// Checks all entries until username is found, or continues
while ($stmt -> fetch()) {
    //If theme exists, do not create new theme
    if($theme_entry == $theme){
        $create_theme = FALSE;
        $theme_id_temp = $theme_id;
    }
    //Else create new theme entry in db
}
//Query for artists and themes
$myquery1 = "SELECT `Name`, ArtistID FROM artists;"; //Saves query as string 
$result = mysqli_query ($conn,$myquery1); //Returns result of queried data
$myquery2 = "SELECT Theme, ThemeID FROM themes;"; 
$result2 = mysqli_query ($conn,$myquery2);
//Create the query and use the connection to pass the query using POST form information
if ($result = $conn->query($myquery1)) {     //query again using OO approach to ensure not empty
    while ($row = $result->fetch_assoc()) { //result as assoc. array
        // Extracts variables from associative array
        $name = clean_text($row["Name"]);
        $artist_id = clean_text($row["ArtistID"]);
        // Compares database entries with string and ignores case
        if($_SESSION["artist_id"] == $artist_id){ 
                $artist_name_temp = $name;
                $artist_id_temp = $artist_id;
                $status = 0; // Name is confirmed in database and continues routine
        }
    }
}
// Check to see if name entry has passed verification
if(strlen($title_entry) > 0 && strlen($title_entry) < 100 && $title_entry != null){
    $status = 0;
}else{
    $errors[] = "Your title must be between 0-100 characters!<br>";
}
 // Check if s
if(strlen($filename_entry) > 0 && strlen($filename_entry) < 95 && $filename_entry != null){
    $status = 0;
}else{
$errors[] = "Filename not valid, please re-enter your filename<br>";
}
// Check if s
 if(strlen($theme_entry) > 0 && strlen($theme_entry) < 95 && $theme_entry != null){
    $status = 0;
}else{
$errors[] = "Theme name not valid, please re-enter theme<br>";
}
if(count($errors) === 0){
    $status = 0;
}else{
    $status = 1;
}
//Check if title entry has passed
if($status == 0){
    // $status = 1; // Resets so exit on incorrect theme
    $myquery2 = "SELECT Theme, ThemeID FROM themes;"; 
    $result2 = mysqli_query ($conn,$myquery2);
    if ($result2 = $conn->query($myquery2)) {     //query again using OO approach to ensure not empty
        while ($row = $result2->fetch_assoc()) { //result as assoc. array
            // //Extracts variables from associative array
            $theme = $row["Theme"];
            $theme_id = $row["ThemeID"];
            if($theme == $theme_entry){
                $status = 0;
                $theme_id_temp = $theme_id;
            }
        }
    }      
}
if($status == 0){
// Check if all data have been validated
if($create_theme == TRUE){
    // Prepared statement to add a new theme into themes table in database
    $sql = $conn->prepare("INSERT INTO themes (Theme, ThemeImage) VALUES (?, ?)");
    // Bind the statements
    $sql->bind_param("ss", $theme_entry, $filename_entry);
    // Execute the query and add post submission information
    $sql->execute();
    $message[] =  "New Theme Created<br>";
}
}

if($status == 0){
    // Creates a prepared statment to insert post into database
    $sql = $conn->prepare("INSERT INTO artwork (Title, ArtImage, ThemeID, ArtistID) VALUES (?, ?, ?, ?)");
    // Bind the statements
    $sql->bind_param("ssii", $title_entry, $filename_entry, $theme_id_temp, $artist_id_temp);
    // Execute the query and add post submission information
    $sql->execute();
    $message[] = "New Post Created<br>";
}
//Outputs error messages on submit
if ($errors && isset($_POST["Submit"])) {
    foreach ($errors as $error) {
        $error_string .= $error;
    }
}
// Outputs success messages on submit
if ($message && isset($_POST["Submit"])) {
    foreach ($message as $item) {
        $messages .= $item;
    }
}

$post_output = <<<POSTCARD
<section class="py-5">
    <div class="container px-5">
        <!-- Post form-->
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center">
                <h1 class="fw-bolder">$artist_name_temp Upload new Art</h1>
            </div>
            <div class="row gx-5 justify-content-center">
            <p class="text-center text-danger">$error_string</p>
            <p class="text-center text-success">$messages</p>
                <div class="col-lg-8 col-xl-6">
                    <form method="post">
                        <br />
                        <div class="form-group">
                            <label>Enter Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="$title" />
                        </div>
                        <div class="form-group">
                            <label>Enter Theme</label>
                            <input type="text" name="theme" class="form-control" placeholder="Enter Theme" value="$theme" />
                        </div>
                        <div class="form-group mb-3">
                            <label>Enter Filename</label>
                            <input type = text name="filename" class="form-control" placeholder="Enter Filename" value ="$filename" />
                        </div>
                        <div class="d-grid"><input name = "Submit" type ="Submit" class="btn btn-primary btn-lg" value="Submit" /></div>                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
POSTCARD;
echo $post_output;
if(!isset($_POST["Submit"])){
    $title = '';
    $theme = '';
    $filename = '';
    $errors = '';
}
$stmt->close();
$conn->close(); //Close connection

?>