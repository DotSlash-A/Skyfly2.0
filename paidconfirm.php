<!DOCTYPE html>
<html>
<head>
	<title>Confirm Payment</title>
</head>
<body>
	<h1>Confirm Payment</h1>

	<?php
  $db_host = 'localhost:3307';
  $db_user = 'root';
  $db_pass = '';
  $db_name = 'testdb';
  
  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
		// Retrieve tour name and price from tours table
		$tour_id = $_GET['tour_id'];
		$user_id = $_SESSION['user_id'];
		$query = "SELECT name, price FROM tours WHERE id = '$tour_id' AND user_id = '$user_id'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$tour_name = $row['name'];
			$tour_price = $row['price'];

			// Retrieve card and user details from cards table
			$card_query = "SELECT cardnumber, phonenumber, name FROM cards WHERE userid = '$user_id'";
			$card_result = mysqli_query($conn, $card_query);

			if (mysqli_num_rows($card_result) > 0) {
				$card_row = mysqli_fetch_assoc($card_result);
				$card_number = $card_row['cardnumber'];
				$phone_number = $card_row['phonenumber'];
				$name_on_card = $card_row['name'];
			}

			// Display tour and card details
			echo "<p><strong>Tour Name:</strong> $tour_name</p>";
			echo "<p><strong>Price:</strong> $tour_price</p>";
			echo "<p><strong>Card Number:</strong> $card_number</p>";
			echo "<p><strong>Phone Number:</strong> $phone_number</p>";
			echo "<p><strong>Name on Card:</strong> $name_on_card</p>";
		}
	?>

	<button onclick="confirmPayment()">Confirm Payment</button>

	<script>
		function confirmPayment() {
			// Insert data into paid table upon successful payment
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					alert("Booking successful!");
				}
			};
			xmlhttp.open("GET", "insertpaid.php?tour_id=<?php echo $tour_id; ?>&user_id=<?php echo $user_id; ?>", true);
			xmlhttp.send();
		}
	</script>
</body>
</html>
