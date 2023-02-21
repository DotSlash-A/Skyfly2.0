<!DOCTYPE html>
<html>
<head>
    <title>View Tours</title>
</head>
<body>
    <h1>View Tours</h1>

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

    // If a tour has been deleted, show a success message
    if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
        echo "<p>Tour has been deleted successfully.</p>";
    }

    // Select all tours from the tours table
    $sql = "SELECT * FROM tours";
    $result = $conn->query($sql);

    // Display all tours in a table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Place</th><th>Price</th><th>Description</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['Id']."</td>";
            echo "<td>".$row['place']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "<td><form method='post' action='trydelete_tour.php'><input type='hidden' name='id' value='".$row['Id']."'><input type='submit' value='Delete'></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No tours found.";
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
