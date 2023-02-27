<!-- hotel booking form -->
<form action="" method="post">
  <label for="hotel_id">Select a hotel:</label>
  <select id="hotel_id" name="hotel_id">
    <option value="">--Please choose a hotel--</option>
    <?php
    // fetch hotels from the database and display them in the dropdown list
    require_once 'database_connection.php';
    $stmt = $pdo->prepare("SELECT id, hotel_name FROM hotels");
    $stmt->execute();
    $hotels = $stmt->fetchAll();
    foreach ($hotels as $hotel) {
        echo "<option value='" . $hotel['id'] . "'>" . $hotel['hotel_name'] . "</option>";
    }
    ?>
  </select>
  <br>
  <label for="check_in_date">Check-in date:</label>
  <input type="date" id="check_in_date" name="check_in_date">
  <br>
  <label for="check_out_date">Check-out date:</label>
  <input type="date" id="check_out_date" name="check_out_date">
  <br>
  <label for="num_rooms">Number of rooms:</label>
  <input type="number" id="num_rooms" name="num_rooms" min="1" max="10">
  <br>
  <button type="submit">Book Now</button>
</form>

<!-- process_booking.php -->
<?php
// check if the user is logged in and has usertype-user
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] !== 'user') {
    echo "You need to log in as a user to book a hotel.";
    exit();
}

// retrieve the booking details from the form
$user_id = $_SESSION['user_id'];
$hotel_id = $_POST['hotel_id'];
$check_in_date = $_POST['check_in_date'];
$check_out_date = $_POST['check_out_date'];
$num_rooms = $_POST['num_rooms'];

// calculate the total cost of the booking
require_once 'database_connection.php';
$stmt = $pdo->prepare("SELECT price_per_night FROM hotels WHERE id = ?");
$stmt->execute([$hotel_id]);
$price_per_night = $stmt->fetchColumn();
$num_nights = (strtotime($check_out_date) - strtotime($check_in_date)) / (60 * 60 * 24);
$total_cost = $num_rooms * $num_nights * $price_per_night;

// insert the booking details into the database
$stmt = $pdo->prepare("INSERT INTO bookings (user_id, hotel_id, check_in_date, check_out_date, num_rooms, total_cost) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$user_id, $hotel_id, $check_in_date, $check_out_date, $num_rooms, $total_cost]);
echo "Booking successful. Your total cost is $" . $total_cost . ".";
?>
