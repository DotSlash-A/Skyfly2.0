<?php
// Start the session
session_start();

// Include the database connection file
// include_once 'config.php';
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Retrieve all tours from the tours table
$sql = "SELECT * FROM tours";
$result = mysqli_query($conn, $sql);

// Check if tours exist in the tours table
if (mysqli_num_rows($result) > 0) {
  // Display each tour as a card with a book now button
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='tour-card'>";
    echo "<h2>".$row['place']."</h2>";
    echo "<p>".$row['description']."</p>";
    echo "<p>Price: ".$row['price']."</p>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='tour_id' value='".$row['Id']."'>";
    echo "<button type='submit' name='book_now'>Book Now</button>";
    echo "</form>";
    echo "</div>";
  }
}

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
