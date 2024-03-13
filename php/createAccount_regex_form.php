<?php
//Accesses MAMP server an MySql server and accesses 
include 'php/serverlogin.php';
// Variables
$error_string;
$errors = []; // Array that collects error messages based on user input
$status = 1; // 0 for continue, 1 for exit, quits by default unless name exists in database
$name_exists_error = '';
// Form submitted variables with whitespace removed
$name_entry = trim($_POST["Name"]); // Creates variable for name entry and trims whitespace
$artist_type_entry = trim($_POST["ArtistType"]); // Creates variable for artisttype and trims whitespace
$about_artist_entry = trim($_POST["AboutArtist"]); // Creates variable for aboutartist and trims whitespace
$artist_img_entry = trim($_POST["ArtistImg"]); // Creates variable for artistimg and trims whitespace
$username_entry = trim($_POST["Username"]); // Creates variable for username and trims whitespace
$password_entry = trim($_POST["Password"]); //gets password form post and trims whitespace
// Prepared SQL statement to search existing usernames
$stmt = $conn -> prepare("SELECT username FROM signin"); //Prepared statement to check username
$stmt -> execute(); // Executes sql query
$stmt -> store_result(); // Stores result in an associative array
$stmt -> bind_result($username); // Binds results to parameters
// Checks all entries until username is found, or continues
while ($stmt -> fetch()) {
   // Compares database entries with string (includes case)
   if($username_entry == $username){ 
    $status = 1; // Continue
    $username_status = 1;// Continue
    $errors[] = "Username already exists, please try another one!<br>";
    break;
    }else{
        $username_status = 0; //Name can be used in database
    } 
}
//Includes php file for verifying password entry and providing error feedback
include "password_entry_regex.php";
//Verifies password has necessary characters with regex
$pass_ver = password_regex_check($password_entry);
if(empty($pass_ver)){
    $status = 0;
}else{
    $status = 1;
    // Logs errors in password entry
     foreach($pass_ver as $item){
        $errors[] = $item;
     }
}
//Checks to see if username is valid, else returns an error and sets status to 1
if($name_entry != null && strlen($name_entry) < 254 && strlen($name_entry)){
    //
}else{
    $status = 1;
    $errors[] = "Name must be between 1-100 characters!<br>";
}
//Checks artist type entry for null and boundary cases
if($artist_type_entry != null && strlen($artist_type_entry) < 254 && strlen($artist_type_entry) > 0){
    //
}else{
    $status = 1;
    $errors[] = "Artist must be between 1-100 characters!<br>";
}
//Checks about artist entry for null and boundary cases
if($about_artist_entry != null){
    //
}else{
    $status = 1;
    $errors[] = "Must include an artist description!<br>";
}
//Checks image filename for null and boundary cases
if($artist_img_entry != null && strlen($artist_img_entry) > 0 && strlen($artist_img_entry) < 50){
       //
}else{
    $status = 1;
    $errors[] .= "Image file must be between 1-50 characters long!<br>";
}
//Checks to see if there are values in the errors array and Submit has been clicked
if ($errors && isset($_POST["Submit"])) {
    foreach ($errors as $error) {
        $error_string .= $error;
    }
} else {
    $match = TRUE;
}
//Checks to see if the password matches all regex requirements
if($match == TRUE){
    if($password_entry != null && strlen($password_entry) < 254 && strlen($password_entry) >= 7){
        //Hashes password entry and saves it as a variable
       $hashed_password = password_hash($password_entry, PASSWORD_BCRYPT);
   }else{
       $status = 1;
       $errors[] = "Password must at least 7 characters!";
   }
}

//Checks if status and username status are valid and 
if($status == 0 && $username_status == 0 ){
    // Prepare the statements for inserting data into the artists and signin tables
    $stmt1 = mysqli_prepare($conn, "INSERT INTO artists (`Name`, ArtistImage, `Type`, `Description`) VALUES (?, ?, ?, ?)");
    // Bind the variables to the prepared statements
    mysqli_stmt_bind_param($stmt1, "ssss", $name_entry, $artist_img_entry, $artist_type_entry, $about_artist_entry);
    // Execute the prepared statements and check if the data was inserted successfully
    if (mysqli_stmt_execute($stmt1)) {
        $message = "Data inserted into the artists table successfully.";
      } else {
        $message = "Error inserting data into the artists table: " . mysqli_stmt_error($stmt1);
      }
      //Get artist_id from insertion into artist table
      $temp_artist_id = mysqli_insert_id($conn); 
    // Prepare the statements for inserting data into the artists and signin tables
    $stmt2 = mysqli_prepare($conn, "INSERT INTO signin (ArtistID, Username, `Password`) VALUES (?,?,?)");
    // Bind the variables to the prepared statements
    mysqli_stmt_bind_param($stmt2, "iss",$temp_artist_id, $username_entry, $hashed_password);
    // Execute the prepared statements and check if the data was inserted successfully
    if (mysqli_stmt_execute($stmt2)) {
      $message2 = "Data inserted into the signin table successfully.";
    } else {
      $message2 = "Error inserting data into the signin table: " . mysqli_stmt_error($stmt2);
    }
    // Close the statements and the database connection
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    $_SESSION["signin"]=TRUE;
    $_SESSION["artist_id"]=$temp_artist_id;
    header('Location: post.php');
    }
    
     //Clears errors if pages is refreshed
     if(!isset($_POST["Submit"] )){
        unset($errors);
     }
//Sign-up card
$createAccout_card = <<<SIGNUPCARD
<!-- Post form-->
    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
  
            <h1 class="fw-bolder text-center">Create New Account</h1>
     
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
            <p class="text-center text-danger">$error_string</p>
                <form method="post">
                    
                    <div class="form-floating mb-2">
                        <input type="text" name="Name" id="floatingName" placeholder="Name" class="form-control" value="$name" />
                        <label for="floatingName">Enter Name</label>
                    </div>
                    
                    <div class="form-floating mb-2">
                        <input type="text" name="ArtistType" id="floatingArtistType" placeholder="Type of Artist" class="form-control" value="$artist_type" />
                        <label for="floatingArtistType">Enter Artist Type</label>
                    </div>
                    
                    <div class="form-floating mb-2">
                        <input type="text" name="AboutArtist" id="floatingAboutArtist" placeholder="Tell Us About Yourself" class="form-control" value="$about_artist" />
                        <label for="floatingAboutArtist">Tell Us About Yourself</label>
                    </div>
                    
                    <div class="form-floating mb-2">
                        <input type="text" name="ArtistImg" id="floatingArtistImage"  placeholder="Upload An Image of Yourself" class="form-control" value="$artist_img" />
                        <label for="floatingArtistImage">Enter Artist Image Name</label>
                    </div>
                    
                    <div class="form-floating mb-2">
                        <input type="text" name="Username" id="floatingUsername" class="form-control" placeholder="Enter Your Username: " value="$username" />
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                            <input type="password" name="Password" id ="floatingPassword" class="form-control" placeholder="Enter Password" value="$password" />
                            <label for="floatingPassword">Password</label>
                    </div>
                    <div class="d-grid"><input name = "Submit" type ="Submit" class="btn btn-primary btn-lg" value="Submit" /></div>                           
                </form>
            </div>
        </div>
    </div>
SIGNUPCARD;
//Displays signin form
echo $createAccout_card;
?>
