<?php
session_start(); // start the session

if ($_SESSION['usertype'] != 'user') { // check if the user is a regular user
    header('Location: error_page.php'); // redirect to an error page if they are not
    exit();
}

require_once 'database_connection.php'; // include the file with the database connection code

// get the form data
$hotel_name = $_POST['hotel_name'];
$checkin_date = $_POST['checkin_date'];
$checkout_date = $_POST['checkout_date'];

// insert the booking information into the database
$sql = "INSERT INTO hotelbookings (user_id, hotel_name, checkin_date, checkout_date) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['id'], $hotel_name, $checkin_date, $checkout_date]);

// redirect the user to a confirmation page
header('Location: confirmation_page.php');
exit();
?>
