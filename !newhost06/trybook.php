<!DOCTYPE html>
<html>
<head>
	<title>Tours</title>
</head>
<body>
	<h2>Available Tours</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Place</th>
			<th>Price</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		<?php
			// Connect to the database
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "testdb";
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			// Prepare and execute the SQL statement to select all tours
			$sql = "SELECT * FROM tours";
			$result = $conn->query($sql);

			// Loop through the results and display each tour in a row of the table
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["place"] . "</td><td>" . $row["price"] . "</td><td>" . $row["description"] . "</td><td><form action=\"final_login.php\" method=\"post\"><input type=\"hidden\" name=\"tourid\" value=\"" . $row["Id"] . "\"><input type=\"submit\" value=\"Book\"></form></td></tr>";
			    }
			} else {
			    echo "No tours available";
			}

			// Close the database connection
			$conn->close();
		?>
	</table>
</body>
</html>
