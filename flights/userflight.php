<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard</title>
</head>
<body>
	<h1>Welcome to the Flight Booking Website!</h1>
	<h2>Search for Flights</h2>
	<form method="post" action="search_flights.php">
		<label for="from">From:</label>
		<input type="text" id="from" name="from" required><br><br>

		<label for="to">To:</label>
		<input type="text" id="to" name="to" required><br><br>

		<input type="submit" value="Search">
	</form>

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
			$from = $_POST["from"];
			$to = $_POST["to"];

			// Search for flights based on origin and destination
			$sql = "SELECT * FROM flights WHERE origin='$from' AND destination='$to'";
			$result = mysqli_query($conn, $sql);

			// Check if any flights are found
			if (mysqli_num_rows($result) > 0) {

				// Display a table of available flights
				echo "<h2>Available Flights</h2>";
				echo "<table>";
				echo "<tr><th>Airline</th><th>Flight Number</th><th>Origin</th><th>Destination</th><th>Departure Date</th><th>Arrival Date</th><th>Price</th><th>Book</th></tr>";
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["airline"] . "</td>";
					echo "<td>" . $row["flight_number"] . "</td>";
					echo "<td>" . $row["origin"] . "</td>";
					echo "<td>" . $row["destination"] . "</td>";
					echo "<td>" . $row["departure_date"] . "</td>";
					echo "<td>" . $row["arrival_date"] . "</td>";
					echo "<td>" . $row["price"] . "</td>";
					echo "<td><a href='book_flight.php?flight_id=" . $row["id"] . "'>Book</a></td>";
					echo "</tr>";
				}
				echo "</table>";

			} else {

				// Display a message if no flights are found
				echo "<p>No flights found for the selected origin and destination.</p>";
			}
		}

		// Close the database connection
		mysqli_close($conn);
	?>
</body>
</html>
