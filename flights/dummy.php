<!DOCTYPE html>
<html>
<head>
	<title>Flight Booking</title>
</head>
<body>
	<h1>Flight Booking</h1>
	
	<form method="post" action="searchflights.php">
		<label for="from">From:</label>
		<select id="from" name="from" required>
			<option value="">Select origin</option>
			<?php
				// Include the database configuration file
				include 'config.php';

				// Create a connection to the database
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

				// Check if the connection is successful
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve the list of origin airports from the newflights table
				$sql = "SELECT DISTINCT origin FROM newflights ORDER BY origin ASC";
				$result = mysqli_query($conn, $sql);

				// Loop through the results and create a dropdown option for each airport
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value=\"" . $row['origin'] . "\">" . $row['origin'] . "</option>";
				}

				// Close the database connection
				mysqli_close($conn);
			?>
		</select>

		<label for="to">To:</label>
		<select id="to" name="to" required>
			<option value="">Select destination</option>
			<?php
				// Include the database configuration file
				include 'config.php';

				// Create a connection to the database
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

				// Check if the connection is successful
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve the list of destination airports from the newflights table
				$sql = "SELECT DISTINCT destination FROM newflights ORDER BY destination ASC";
				$result = mysqli_query($conn, $sql);

				// Loop through the results and create a dropdown option for each airport
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value=\"" . $row['destination'] . "\">" . $row['destination'] . "</option>";
				}

				// Close the database connection
				mysqli_close($conn);
			?>
		</select>

		<label for="departure_date">Departure Date:</label>
		<input type="date" id="departure_date" name="departure_date" required>

		<input type="submit" value="Search">
	</form>

</body>
</html>

<?php
	// Include the database configuration file
	include 'config.php';

	// Create a connection to the database
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check if the connection is successful
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Retrieve the flight data from the database based on the search criteria
	$sql = "SELECT * FROM flights WHERE origin = '".$_POST['from']."' AND destination = '".$_POST['to']."' AND departure_date = '".$_POST['departure_date']."'";
	$result = mysqli_query($conn, $sql);

	// Check if any flights were found
	if (mysqli_num_rows($result) > 0) {
		// Display the flight data in a table
		echo "<table>";
		echo "<tr><th>Flight Number</th><th>Origin</th><th>Destination</th><th>Departure Date</th><th>Departure Time</th><th>Arrival Time</th></tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row['flight_number'] . "</td><td>" . $row['origin'] . "</td><td>" . $row['destination'] . "</td><td>" . $row['departure_date'] . "</td><td>" . $row['departure_time'] . "</td><td>" . $row['arrival_time'] . "</td></tr>";
		}
		echo "</table>";
	} else {
		// Display a message indicating that no flights were found
		echo "No flights found.";
	}

	// Close the database connection
	mysqli_close($conn);
?>
