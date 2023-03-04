<?php
// Establish database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch tour and card data for the logged-in user
session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT tours.tourname, tours.price, cards.cardnumber, cards.phonenumber, cards.name FROM tours INNER JOIN bookings ON tours.id = bookings.tour_id INNER JOIN cards ON bookings.card_id = cards.id WHERE bookings.user_id = $user_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $tourname = $row['tourname'];
    $price = $row['price'];
    $cardnumber = $row['cardnumber'];
    $phonenumber = $row['phonenumber'];
    $name = $row['name'];
} else {
    echo "No data found";
}

mysqli_close($conn);
?>

<!-- Display the fetched data and confirm payment button -->
<h1>Confirm Payment</h1>
<p>Tour Name: <?php echo $tourname; ?></p>
<p>Price: <?php echo $price; ?></p>
<p>Card Number: <?php echo $cardnumber; ?></p>
<p>Phone Number: <?php echo $phonenumber; ?></p>
<p>Name on Card: <?php echo $name; ?></p>
<button onclick="confirmPayment()">Confirm Payment</button>
