<?php
ini_set('display_errors', 1); error_reporting(E_ALL);
$db_host = 'localhost:3307';
$db_user = 'root';
$db_pass = '';
$db_name = 'testdb';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();


if(isset($_POST['paymentpage'])) {
    $tour_id = $_POST['tour_id'];
    $userid = $_SESSION['id'];
    
    $sql = "INSERT INTO paid (tourid, userid) VALUES ('$tour_id', '$userid')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql = "SELECT tours.name, tours.price, cards.cardnumber, cards.phonenumber, cards.name 
                FROM tours 
                INNER JOIN cards ON tours.userid = cards.userid 
                WHERE tours.id = '$tour_id' AND cards.userid = '$userid'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            // display the information and confirmation button
            echo "<h2>Confirm Payment</h2>";
            echo "<p>Tour Name: ".$row['name']."</p>";
            echo "<p>Price: ".$row['price']."</p>";
            echo "<p>Card Number: ".$row['cardnumber']."</p>";
            echo "<p>Phone Number: ".$row['phonenumber']."</p>";
            echo "<p>Name on Card: ".$row['name']."</p>";
            echo "<form action='' method='POST'>";
            echo "<input type='submit' name='paymentconfirmed' value='Confirm Payment'>";
            echo "</form>";
        } else {
            echo "No matching records found.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_POST['paymentconfirmed'])) {
    $tour_id = $_POST['tour_id'];
    $userid = $_SESSION['id'];
    
    $sql = "INSERT INTO paid (tourid, userid) VALUES ('$tour_id', '$userid')";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        // display the success message in a popup
        echo "<script>alert('Booking Successful!')</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
