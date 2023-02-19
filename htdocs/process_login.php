<?php
session_start();
if(isset($_POST['submit'])) {
	//connect to database
	$servername = "localhost:3306";
	$username = "root";
	$password = "";
	
	$dbname = "skyflydb";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	//check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	//get input from form
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//query database for user
	$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn, $query);

	//check for errors
	if (!$result) {
		die("Query failed: " . mysqli_error($conn));
	}

	//check if user exists
	if(mysqli_num_rows($result) == 1) {
		//set session variable and redirect to home page
		$_SESSION['username'] = $username;
		header('Location: "E:\github\Skyfly2.0\index.html"');
	} else {
		//display error message and redirect to login page
		echo "Invalid username or password";
		header('Location: login.php');
	}

	mysqli_close($conn);
}
?>
