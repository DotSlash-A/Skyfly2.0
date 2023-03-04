<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the user session
    
    // Redirect the user to the login page
    header("Location: final_login.php");
    exit();
}
?>
You have logged out!