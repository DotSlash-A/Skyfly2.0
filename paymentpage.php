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

<body id="top">
<style>
	input[type=text] {
		border: 1px solid black;
		padding: 8px;
	}

	input[type=password] {
		border: 1px solid black;
		padding: 8px;
	}
</style>
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
        </ul>

        <a href="#" class="btn btn-secondary">Booking Now</a>

      </nav>

    </div>
  </header>


  




<main>
  <article>
    <section class="section blog">
      <div class="container">   
        <body>
          <h1>Booking Page</h1>
          <!-- <form action="paymentprocess1.php" method="POST">
  <label for="cardnumber">Credit/Debit Card Number:</label>
  <input type="text" id="cardnumber" name="cardnumber" required style="width:30%;">
  <br>
  <label for="year">Expiration Year:</label>
  <input type="text" id="year" name="year" required style="width:30%;">
  <br>
  <label for="name">Name on Card:</label>
  <input type="text" id="name" name="name" required style="width:30%;">
  <br>
  <label for="phonenumber">Phone Number:</label>
  <input type="text" id="phonenumber" name="phonenumber" required style="width:30%;">
  <br>
  <input class="btn btn-primary" type="submit" value="Pay">
</form> -->
<form action="paymentprocess1.php" method="POST">
  <label for="cardnumber">Credit/Debit Card Number (16 digits):</label>
  <input type="text" id="cardnumber" name="cardnumber" pattern="[0-9]{16}" required style="width:30%;">
  <br>
  <label for="year">Expiration Year:</label>
  <select id="year" name="year" required style="width:30%;">
    <option value="" selected disabled>Select year</option>
    <?php
      $current_year = date('Y');
      for($i = $current_year; $i <= $current_year + 10; $i++) {
        echo "<option value='$i'>$i</option>";
      }
    ?>
  </select>
  <br>
  <label for="name">Name on Card:</label>
  <input type="text" id="name" name="name" required style="width:30%;">
  <br>
  <label for="phonenumber">Phone Number (10 digits):</label>
  <input type="text" id="phonenumber" name="phonenumber" pattern="[0-9]{10}" required style="width:30%;">
  <br>
  <input class="btn btn-primary" type="submit" value="Pay">
</form>


        </body>
        </html>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $cardnumber = $_POST["cardnumber"];
          $year = $_POST["year"];
          $name = $_POST["name"];
          $phonenumber = $_POST["phonenumber"];
          
          // Here you would process the payment using the information provided
          
          // After processing the payment, you could redirect the user to a confirmation page
          header("Location: confirmation_page.php");
          exit;
        }
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