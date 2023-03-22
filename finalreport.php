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
  th, td {
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
        </ul>
        <!-- HTML code for the button -->
<button onclick="location.href='logout.php'">Logout</button>

        <!-- <a href="/logout.php" class="btn btn-secondary">logout</a> -->

      </nav>

    </div>
  </header>


  




<main>
  <article>
    <section class="section blog">
      <div class="container">   
        <h1> This is the Admin report!</h1>
        <?php
// Connect to the database
$conn = mysqli_connect("localhost:3307", "root", "", "testdb");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all bookings with user information and tour information
$sql = "SELECT bookings.id, users.username AS user_name, tours.place AS tour_name,tours.price as amount, bookings.booking_date
        FROM bookings
        JOIN users ON bookings.user_id = users.id
        JOIN tours ON bookings.tour_id = tours.id";



$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    die();
}

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Tour Name</th>
                    <th>Booking Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>";
    // Loop through each row and display the booking information
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["user_name"] . "</td>
                <td>" . $row["tour_name"] . "</td>
                <td>" . $row["booking_date"] . "</td>
                <td>" . $row["amount"] . "</td>
            </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No bookings found.";
}

// Close the database connection
mysqli_close($conn);
?>

              

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