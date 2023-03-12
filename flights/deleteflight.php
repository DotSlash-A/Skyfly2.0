<?php
// Start session
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['is_admin'] !== '1') {
    header("Location: login.php");
    exit();
}

// Include database connection
include_once "db_conn.php";

// Check if flight id is set
if (!isset($_GET['id'])) {
    header("Location: flights.php");
    exit();
}

$flight_id = $_GET['id'];

// Get flight details
$sql = "SELECT * FROM flights WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $flight_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if flight exists
if (mysqli_num_rows($result) == 0) {
    header("Location: flights.php");
    exit();
}

$flight = mysqli_fetch_assoc($result);

// Check if delete form is submitted
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM flights WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $flight_id);
    mysqli_stmt_execute($stmt);

    header("Location: flights.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Flight</title>
</head>
<body>
	<h1>Delete Flight</h1>
	<p>Are you sure you want to delete the following flight?</p>
	<table>
		<tr>
			<th>Airline</th>
			<td><?php echo $flight['airline']; ?></td>
		</tr>
		<tr>
			<th>Flight Number</th>
			<td><?php echo $flight['flight_number']; ?></td>
		</tr>
		<tr>
			<th>Origin</th>
			<td><?php echo $flight['origin']; ?></td>
		</tr>
		<tr>
			<th>Destination</th>
			<td><?php echo $flight['destination']; ?></td>
		</tr>
		<tr>
			<th>Departure Date</th>
			<td><?php echo $flight['departure_date']; ?></td>
		</tr>
		<tr>
			<th>Departure Time</th>
			<td><?php echo $flight['departure_time']; ?></td>
		</tr>
		<tr>
			<th>Price</th>
			<td><?php echo $flight['price']; ?></td>
		</tr>
	</table>
	<form method="POST">
		<input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
		<button type="submit" name="delete">Delete</button>
	</form>
</body>
</html>
