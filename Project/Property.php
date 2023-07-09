<?php
$host = 'localhost';
$db = 'realestate';
$user = 'root';
$password = '';

$conn =  mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " .  mysqli_connect_error());
}
// Retrieve property details from the database
$sql = "SELECT * FROM property";
$result = mysqli_query($conn, $sql);
$properties = mysqli_fetch_all($result, MYSQLI_ASSOC);

$uniqueId = uniqid('BOOK-');

// Process property booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $userId = $_POST['user_id'];
    $propertyId = $_POST['property_id'];
    $userName = $_POST['user_name'];
    $propertyName = $_POST['property_name'];
    $contact = $_POST['contact'];

    // Store booking details in the database
    $sql = "INSERT INTO book (book_id, user_id, property_id, user_name,property_name, contact) VALUES ('$uniqueId', '$userId', '$propertyId', '$userName', '$propertyName', '$contact')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Booking successful!";
    } else {
        echo "Booking failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Property Page</title>
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

       
        .property-card {
            width: 300px;
            padding: 20px;
            margin: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .property-card h3 {
            margin-bottom: 10px;
        }

        .property-card p {
            margin-bottom: 10px;
        }

        .property-card .book-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .property-card .book-button:hover {
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
        <!-- Display other content on the property page -->
        <h1>Available Properties</h1>
        <?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    // User is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}
$username = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
?>

        <?php foreach ($properties as $property) : ?>
            <div class="property-card">
                <img src="<?php echo $property['photo_paths']; ?>" alt="Property Photo">
                <h3><?php echo $property['property_name']; ?></h3>
                <p><?php echo $property['property_type']; ?></p>
                <p><?php echo $property['property_address']; ?></p>
                <p>Contact: <?php echo $property['contact']; ?></p>
                <form method="post" action="">
                    <input type="hidden" name="user_id" value="<?php echo $userId; ?>"> <!-- Assuming the user ID is 1 for this example -->
                    <input type="hidden" name="property_id" value="<?php echo $property['unique_id']; ?>">
                    <input type="hidden" name="user_name" value="<?php echo $username; ?>"> <!-- Assuming the user's name is John Doe for this example -->
                    <input type="hidden" name="property_name" value="<?php echo $property['property_name']; ?>">
                    <input type="text" name="contact" placeholder="Enter your contact" required>
                    <button type="submit" class="book-button">Book</button>
                </form>
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