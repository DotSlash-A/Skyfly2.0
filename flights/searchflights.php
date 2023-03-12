<!DOCTYPE html>
<html>
<head>
	<title>Flights</title>
</head>
<body>
	<h1>Available Flights</h1>
	<table>
		<thead>
			<tr>
				<th>Airline</th>
				<th>Flight Number</th>
				<th>Origin</th>
				<th>Destination</th>
				<!-- <th>Departure time</th> -->
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Include the database configuration file
				include 'config.php';

				// Create a connection to the database
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

				// Check if the connection is successful
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve the user-selected values from the form
				$from = $_POST['from'];
				$to = $_POST['to'];
				$departure_date = $_POST['departure_date'];

				// Retrieve the flights from the flights table that match the user-selected values
				// $sql = "SELECT * FROM newflights WHERE origin = '$from' AND destination = '$to' AND departure_date = '$departure_date'";
				$sql = "SELECT * FROM flights WHERE origin = '".$_POST['from']."' AND destination = '".$_POST['to']."' AND departure_date = '".$_POST['departure_date']."'";
				$result = mysqli_query($conn, $sql);

				// Loop through the results and display each flight as a table row
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['airline'] . "</td>";
					echo "<td>" . $row['flight_number'] . "</td>";
					echo "<td>" . $row['origin'] . "</td>";
					echo "<td>" . $row['destination'] . "</td>";
					// echo "<td>" . $row['departure_time'] . "</td>";
					// echo "<td>" . date('H:i:s', strtotime($row['departure_time'])) . "</td>";
					// echo "<td>" . date('H:i:s', strtotime($row['departure_time'])) . "</td>";


					// echo "<td>" . $row['arrival_time'] . "</td>";
					echo "<td>" . $row['price'] . "</td>";
					echo "</tr>";
				}

				// Close the database connection
				mysqli_close($conn);
			?>
		</tbody>
	</table>
</body>
</html>
