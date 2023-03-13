<?php
	// Include the database configuration file
	include 'config.php';

	// Create a connection to the database
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check if the connection is successful
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Retrieve the tour data from the database based on the search criteria
	$sql = "SELECT * FROM newtours WHERE place = '".$_POST['place']."' AND tour_date = '".$_POST['tour_date']."'";
	$result = mysqli_query($conn, $sql);

	// Check if any tours were found
	if (mysqli_num_rows($result) > 0) {
		// Display the tour data in a table
		echo "<table>";
		echo "<tr><th>Tour</th><th>Price</th><th>Description</th><th>Tour Date</th></tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row['place'] . "</td><td>" . $row['price'] . "</td><td>" . $row['description'] . "</td><td>" . $row['tour_date'] . "</td></tr>";
		}
		echo "</table>";
	} else {
		// Display a message indicating that no tours were found
		echo "No tours found.";
	}

	// Close the database connection
	mysqli_close($conn);
?>