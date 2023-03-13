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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Retrieve the tour data from the database based on the search criteria
        $sql = "SELECT tours.*, tourdate.date FROM tours INNER JOIN tourdate ON tours.Id = tourdate.tour_id WHERE tours.place = '".$_POST['place']."' AND tourdate.date = '".$_POST['tour_date']."'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Check if any tours were found
        if (mysqli_num_rows($result) > 0) {
            // Display the tour data in a table
            echo "<table>";
            echo "<tr><th>Place</th><th>Price</th><th>Description</th><th>Tour Date</th><th></th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row['place'] . "</td><td>" . $row['price'] . "</td><td>" . $row['description'] . "</td><td>" . $row['date'] . "</td><td><a href=\"book.php?id=" . $row['Id'] . "\">Book Now</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No tours found.";
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>
