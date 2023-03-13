<!DOCTYPE html>
<html>
<head>
	<title>Tour Booking</title>
</head>
<body>
	<h1>Tour Booking</h1>
	
	<form method="post" action="booktour.php">
		<label for="place">Place:</label>
		<select id="place" name="place" required>
			<option value="">Select a place</option>
			<?php
				// Include the database configuration file
				include 'config.php';

				// Create a connection to the database
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

				// Check if the connection is successful
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve the list of places from the newtours table
				$sql = "SELECT DISTINCT place FROM tours ORDER BY place ASC";
				$result = mysqli_query($conn, $sql);

				// Loop through the results and create a dropdown option for each place
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value=\"" . $row['place'] . "\">" . $row['place'] . "</option>";
				}

				// Close the database connection
				mysqli_close($conn);
			?>
		</select>

		<label for="tour_date">Tour Date:</label>
		<input type="date" id="tour_date" name="tour_date" required>

		<input type="submit" value="Search">
	</form>

</body>
</html>
