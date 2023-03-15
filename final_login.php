

<?php
// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the values from the form
  $username = $_POST["username"];
  $password = $_POST["password"];
  $usertype = $_POST["usertype"];

  // Connect to the database
  $servername = "localhost:3307";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "testdb";
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL statement to select the user with the given username and password
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if the user exists and has the correct user type
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $user_id = $row["id"];
    if ($row["usertype"] == "admin" && $usertype == "admin") {
      // The user is an admin, so redirect to the admin dashboard
      $_SESSION["username"] = $username;
      $_SESSION['user_id'] = $user['id'];
      header("Location: admin_dashboard_del.php");
      exit();
    } elseif ($row["usertype"] == "user" && $usertype == "user") {
      // The user is a regular user, so redirect to the user dashboard
      $_SESSION["username"] = $username;
      $_SESSION['user_id'] = $user_id;
      header("Location: tours.php");
      exit();
    }
  }

  // If the user doesn't exist or has the wrong user type, show an error message
  echo "Invalid username or password for the selected user type.";
  echo '<br><br>';
  echo "<td><form method='post' action='admin_add.html'><input class='btn btn-primary' type='submit' value='add'></form></td>";
  echo '<input href class="btn btn-primary" type="submit" value="retry">';
}

?>