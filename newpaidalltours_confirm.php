

<!DOCTYPE html>
<html>
<head>
	<title>My Bookings</title>
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
<body>
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
<!-- <h2>Welcome <?php echo $_SESSION['username']; ?>!</h2> -->
	
  <div class="container">
  <h1>My Bookings</h1>
	<table>
		<tr>
			<th>Tour</th>
			<th>Date</th>
			<th>Price</th>
      <th>num_of_people</th>
      <th>total_price</th>
      <th>cancel</th>
		</tr>

		<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   
    session_start();
		// Establish a connection to the MySQL server
		$host = 'localhost:3307';
		$username = 'root';
		$password = '';
		$dbname = 'testdb';

		try {
		    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    // Prepare and execute the SQL statement to retrieve the user's bookings
		    // $stmt = $conn->prepare("SELECT tours.place, datetour.date, tours.price FROM bookings JOIN tours ON bookings.tour_id = tours.Id JOIN datetour ON bookings.tour_id = datetour.tour_id WHERE bookings.user_id = :user_id");
		    // $stmt->bindParam(':user_id', $_SESSION['user_id']);
		    // $stmt->execute();

		    // // Fetch the results and display them in the table
		    // while ($row = $stmt->fetch()) {
		    // 	echo "<tr>";
		    // 	echo "<td>".$row['place']."</td>";
		    // 	echo "<td>".$row['date']."</td>";
		    // 	echo "<td>".$row['price']."</td>";
		    // 	echo "</tr>";
		    // }
        $stmt = $conn->prepare("SELECT bookings.id, tours.place, datetour.date, tours.price, numofppl.num_of_people 
        FROM bookings 
        JOIN tours ON bookings.tour_id = tours.id 
        JOIN datetour ON bookings.tour_id = datetour.tour_id 
        JOIN numofppl ON bookings.tour_id = numofppl.tour_id
        WHERE bookings.user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();

// Fetch the results and display them in the table
while ($row = $stmt->fetch()) {
echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['place']."</td>";
echo "<td>".$row['date']."</td>";
echo "<td>".$row['price']."</td>";
echo "<td>".$row['num_of_people']."</td>";
echo "<td>".$row['num_of_people']*$row['price']."</td>";
echo "<td><form method='post' action='delete_booking.php'><input type='hidden' name='booking_id' value='".$row['id']."'><input class='btn btn-primary' type='submit' value='Delete'></form></td>";

      }
    ?>
  </tbody>
</table>
    
<?php

		} catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}

		// $conn = null;
		?>
	</table>
  <div class="btn-group" style="text-align:center;">
            <a href="aanew_cards.php" class="btn btn-primary" style="display:block; width:30%; margin:0 auto;">view all tours</a>

            </div>
</div>
</body>
</html>

