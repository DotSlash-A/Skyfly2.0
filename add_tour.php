<?php
// Establish a connection to the MySQL server
$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'testdb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement to insert the new tour
    $stmt = $conn->prepare("INSERT INTO tours (place, price, description) VALUES (:place, :price, :description)");
    $stmt->bindParam(':place', $_POST['place']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':description', $_POST['description']);
    $stmt->execute();

    echo "Tour added successfully.";
} catch(PDOException $e) {
    echo "Error adding tour: " . $e->getMessage();
}
?>
