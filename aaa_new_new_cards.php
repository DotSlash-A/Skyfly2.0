<?php
session_start();

// Step 1: Establish a database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Step 2: Check if the Book Now button has been clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$tour_id = $_POST['tour_id'];
	$user_id = $_SESSION['user_id'];
	$booking_date = date('Y-m-d');
	$num_of_people = $_POST['num_of_people'];
	
	// Step 3: Insert a new booking into the bookings table
	$insert_query = "INSERT INTO bookings (user_id, tour_id, booking_date) VALUES ('$user_id', '$tour_id', '$booking_date')";
	mysqli_query($conn, $insert_query);
	$booking_id = mysqli_insert_id($conn);
	
	// Step 4: Insert the number of people into the numofppl table
	$num_of_people_query = "INSERT INTO numofppl (tour_id, num_of_people) VALUES ('$tour_id', '$num_of_people')";
	mysqli_query($conn, $num_of_people_query);
	$num_of_people_id = mysqli_insert_id($conn);
	
	// Step 5: Update the bookings table with the numofppl id
	$update_query = "UPDATE bookings SET numofppl_id = '$num_of_people_id' WHERE id = '$booking_id'";
	mysqli_query($conn, $update_query);
  
	// Step 6: Redirect the user to the payment page
	header("Location: newpaidalltours_confirm.php");
	exit();
}

// Step 7: Retrieve all tours available
$tours_query = "SELECT tours.id, tours.place, tours.price, tours.description, datetour.date 
                FROM tours 
                JOIN datetour ON tours.id = datetour.tour_id";
$tours_result = mysqli_query($conn, $tours_query);
?>

<!-- Step 8: Add a dropdown for the user to select the number of people -->
<h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
<h2>Tours Available:</h2>
<div class="card-container">
<?php while ($tour = mysqli_fetch_assoc($tours_result)): ?>
	<div class="card">
		<img src="pics\<?php echo $tour['id']; ?>.jpeg" alt="<?php echo $tour['place']; ?>">
		<div class="card-details">
			<h3><?php echo $tour['place']; ?></h3>
			<p><?php echo $tour['description']; ?></p>
			<div class="price">Price: <?php echo $tour['price']; ?></div>
			<div class="date">Available date: <?php echo $tour['date']; ?></div>
			<form method="POST">
				<input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
				<label for="num_of_people">Number of People:</label>
				<select name="num_of_people" id="num_of_people">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<button type="submit" class="btn btn-primary">Book Now</button>
			</form>
		</div>
	</div>
<?php endwhile;
