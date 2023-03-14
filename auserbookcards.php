<?php
session_start();

// Step 1: Establish a database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Step 2: Retrieve all tours available
// $tours_query = "SELECT id, place, price, description FROM tours";
// $tours_result = mysqli_query($conn, $tours_query);
$tours_query = "SELECT tours.id, tours.place, tours.price, tours.description, tourdate.date 
                FROM tours 
                JOIN tourdate ON tours.id = tourdate.tour_id";
$tours_result = mysqli_query($conn, $tours_query);?>

<main>
  <article>
    <section class="section blog">
      <div class="container">   
      <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
      <h1>your id is , <?php echo $_SESSION['user_id']; ?>!</h1>
	<h2>Tours Available:</h2>
	<div class="card-container">
		<?php while ($tour = mysqli_fetch_assoc($tours_result)): ?>
			<div class="card">
        <!-- src="/pics/<?php echo $tour['id']; ?>.jpg" -->
        
				<img src="pics\<?php echo $tour['id']; ?>.jpeg" alt="<?php echo $tour['place']; ?>">
				<div class="card-details">
					<h3><?php echo $tour['place']; ?></h3>
					<p><?php echo $tour['description']; ?></p>
					<div class="price">Price: <?php echo $tour['price']; ?></div>
					<div class="date">Available date: <?php echo $tour['date']; ?></div>
					<form method="POST">
						<input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
						<button type="submit" class="btn btn-primary">Book Now</button>
					</form>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
  </article>
</main>
<style>
	.card-container {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
		gap: 20px;
	}
	
	.card {
		width: 300px;
		background-color: #fff;
		box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
		overflow: hidden;
	}
	
	.card img {
		width: 100%;
		height: 200px;
		object-fit: cover;
	}
	
	.card-details {
		padding: 20px;
	}
	
	.card-details h3 {
		font-size: 24px;
		margin-bottom: 10px;
	}
	
	.card-details p {
		font-size: 14px;
		margin-bottom: 10px;
	}
	
	.card-details .price {
		font-size: 16px;
		font-weight: bold;
		margin-bottom: 10px;
	}
	
	.card-details .date {
		font-size: 14px;
		margin-bottom: 10px;
	}
	
	.card-details form {
		display: flex;
		justify-content: flex-end;
	}
	
	.card-details form button {
		margin-left: 10px;
	}
</style> 

<?php
// Check if the book now button is clicked
if (isset($_POST['book_now'])) {
  // Retrieve the user_id from the session
  $user_id = $_SESSION['user_id'];
  // Retrieve the tour_id from the form
  $tour_id = $_POST['tour_id'];
  // Insert the booking record into the bookings table
  $booking_date = date("Y-m-d");
  $sql = "INSERT INTO bookings (user_id, tour_id, booking_date) VALUES ('$user_id', '$tour_id', '$booking_date')";
  if (mysqli_query($conn, $sql)) {
    echo "Booking successful";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
