<?php
    // Include the database configuration file
    include 'config.php';

    // Create a connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create the flights table
    $sql = "CREATE TABLE newflights (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        airline VARCHAR(30) NOT NULL,
        flight_number VARCHAR(10) NOT NULL,
        origin VARCHAR(50) NOT NULL,
        destination VARCHAR(50) NOT NULL,
        departure_date DATE NOT NULL,
        departure_time TIME NOT NULL,
        arrival_date DATE NOT NULL,
        arrival_time TIME NOT NULL,
        price DECIMAL(10, 2) NOT NULL
    )";

    // Check if the table creation is successful
    if (mysqli_query($conn, $sql)) {
        echo "Table flights created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>
