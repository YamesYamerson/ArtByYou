<?php 
    //Sign in and page array variables
    $host = 'localhost';
    $database = 'artbyyou';
    $username = 'root';
    $password = 'root';
    //Connects to database
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed!" . mysqli_connect_error());
    }
     //Get host and uri information from global variables and define page directory
     $host = $_SERVER['HTTP_HOST'];
     $page= $_SERVER['REQUEST_URI'];
     $url = $host . $page;
?>