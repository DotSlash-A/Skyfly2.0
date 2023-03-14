<?php
    // Include the database configuration file
    include 'config.php';

    // Create a connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start the session
    session_start();

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Get the tour ID from the POST data
    $tour_id = $_POST['tour_id'];

    // Get the current date for the booking
    $booking_date = date('Y-m-d');

    // Insert the booking into the bookings table
    $sql = "INSERT INTO bookings (user_id, tour_id, booking_date) VALUES ('$user_id', '$tour_id', '$booking_date')";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        echo "Booking successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>