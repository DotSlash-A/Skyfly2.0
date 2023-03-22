<?php
// Establish database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the booking to be deleted
$id = $_POST['booking_id'];

// Delete the record from the numofppl table that references the booking to be deleted
$sql = "DELETE FROM numofppl WHERE tour_id=(SELECT tour_id FROM bookings WHERE id=".$id.")";
if ($conn->query($sql) === TRUE) {
    // Delete the record from the bookings table
    $sql = "DELETE FROM bookings WHERE id=".$id;
    if ($conn->query($sql) === TRUE) {
        // Get the ID of the tour to be deleted
        $result = mysqli_query($conn, "SELECT tour_id FROM bookings WHERE id=".$id);
        if ($result && mysqli_num_rows($result) > 0) {
            $tour_id = mysqli_fetch_assoc($result)['tour_id'];
            // Delete the record from the tours table
            $sql = "DELETE FROM tours WHERE id=".$tour_id;
            if ($conn->query($sql) === TRUE) {
                // Redirect to index.php with success message
                header("Location: index.php?delete=success");
            } else {
                echo "Error deleting tour: " . $conn->error;
            }
        } else {
            // echo"Error getting tour_id: " . $conn->error;
            header("Location: newpaidalltours_confirm.php?delete=success");
           
        }
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
} else {
    echo "Error deleting numofppl record: " . $conn->error;
}

// Close database connection
$conn->close();
?>
