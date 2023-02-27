<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Get the tour ID from the URL
$tourid = $_GET['tourid'];

// Connect to the database
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "testdb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement to insert the booking
    $stmt = $conn->prepare("INSERT INTO bookings (tourid, userid) VALUES (:tourid, :userid)");
    $stmt->bindParam(':tourid', $tourid);
    $stmt->bindParam(':userid', $_SESSION['userid']);
    $stmt->execute();

    // Redirect to the user dashboard
    header("Location: userdashboard.php");
    exit();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
