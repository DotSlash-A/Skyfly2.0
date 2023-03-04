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

if(isset($_SESSION['userid']) && isset($_SESSION['tour_id'])) {
  $userid = $_SESSION['user_id'];
  $tour_id = $_SESSION['tour_id'];
  
  // Retrieve tour information
  $tour_query = "SELECT name, price FROM tours WHERE id = $tour_id";
  $tour_result = mysqli_query($conn, $tour_query);

  if(mysqli_num_rows($tour_result) > 0) {
    $tour_row = mysqli_fetch_assoc($tour_result);
    $tour_name = $tour_row['name'];
    $tour_price = $tour_row['price'];

    // Retrieve card information
    $card_query = "SELECT cardnumber, phonenumber, name FROM cards WHERE userid = $userid";
    $card_result = mysqli_query($conn, $card_query);

    if(mysqli_num_rows($card_result) > 0) {
      $card_row = mysqli_fetch_assoc($card_result);
      $card_number = $card_row['cardnumber'];
      $phone_number = $card_row['phonenumber'];
      $name_on_card = $card_row['name'];
?>

<html>
<head>
  <title>Confirm Payment</title>
</head>
<body>
  <h2>Confirm Payment</h2>
  <p><b>Tour Name:</b> <?php echo $tour_name; ?></p>
  <p><b>Price:</b> <?php echo $tour_price; ?></p>
  <p><b>Card Number:</b> <?php echo $card_number; ?></p>
  <p><b>Phone Number:</b> <?php echo $phone_number; ?></p>
  <p><b>Name on Card:</b> <?php echo $name_on_card; ?></p>
  <button onclick="alert('Booking Successful!')">Confirm Payment</button>
</body>
</html>

<?php
    } else {
      echo "Error: No card information found for user.";
    }
  } else {
    echo "Error: Tour information not found.";
  }
} else {
  echo "Error: User or tour ID not set.";
}
?>
