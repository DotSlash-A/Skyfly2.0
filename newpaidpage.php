<?php
// Start session
session_start();

// Connect to database
$host = "localhost:3307";
$user = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get tour information
$tour_id = $_GET['tour_id'];
$sql = "SELECT name, price FROM tours WHERE id = $tour_id";
$result = mysqli_query($conn, $sql);
$tour = mysqli_fetch_assoc($result);

// Get card information
$user_id = $_SESSION['user_id'];
$sql = "SELECT cardnumber, phonenumber, name FROM cards WHERE userid = $user_id";
$result = mysqli_query($conn, $sql);
$card = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Payment</title>
</head>
<body>
    <h1>Confirm Payment</h1>

    <p>Tour Name: <?php echo $tour['name']; ?></p>
    <p>Price: <?php echo $tour['price']; ?></p>

    <p>Card Number: <?php echo $card['cardnumber']; ?></p>
    <p>Phone Number: <?php echo $card['phonenumber']; ?></p>
    <p>Name on Card: <?php echo $card['name']; ?></p>

    <button onclick="confirmPayment()">Confirm Payment</button>

    <script>
        function confirmPayment() {
            // Show popup that booking is successful
            alert("Booking is successful!");

            // Redirect to paidconfirm.php and insert userid and tourid to paid table
            window.location.href = "paidconfirm.php?user_id=<?php echo $user_id; ?>&tour_id=<?php echo $tour_id; ?>";
        }
    </script>
</body>
</html>
