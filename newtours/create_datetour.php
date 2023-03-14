<?php
// Include the database configuration file
require_once('config.php');

try {
    // Create the tourdate table
    $sql = "CREATE TABLE tourdate (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                tour_id INT(11) NOT NULL,
                date DATE NOT NULL,
                FOREIGN KEY (tour_id) REFERENCES tours(Id)
            )";
    $conn->exec($sql);
    echo "Table tourdate created successfully.";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
