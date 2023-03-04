<?php
session_start();
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// if(isset($_SESSION['userid'])) {
  $userid = $_SESSION['user_id'];
  
  
  // Retrieve booked tours information
  $booked_tours_query = "SELECT tours.name, tours.price, cards.cardnumber, cards.phonenumber, cards.name as cardholder FROM paid INNER JOIN tours ON paid.tour_id = tours.id INNER JOIN cards ON paid.card_id = cards.id WHERE paid.user_id = $userid";
  $booked_tours_result = mysqli_query($conn, $booked_tours_query);

  $booked_tours_result = mysqli_query($conn, $booked_tours_query);

if($booked_tours_result !== false && mysqli_num_rows($booked_tours_result) > 0) {
    // Display booked tours
} else {
    echo "No booked tours found for user.";
}

  // if(mysqli_num_rows($booked_tours_result) > 0) {
?>

<html>
<head>
  <title>Booked Tours</title>
</head>
<body>
  <h2>Booked Tours</h2>
  <table>
    <tr>
      <th>Tour Name</th>
      <th>Price</th>
      <th>Card Number</th>
      <th>Phone Number</th>
      <th>Name on Card</th>
    </tr>
    <?php while($booked_tours_row = mysqli_fetch_assoc($booked_tours_result)) { ?>
    <tr>
      <td><?php echo $booked_tours_row['name']; ?></td>
      <td><?php echo $booked_tours_row['price']; ?></td>
      <td><?php echo $booked_tours_row['cardnumber']; ?></td>
      <td><?php echo $booked_tours_row['phonenumber']; ?></td>
      <td><?php echo $booked_tours_row['cardholder']; ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>

