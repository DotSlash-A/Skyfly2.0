<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<h1>Your id is, <?php echo $_SESSION['user_id']; ?>!</h1>

<h2>Flights Available:</h2>
<table>
	<thead>
		<tr>
			<th>Airline</th>
			<th>Flight Number</th>
			<th>Origin</th>
			<th>Destination</th>
			<th>Departure Time</th>
			<th>Price</th>
			<th>Book</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($flight = mysqli_fetch_assoc($flights_result)): ?>
			<tr>
				<td><?php echo $flight['airline']; ?></td>
				<td><?php echo $flight['flight_number']; ?></td>
				<td><?php echo $flight['origin']; ?></td>
				<td><?php echo $flight['destination']; ?></td>
				<td><?php echo date('H:i:s', strtotime($flight['departure_time'])); ?></td>
				<td><?php echo $flight['price']; ?></td>
				<td>
					<form method="POST">
						<input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
						<button type="submit" class="btn btn-primary">Book</button>
					</form>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>

<?php
// Check if the book button is clicked
if (isset($_POST['flight_id'])) {
	// Get the flight ID and user ID
	$flight_id = $_POST['flight_id'];
	$user_id = $_SESSION['user_id'];

	// Insert the booking into the flightsbooking table
	$insert_query = "INSERT INTO flightsbooking (flight_id, user_id) VALUES ('$flight_id', '$user_id')";
	$result = mysqli_query($conn, $insert_query);

	if ($result) {
		// If the booking is successful, redirect to a success page
		header("Location: book-flight-success.php");
		exit();
	} else {
		// If there's an error with the booking, display an error message
		echo "Error: " . mysqli_error($conn);
	}
}
?>
