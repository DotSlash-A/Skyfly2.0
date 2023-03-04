<?php
// Connect to database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query all bookings with user and tour details
$sql = "SELECT bookings.id, users.username, tours.name, bookings.booking_date
        FROM bookings
        JOIN users ON bookings.user_id = users.id
        JOIN tours ON bookings.tour_id = tours.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Bookings</title>
</head>
<body>
	<h1>Admin Bookings</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>User</th>
			<th>Tour</th>
			<th>Date</th>
		</tr>
		<?php while($row = $result->fetch_assoc()): ?>
			<tr>
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["username"]; ?></td>
				<td><?php echo $row["name"]; ?></td>
				<td><?php echo $row["booking_date"]; ?></td>
			</tr>
		<?php endwhile; ?>
	</table>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
