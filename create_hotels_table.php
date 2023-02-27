
<?php
// Establish a connection to the MySQL server
$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'testdb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the tours table
    $sql = "CREATE TABLE hotels (
        id INT(11) NOT NULL AUTO_INCREMENT,
        hotel_name VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        price_per_night DECIMAL(10,2) NOT NULL,
        total_rooms INT(11) NOT NULL,
        PRIMARY KEY (id)
    )";
    $conn->exec($sql);
    echo "Table tours created successfully.";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>