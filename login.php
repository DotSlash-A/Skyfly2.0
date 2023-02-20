<?php
// Start session
session_start();

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];

// Validate the submitted username and password
if ($usertype == 'user') {
    // Validate user credentials
    if ($username == 'user123' && $password == 'pass123') {
        // User is authenticated, save the username in session and redirect to user dashboard
        $_SESSION['username'] = $username;
        header('Location: myindex.html');
        exit();
    } else {
        // User authentication failed, redirect back to login page with error message
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: retry.html');
        exit();
    }
} else if ($usertype == 'admin') {
    // Validate admin credentials
    if ($username == 'ria' && $password == 'ria') {
        // Admin is authenticated, save the username in session and redirect to admin dashboard
        $_SESSION['username'] = $username;
        header('Location: myindex.html');
        exit();
        
    } else {
        // Admin authentication failed, redirect back to login page with error message
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: retry.html');
        exit();
    }
}
?>
