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

				// Retrieve the list of origin airports from the flights table
				$sql = "SELECT DISTINCT origin FROM flights ORDER BY origin ASC";
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

				// Retrieve the list of destination airports from the flights table
				$sql = "SELECT DISTINCT destination FROM flights ORDER BY destination ASC";
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

	
    