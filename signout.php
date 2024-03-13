<?php
session_start();
unset($_SESSION['signin']);
unset($_SESSION['artist_id']);
header("Location: signin.php");
exit();
?>