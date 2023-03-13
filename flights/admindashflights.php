<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
</head>
<body>
	<h1>Admin Dashboard</h1>

	<?php
		// Include the database configuration file
		include 'config.php';

		// Create a connection to the database
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		// Check if the connection is successful
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// Retrieve the list of flights from the database
		$sql = "SELECT * FROM newflights";
		$result = mysqli_query($conn, $sql);

		if (!$result) {
			die("Query failed: " . mysqli_error($conn));
	}

		// Display the flights as a table
		echo "<table>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Airline</th>";
		echo "<th>Flight Number</th>";
		echo "<th>Origin</th>";
		echo "<th>Destination</th>";
		echo "<th>Departure Time</th>";
		echo "<th>Price</th>";
		echo "<th>Actions</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";

			// Check if the connection is successful
	
		// Loop through the results and display each flight as a table row with edit and delete buttons
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row['airline'] . "</td>";
			echo "<td>" . $row['flight_number'] . "</td>";
			echo "<td>" . $row['origin'] . "</td>";
			echo "<td>" . $row['destination'] . "</td>";
			echo "<td>" . date('H:i:s', strtotime($row['departure_time'])) . "</td>";
			echo "<td>" . $row['price'] . "</td>";
			echo "<td>";
			echo "<form method='post' action='editflight.php'>";
			echo "<input type='hidden' name='flight_id' value='" . $row['id'] . "'>";
			echo "<input type='submit' value='Edit'>";
			echo "</form>";
			echo "<form method='post' action='deleteflight.php'>";
			echo "<input type='hidden' name='flight_id' value='" . $row['id'] . "'>";
			echo "<input type='submit' value='Delete'>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
		}

		echo "</tbody>";
		echo "</table>";

		// Close the database connection
		mysqli_close($conn);
	?>

</body>
</html>
