<?php
    // Include the database configuration file
    include 'config.php';

    // Create a connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

		$sql="SELECT tours.*, tourdate.date FROM tours INNER JOIN tourdate ON tours.Id = tourdate.tour_id WHERE tours.place = '".$_POST['place']."' AND tourdate.date = '".$_POST['tour_date']."'";
    $result = mysqli_query($conn, $sql);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$user_id = $_SESSION['user_id'];
			$tour_id = $_POST['tour_id'];
			$_SESSION['tour_id'] = $tour_id;
			$booking_date = "CURRENT_DATE()"; 
			$booking_query = "INSERT INTO bookings (user_id, tour_id,booking_date) VALUES ($user_id, $tour_id,$booking_date)";
			mysqli_query($conn, $booking_query);
			echo "Booking successful!";+
			header("Location: paymentpage.php");
			exit();
	}
		// Check if the form has been submitted
    
?>