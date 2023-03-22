<html>
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
<style>
		input[type=text] {
			border: 1px solid black;
			padding: 8px;
		}
	
		input[type=number] {
			border: 1px solid black;
			padding: 8px;
		}
		input[type=date] {
			border: 1px solid black;
			padding: 8px;
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
	
	<h1>Tour Booking</h1>
	<main>
  <article>
    <section class="section blog">
	<div class="container">   
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

		<br>
		<label for="tour_date">Tour Date:</label>
		<input type="date" id="tour_date" name="tour_date" required min="2023-03-16" style="width: 30%;><br>

<input type="submit" value="Search"><br>	
		<input type="submit" class="btn btn-primary" value="Add Tour">	
</form>
</div>
</section>
</article>
</main>



























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

  <script src="../assets/js/script.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
</body>
</html>
