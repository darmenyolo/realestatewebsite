<?php
$host = 'localhost';
$db = 'realestate';
$user = 'root';
$password = '';

$conn =  mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " .  mysqli_connect_error());
}

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    // User is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}
$username = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];

// Retrieve user's bookings from the database
$sql = "SELECT * FROM book WHERE user_id = '$userId'";
$result = mysqli_query($conn, $sql);
$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Process cancel booking action
if (isset($_GET['cancel_id'])) {
    $bookingId = $_GET['cancel_id'];

    // Delete booking from the database
    $sql = "DELETE FROM book WHERE book_id='$bookingId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Booking canceled!";
        // Redirect to my_bookings.php after cancellation
        header("Location: my_bookings.php");
        exit();
    } else {
        echo "Failed to cancel booking. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings Page</title>
    <style>
         body{
    margin: 0;
    padding: 0;
    height: 150vh;
     justify-content: center;
     align-items: center;
    background-image: linear-gradient( 359.8deg,  rgba(252,255,222,1) 2.2%, rgba(182,241,171,1) 99.3% );

}

.intro-content{
   font-size: 20px;         
   font-family: verdana;        
  text-align: center;      
  color: black;       
}

        .booking-card {
            width: 300px;
            padding: 20px;
            margin: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .booking-card h3 {
            margin-bottom: 10px;
        }

        .booking-card p {
            margin-bottom: 10px;
        }

        .booking-card .booking-status {
            font-weight: bold;
        }

        .booking-card .action-buttons {
            margin-top: 20px;
        }

        .booking-card .action-buttons button {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 14px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .booking-card .action-buttons button:last-child {
            margin-right: 0;
        }

        .booking-card .action-buttons button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<meta charset="utf-8">
    <link rel="stylesheet" href="navigation.css">
       <link rel="stylesheet" href="footer.css">
<body>
        <section class="navigation">
  <div class="nav-container">
    <div class="brand">
      <a href="#!">REAL ESTATE AGENCIES</a>
    </div>
    <nav>
      <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
      <ul class="nav-list">
        <li>
          <a href="Home.php">Home</a>
        </li>
        <li>
          <a href="About.html">About</a>
        </li>
            <li>
              <a href="Property.php">Properties</a>
            </li>
        <li>
          <a href="my_property.php">My Property</a>
        </li>

        <li>
          <a href="my_bookings.php">My Bookings</a>
        </li>
        
        <li>
          <a href="Contact.html">Contact</a>
        </li>
      </ul>
    </nav>
  </div>
</section>
    <div>
        <!-- Display other content on the My Bookings page -->
        <h1>My Bookings</h1>
        <!-- Other content goes here -->

        <?php foreach ($bookings as $booking) : ?>
            <div class="booking-card">
                <h3><?php echo $booking['property_name']; ?></h3>
                <p>Booking Status: <span class="booking-status"><?php echo $booking['status']; ?></span></p>
                <p>Property ID: <?php echo $booking['property_id']; ?></p>
                <div class="action-buttons">
                    <?php if ($booking['status'] === 'rejected') : ?>
                        <a href="?cancel_id=<?php echo $booking['book_id']; ?>" onclick="return confirm('Are you sure you want to cancel this booking?');"><button>Cancel</button></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="footer">
  <div class="inner-footer">

    <div class="footer-items">
      <h1>REAL ESTATE AGENCY</h1>
      <p>Established since 2002 in Jelutong, Penang, REAL ESTATE AGENCY has evolved into becoming a full range of landscaping diiferent types of properties in Penang.</p>
    </div>


    <div class="footer-items">
      <h3>Quick Links</h3>
      <div class="border1"></div> 
        <ul>
          <a href="Home.php"><li>Home</li></a>
          <a href="About.html"><li>About Us</li></a>
          <a href="Contact.html"><li>Contact</li></a>
        </ul>
    </div>


    <div class="footer-items">
      <h3>Properties</h3>
      <div class="border1"></div>  
        <ul>
          <a href="Property.php"><li>Properties </li></a>
          <a href="my_property.php"><li>My Property</li></a>
          <a href="my_bookings.php"><li>My Bookings</li></a>
        </ul>
    </div>


    <div class="footer-items">
      <h3>Contact us</h3>
      <div class="border1"></div>
        <ul>
          <li><i class="fa fa-map-marker" aria-hidden="true"></i> Real Estate Agency, 
                 22, Lorong Hijau 8, Taman Koperasi Jelutong, 11600 Jelutong, Pulau Pinang </p></li> <br>
          <li><i class="fa fa-phone" aria-hidden="true"></i>0182993108</li>
          <li><i class="fa fa-envelope" aria-hidden="true"></i>RealEstate@gmail.com</li>
        </ul> 
      

        <div class="social-medias">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-google-plus-square"></i></a>
        </div> 
    </div>
  </div>
  
  <div class="footer-bottom">
    Copyright &copy; Real Estate Agency 2023.
  </div>
</div>
</footer>
</body>
</html>
