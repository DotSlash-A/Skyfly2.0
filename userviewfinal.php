

<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: final_login.html');
    exit();
}

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Connect to the database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare the SQL query with a join between the bookings and users tables
$sql = "SELECT bookings.id, bookings.booking_date, tours.place, users.username
        FROM bookings
        INNER JOIN tours ON bookings.tour_id = tours.id
        INNER JOIN users ON bookings.user_id = users.id
        WHERE bookings.user_id = $user_id";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query execution was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and display the booking details
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Booking ID: " . $row["id"] . "<br>";
        echo "Booking Date: " . $row["booking_date"] . "<br>";
        echo "Tour Name: " . $row["place"] . "<br>";
        echo "Username: " . $row["username"] . "<br><br>";
    }
} else {
    echo "No bookings found for the user.";
}

// Close the database connection
mysqli_close($conn);

?>


