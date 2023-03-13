<?php
session_start();

// Step 1: Establish a database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Step 2: Retrieve all tours available
$tours_query = "SELECT tours.id, tours.place, tours.price, tours.description, tourdate.date 
                FROM tours 
                JOIN tourdate ON tours.id = tourdate.tour_id";
$tours_result = mysqli_query($conn, $tours_query);

// Step 5: Check user authentication
// if ($_SESSION['usertype'] != 'user') {
//     echo "Only users can book tours";
//     exit();
// }
// $_SESSION['user_id']=1;

// Step 6: Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $tour_id = $_POST['tour_id'];
    $_SESSION['tour_id'] = $tour_id;
    $booking_date = "CURRENT_DATE()"; 
    $booking_query = "INSERT INTO bookings (user_id, tour_id,booking_date) VALUES ($user_id, $tour_id,$booking_date)";
    mysqli_query($conn, $booking_query);
    echo "Booking successful!";
    header("Location: paymentpage.php");
    exit();
}
?>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Place</th>
			<th>Price</th>
			<th>Description</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($tour = mysqli_fetch_assoc($tours_result)): ?>
			<tr>
				<td><?php echo $tour['id']; ?></td>
				<td><?php echo $tour['place']; ?></td>
				<td><?php echo $tour['price']; ?></td>
				<td><?php echo $tour['description']; ?></td>
				<td><?php echo $tour['date']; ?></td>
				<td>
					<form method="POST">
						<input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
						<button type="submit" class="btn btn-primary">Book</button>
					</form>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
