<?php
    // Include the database configuration file
    include 'config.php';

    // Create a connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the form data
        $airline = $_POST["airline"];
        $flight_number = $_POST["flight_number"];
        $origin = $_POST["origin"];
        $destination = $_POST["destination"];
        $departure_date = $_POST["departure_date"];
        $departure_time = $_POST["departure_time"];
        $arrival_date = $_POST["arrival_date"];
        $arrival_time = $_POST["arrival_time"];
        $price = $_POST["price"];

        // Insert the data into the flights table
        $sql = "INSERT INTO newflights (airline, flight_number, origin, destination, departure_date, departure_time, arrival_date, arrival_time, price)
                VALUES ('$airline', '$flight_number', '$origin', '$destination', '$departure_date', '$departure_time', '$arrival_date', '$arrival_time', '$price')";

        // Check if the insertion is successful
        if (mysqli_query($conn, $sql)) {
            echo "Flight added successfully";
        } else {
            echo "Error adding flight: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>
