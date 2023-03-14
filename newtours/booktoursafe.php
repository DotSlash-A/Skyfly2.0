<?php
    // Include the database configuration file
    include 'config.php';

    // Create a connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

		$sql = "SELECT tours.id, tours.place, tours.price, tours.description, tourdate.date FROM tours INNER JOIN tourdate ON tours.Id = tourdate.tour_id WHERE tours.place = '".$_POST['place']."' AND tourdate.date = '".$_POST['tour_date']."'";
    $tours_result = mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn); 
?>
<html>
<head>
	<title>Tour Booking</title>
</head>
<body>
<section class="section blog">
      <div class="container">   
      
	<h2>Tours Available:</h2>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Place</th>
				<th>Price</th>
				<th>Description</th>
				<th>Book</th>
			</tr>
		</thead>
		<tbody>
			
			<?php while ($tour = mysqli_fetch_assoc($tours_result)): ?>
				<tr>
					<td><?php echo $tour['id']; ?></td>
					<td><?php echo $tour['place']; ?></td>
					<td><?php echo $tour['price']; ?></td>
					<td><?php echo $tour['description']; ?></td>
          <td><?php echo $tour['date']; ?></td>
					<td>
						<form action="booktableupdate.php" method="POST">
							<input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
							<button type="submit" class="btn btn-primary">Book</button>
						</form>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
			</body>
			</html>
			