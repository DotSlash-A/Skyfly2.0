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


  




  <form method="post" action="booktour.php">
		<label for="place">Place:</label>
		<select id="place" name="place" required>
			<option value="">Select a place</option>
			<?php
				// Include the database configuration file
				include 'config.php';

				// Create a connection to the database
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

				// Check if the connection is successful
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve the list of places from the newtours table
				$sql = "SELECT DISTINCT place FROM tours ORDER BY place ASC";
				$result = mysqli_query($conn, $sql);

				// Loop through the results and create a dropdown option for each place
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value=\"" . $row['place'] . "\">" . $row['place'] . "</option>";
				}

				// Close the database connection
				mysqli_close($conn);
			?>
		</select>

		<label for="tour_date">Tour Date:</label>
		<input type="date" id="tour_date" name="tour_date" required>

		<input type="submit" value="Search">
	</form>




      





      





