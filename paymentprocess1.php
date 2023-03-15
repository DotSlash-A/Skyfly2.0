<?php
// Start session
session_start();

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve card information from form
$card_number = $_POST['cardnumber'];
$exp_year = $_POST['year'];
$name_on_card = $_POST['name'];
$phone_number = $_POST['phonenumber'];

// Connect to database
$conn = mysqli_connect("localhost:3307", "root", "", "testdb");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Insert card information into cards table
$sql = "INSERT INTO cardstable (cardnumber, year, name, phonenumber, userid) VALUES ('$card_number', '$exp_year', '$name_on_card', '$phone_number', '$user_id')";

if (mysqli_query($conn, $sql)) {
  echo "Card added successfully.";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
header("Location: newpaidalltours.php");

// Close connection
mysqli_close($conn);
?>
