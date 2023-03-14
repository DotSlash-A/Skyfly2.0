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
$tours_query = "SELECT tours.*, tourdate.date FROM tours INNER JOIN tourdate ON tours.Id = tourdate.tour_id WHERE tours.place = '".$_POST['place']."' AND tourdate.date = '".$_POST['tour_date']."'";
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
    echo "Booking successful!";+
    header("Location: paymentpage.php");
    exit();
}

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
<style>
  th,td{
    padding: 10px;
    border: 2px solid black;
    border-color: #00cccc;
  }
</style>
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
       

        
        <li>
            <a href="userfinalviewtable.php" class="navbar-link">My booked tours</a>
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
      <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
      <h1>your id is , <?php echo $_SESSION['user_id']; ?>!</h1>
	<h2>Tours Available:</h2>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Place</th>
				<th>Price</th>
				<th>Description</th>
				<th>Book</th>
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
  </article>
</main>




      





      





<!-- 
    - #FOOTER
  -->

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