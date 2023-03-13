<?php
// Establish a connection to the MySQL server
$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'testdb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement to insert the new tour into the tours table
    $stmt = $conn->prepare("INSERT INTO tours (place, price, description) VALUES (:place, :price, :description)");
    $stmt->bindParam(':place', $_POST['place']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':description', $_POST['description']);
    $stmt->execute();

    // Get the auto-generated Id of the newly inserted tour
    $tour_id = $conn->lastInsertId();

    // Prepare and execute the SQL statement to insert the tour date into the tourdate table
    $stmt = $conn->prepare("INSERT INTO tourdate (tour_id, date) VALUES (:tour_id, :date)");
    $stmt->bindParam(':tour_id', $tour_id);
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->execute();

    echo "Tour added successfully.";
} catch(PDOException $e) {
    echo "Error adding tour: " . $e->getMessage();
}
?>
