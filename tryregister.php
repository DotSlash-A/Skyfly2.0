<?php
// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the values from the form
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];
  $usertype = $_POST["usertype"];

  // Validate the password
  if ($password != $confirm_password) {
    die("Password and confirm password do not match.");
  }

  // Connect to the database
  $servername = "localhost:3307";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "testdb";
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL statement to insert a new user into the database
  $stmt = $conn->prepare("INSERT INTO users (username, password, usertype) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $password, $usertype);
  $stmt->execute();

  // Redirect the user to the login page
  header("Location: login.php");
  exit();
}
?>
