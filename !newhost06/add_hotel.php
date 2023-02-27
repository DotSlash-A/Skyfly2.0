<?php
// include the file with the database connection code
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'testdb';
try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // get the form data
  $hotel_name = $_POST['hotel_name'];
  $location = $_POST['location'];
  $description = $_POST['description'];
  $price_per_night = $_POST['price_per_night'];

  // insert the hotel information into the database
  $sql = "INSERT INTO hotels (hotel_name, location, description, price_per_night) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  $stmt->execute([$hotel_name, $location, $description, $price_per_night]);

  echo "hotel added successfully.";
// redirect the user to a confirmation page
// header('Location: confirmation_page.php');
} catch(PDOException $e) {
  echo "Error adding hotel: " . $e->getMessage();
}
?>
