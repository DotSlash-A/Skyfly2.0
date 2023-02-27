<?php
require_once 'database_connection.php'; // include the file with the database connection code

$sql = "CREATE TABLE hotelbookings (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    hotel_id INT(11) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_rooms INT(11) NOT NULL,
    total_cost DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
)";
$stmt = $pdo->prepare($sql);
$stmt->execute();
echo "table added successfully."
?>
