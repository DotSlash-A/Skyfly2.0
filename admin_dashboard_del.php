<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyFly - Explore the World</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Comforter+Brush&family=Heebo:wght@400;500;600;700&display=swap"
    rel="stylesheet">

</head>

  <style>
  th, td {
  padding: 10px;
  border: 2px solid black;
  border-color: #00cccc;
}

  </style>
  
<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="#">
        <h1 class="logo">SkyFly</h1>
      </a>

      <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
        <ion-icon name="menu-outline" class="open"></ion-icon>
        <ion-icon name="close-outline" class="close"></ion-icon>
      </button>

      <nav class="navbar">

        <ul class="navbar-list">

          <li>
            <a href="#" class="navbar-link">Destinations</a>
          </li>

          <li>
            <a href="/tours.html" class="navbar-link">Tours</a>
          </li>

          <li>
            <a href="/hotels.html" class="navbar-link">Hotels</a>
          </li>


          <li>
            <a href="/aboutus.html" class="navbar-link">About Us</a>
          </li>
          <li>
            <a href="finalreport  .php" class="navbar-link">report</a>
          </li>
        </ul>
        <a href="logout.php" class="btn btn-secondary">logout</a> &nbsp;&nbsp;

        <form method='post' action='logout.php'><input type='hidden' name='id' value='".$row['Id']."'><input class='btn btn-secondary' type='submit' value='Delete'></form>

      </nav>

    </div>
  </header>


  




<main>
  <article>
    <section class="section blog">
      <div class="container">   
        
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
            echo "<td><form method='post' action='admin_delete_tour.php'><input type='hidden' name='id' value='".$row['Id']."'><input class='btn btn-primary' type='submit' value='Delete'></form></td>";
            echo "<td><form method='post' action='admin_add.html'><input class='btn btn-primary' type='submit' value='Add'></form></td>";
           echo "<td><form method='post' action='admin_update.html'><input class='btn btn-primary' type='submit' value='Update'></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No tours found.";
    }

    // Close database connection
    $conn->close();
    ?>

  </article>
</main>

<main>
  <article>
    <section class="section blog">
      <div class="container">   
      <?php
// Connect to database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query tours table
$sql = "SELECT * FROM tours";
$result = $conn->query($sql);

// Generate HTML cards for each tour
if ($result->num_rows > 0) {
    echo '<ul class="popular-list">';
    while($row = $result->fetch_assoc()) {
        echo '<li>';
        echo '<div class="popular-card">';
        echo '<figure class="card-banner">';
        echo '<a href="#">';
        echo '<img src="./assets/images/popular-1.jpg" width="740" height="518" loading="lazy" alt="'.$row["place"].'" class="img-cover">';
        echo '</a>';
        echo '</figure>';
        echo '<div class="card-content">';
        echo '<div class="card-wrapper">';
        echo '<div class="card-price">From $'.$row["price"].'</div>';
        echo '</div>';
        echo '<h3 class="card-title">';
        echo '<a href="#">'.$row["place"].'</a>';
        echo '</h3>';
        echo '<p class="card-description">'.$row["description"].'</p>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo "No tours available.";
}

// Close database connection
$conn->close();
?>

              

  </article>
</main>



      





      





<!-- 
    - #FOOTER
  -->

  <footer class="footer" style="background-image: url('./assets/images/footer-bg.png')">
    <div class="container">

      <div class="footer-top">       

      </div>

      <div class="footer-bottom">

        <a href="#" class="logo">SkyFly</a>

        <p class="copyright">
          &copy; 2022 <a href="#" class="copyright-link">SkyFLy</a>. All Rights Reserved
        </p>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-google"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </div>
  </footer>






  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top aria-label="Go To Top">
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>

  <script src="./assets/js/script.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
