<?php
// Get the flight ID from the query string
$flight_id = $_GET['id'];

// Connect to the database
$conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

// Get the flight details from the database
$sql = "SELECT * FROM flights WHERE id = $flight_id";
$result = mysqli_query($conn, $sql);
$flight = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the new price from the form data
  $new_price = $_POST['price'];

  // Update the flight price in the database
  $sql = "UPDATE flights SET price = $new_price WHERE id = $flight_id";
  mysqli_query($conn, $sql);

  // Redirect to the flight details page
  header("Location: flightdetails.php?id=$flight_id");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Flight</title>
</head>
<body>
  <h1>Edit Flight</h1>

  <form method="post">
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="<?php echo $flight['price']; ?>">
    <input type="submit" name="submit" value="Save">
  </form>

  <hr>

  <h2>Flight Details</h2>

  <table>
    <tbody>
      <tr>
        <td>Airline:</td>
        <td><?php echo $flight['airline']; ?></td>
      </tr>
      <tr>
        <td>Flight Number:</td>
        <td><?php echo $flight['flight_number']; ?></td>
      </tr>
      <tr>
        <td>Origin:</td>
        <td><?php echo $flight['origin']; ?></td>
      </tr>
      <tr>
        <td>Destination:</td>
        <td><?php echo $flight['destination']; ?></td>
      </tr>
      <tr>
        <td>Departure Date:</td>
        <td><?php echo $flight['departure_date']; ?></td>
      </tr>
      <tr>
        <td>Departure Time:</td>
        <td><?php echo $flight['departure_time']; ?></td>
      </tr>
      <tr>
        <td>Price:</td>
        <td>
          <span style="background-color: #eee; padding: 3px;"><?php echo $flight['price']; ?></span>
        </td>
      </tr>
    </tbody>
  </table>

  <p><a href="flightdetails.php?id=<?php echo $flight_id; ?>">Back to Flight Details</a></p>

  <script>
    // Disable all input fields except the price field
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input:not([name="price"])');
    inputs.forEach(input => input.disabled = true);
  </script>
</body>
</html>
