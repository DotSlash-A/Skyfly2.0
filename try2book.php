<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["usertype"] == 'user') {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tour_id = $_POST["tour_id"];
        $user_id = $_SESSION["id"];
        
        // Database credentials
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "testdb";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO bookings (tour_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $tour_id, $user_id);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "Booking added successfully.";
        } else {
            echo "Error adding booking: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    header("location: final_login.php");
    exit;
}
?>
