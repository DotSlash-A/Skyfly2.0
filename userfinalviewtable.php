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

        <a href="#" class="btn btn-secondary">Booking Now</a>

      </nav>

    </div>
  </header>


  




<main>
  <article>
    <section class="section blog">
      <div class="container">   
        

      <?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: final_login.html');
    exit();
}

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Connect to the database
$servername = "localhost:3307";
$username = "root";
$password = ""; 
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT bookings.id, bookings.booking_date, tours.place, tours.price, users.username
        FROM bookings
        INNER JOIN tours ON bookings.tour_id = tours.id
        INNER JOIN users ON bookings.user_id = users.id
        WHERE bookings.user_id = $user_id";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query execution was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Initialize total price variable to 0
$total_price = 0;

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start the table
    echo "<table>";
    echo "<tr><th>Booking ID</th><th>Booking Date</th><th>Tour Name</th><th>Tour Price</th><th>Username</th></tr>";

    // Loop through each row and display the booking details in table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["booking_date"] . "</td>";
        echo "<td>" . $row["place"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "</tr>";
        
        // Add the tour price to the total price variable
        $total_price += $row["price"];
    }

    // Display the total price after all the tours
    echo "<tr><td colspan='3'></td><td>Total Price:</td><td>$total_price</td></tr>";

    // End the table
    echo "</table>";
} else {
    echo "No bookings found for the user.";
}

// Close the database connection
mysqli_close($conn);
?>
