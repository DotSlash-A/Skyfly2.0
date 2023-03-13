<?php
// Include the database configuration file
require_once('config.php');

try {
    // Update any rows with an invalid date value
    $sql = "UPDATE tours SET date = NULL WHERE date = '0000-00-00'";
    $conn->exec($sql);
    echo "Updated rows with invalid date value.";

    // Add a new column named "date" to the tours table
    $sql = "ALTER TABLE tours ADD COLUMN date DATE NOT NULL";
    $conn->exec($sql);
    echo "New column added successfully.";
} catch(PDOException $e) {
    echo "Error adding new column: " . $e->getMessage();
}
?>
