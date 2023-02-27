<?php
// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// prepare and execute SQL statement to check if user exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// check if user exists
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $usertype = $row["usertype"];

  // redirect to appropriate page based on user type
  if ($usertype == "admin") {
    header("Location: admindashboard.html");
  } else {
    header("Location: myindex.html");
  }
} else {
  // redirect back to login page if user does not exist
  header("Location: login.html");
}

// close database connection
$conn->close();
?>
