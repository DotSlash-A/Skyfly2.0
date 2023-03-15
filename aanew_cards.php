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
$tours_query = "SELECT tours.id, tours.place, tours.price, tours.description, datetour.date 
                FROM tours 
                JOIN datetour ON tours.id = datetour.tour_id";
$tours_result = mysqli_query($conn, $tours_query);
?>

<main>
  <article>
	<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyFly - Explore the World</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Comforter+Brush&family=Heebo:wght@400;500;600;700&display=swap"
    rel="stylesheet">

</head>
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
            <a href="./myindex.html" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="./tours.html" class="navbar-link">Tours Home</a>
          </li>

          


          <li>
            <a href="/aboutus.html" class="navbar-link">About Us</a>
          </li>
        </ul>

        <a href="logout.php" class="btn btn-secondary">Logout</a>

      </nav>

    </div>
  </header>
    <section class="section blog">
      <div class="container">   
      
      <!-- <h1>Your ID is, <?php echo $_SESSION['user_id']; ?>!</h1> -->

  <h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
  <h2>Tours Available:</h2>
	<div class="card-container">
	<?if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }?>
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
						<button type="submit" class="btn btn-primary">Book Now</button>
					</form>
				</div>
			</div>
		<?php endwhile; ?>
  

	</div><br><br>
  <div style="text-align:center;">
  <a href="./newtours/auserdrop.php" class="btn btn-outline" style="display:block; width:50%; margin:0 auto;">Search for tours</a>
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
<footer class="footer" style="background-image: url('./assets/images/footer-bg.png')">
    <div class="container">

      <div class="footer-top">       

      </div>

      <div class="footer-bottom">

        <a href="#" class="logo">SkyFly</a>

        <p class="copyright">
          &copy; 2022 <a href="#" class="copyright-link">SkyFLy</a>. All Rights Reserved
        </p>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-google"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </div>
  </footer>






  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top aria-label="Go To Top">
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>

  <script src="./assets/js/script.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>