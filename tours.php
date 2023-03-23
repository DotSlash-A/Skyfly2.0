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
  <link rel="stylesheet" href="./assets/css/tours.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Comforter+Brush&family=Heebo:wght@400;500;600;700&display=swap"
    rel="stylesheet">

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="myindex.html">
        <h1 class="logo">SkyFly</h1>
      </a>

      <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
        <ion-icon name="menu-outline" class="open"></ion-icon>
        <ion-icon name="close-outline" class="close"></ion-icon>
      </button>

      <nav class="navbar">

        <ul class="navbar-list">

          <li>
            <a href="./myindex.html" class="navbar-link">Home</a>
          </li>

          

          <!-- <li>
            <a href="#" class="navbar-link">Destinations</a>
          </li>
          
          <li>
            <a href="/hotels.html" class="navbar-link">Hotels</a>
          </li> -->

           <li>
            <a href="./aboutus.html" class="navbar-link">About Us</a>
          </li>

          

          

        </ul>

        <a href="final_login.html" class="btn btn-secondary">Booking Now</a>

      </nav>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero"
        style="background-image: url('./assets/images/hero-bg-bottom.png') url('./assets/images/hero-bg-top.png')">
        <div class="container">

          <img src="./assets/images/shape-1.png" width="61" height="61" alt="Vector Shape" class="shape shape-1">

          <img src="./assets/images/shape-2.png" width="56" height="74" alt="Vector Shape" class="shape shape-2">

          <img src="./assets/images/shape-3.png" width="57" height="72" alt="Vector Shape" class="shape shape-3">

          <div class="hero-content">

            <p class="section-subtitle">Explore Your Travel</p>

            <h2 class="hero-title">Trusted Travel Agency</h2>

            <p class="hero-text">
              I travel not to go anywhere, but to go. I travel for travel's sake the great affair is to move.
            </p>

            <div class="btn-group">
              <a href="./final_login.html" class="btn btn-primary">Book now!</a>

            
            </div>

          </div>
          
          <figure class="hero-banner">
            <img src="./assets/images/orange_Modern_vacation.png" width="686" height="812" loading="lazy" alt="hero banner"
              class="w-100">
          </figure>

        </div>
      </section>

      <section class="tour-search">
        <div class="container">

          <!-- <form  class="tour-search-form">

            <div class="input-wrapper">
              <label for="destination" class="input-label">Search Destination*</label>

              <input type="text" name="destination" id="destination" required placeholder="Enter Destination"
                class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="people" class="input-label">Max Number*</label>

              <input type="number" name="people" id="people" required placeholder="No.of People" class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkin" class="input-label" min="2023-28-02" required>Start date**</label>

              <input type="date" name="checkin" id="checkin" required class="input-field">
            </div>
          </form> -->
          <!-- <button class="btn btn-primary" onclick="location.href='final_login.html'">Book now</button> -->
          
            

            <div class="btn-group" style="text-align:center;">
            <a href="aanew_cards.php" class="btn btn-primary" style="display:block; width:50%; margin:0 auto;">view all tours</a>
            <a href="./newtours/auserdrop.php" class="btn btn-outline" style="display:block; width:50%; margin:0 auto;">Search for tours</a>
            </div>

          <!-- <input href="final_login.html" class="btn btn-primary" type="submit" value="Know More">
            <button type="submit" class="btn btn-primary">Enquire now</button>  -->
            <!-- <button class="btn btn-primary" onclick="location.href='final_login.html'">Book now</button>
        </div>
      </section>

      <main>
        <article>
          <section class="section blog">
            <div class="container">  
            <h1> available tours <h1> 
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
            //   echo '<form method="POST">';
						// 	echo '<input type="hidden" name="tour_id" value="'.$row['id'].'">';
						// 	echo '<button type="submit" class="btn btn-primary">Book</button>';
						// echo '</form>';
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
        - #POPULAR
      -->

    

        </div>
      </section>





     

      

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





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>