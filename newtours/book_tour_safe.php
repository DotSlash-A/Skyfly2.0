<?php error_reporting (E_ALL ^ E_NOTICE); ?> 

<?php error_reporting(0); ?> 


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
	
	
	// Step 3: Insert a new booking into the bookings table
	$insert_query = "INSERT INTO bookings (user_id, tour_id, booking_date) VALUES ('$user_id', '$tour_id', '$booking_date')";
	mysqli_query($conn, $insert_query);
}

// Step 4: Retrieve all tours available
$sql = "SELECT tours.id, tours.place, tours.price, tours.description, datetour.date FROM tours INNER JOIN datetour ON tours.Id = datetour.tour_id WHERE tours.place = '".$_POST['place']."' AND datetour.date = '".$_POST['tour_date']."'";
$tours_result = mysqli_query($conn, $sql);
	// Step 6: Redirect the user to the payment page


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyFly - Explore the World</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Comforter+Brush&family=Heebo:wght@400;500;600;700&display=swap"
    rel="stylesheet">

</head>
<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="#">
        <h1 class="logo">SkyFly</h1>
      </a>

      <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
        <ion-icon name="menu-outline" class="open"></ion-icon>
        <ion-icon name="close-outline" class="close"></ion-icon>
      </button>

      <nav class="navbar">

        <ul class="navbar-list">

          <li>
            <a href="#" class="navbar-link">Destinations</a>
          </li>

          <li>
            <a href="/tours.html" class="navbar-link">Tours</a>
          </li>

          <li>
            <a href="/hotels.html" class="navbar-link">Hotels</a>
          </li>


          <li>
            <a href="/aboutus.html" class="navbar-link">About Us</a>
          </li>
        </ul>

        <a href="#" class="btn btn-secondary">Booking Now</a>

      </nav>

    </div>
  </header>
<main>
  <article>
    <section class="section blog">
      <div class="container">   
      <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
     
	<h2>Tours Available:</h2>
	<div class="card-container">
		<?php while ($tour = mysqli_fetch_assoc($tours_result)): ?>
			<div class="card">
			<img src="\abc\pics\<?php echo $tour['id']; ?>.jpg" alt="<?php echo $tour['place']; ?>">
			
				<div class="card-details">
					<h3><?php echo $tour['place']; ?></h3>
					<p><?php echo $tour['description']; ?></p>
					<div class="price">Price: <?php echo $tour['price']; ?></div>
					<div class="date">Available date: <?php echo $tour['date']; ?></div>
					<form method="POST">
						<input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
						<label for="num_of_people">Number of People:</label>
            <select id="num_of_people" name="num_of_people">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
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
  color: #888;
  }
  .btn {
	padding: 10px 20px;
	background-color: #008CBA;
	color: #fff;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	transition: background-color 0.3s ease;
}

.btn:hover {
	background-color: #005f84;
}
</style>
<?php mysqli_close($conn); ?>