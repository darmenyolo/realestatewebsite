<!DOCTYPE html>
<html lang= "en" dir="ltr">
  <head>
    <meta charset="utf-8">
	<title>Image Slider</title>
	<link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="navigation.css">
	   <link rel="stylesheet" href="footer.css">
       <link rel="stylesheet"href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile1.4.5.min.js"></script>
	
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous" ></script>
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
	<title>Home Page</title>
  </head>
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
  <div class="intro">
 <div class="intro-content">
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
<h2>Welcome to Real Estate Website, <?php echo $username; ?></h2>
<h3> Choose yours Favourite Properties ! </h3>
<p> Your Unique ID : <?php echo $userId; ?> </p>
<p>Find your dream home here.
 All around the world!! </p>
</div>
 
 <!--image slider start-->
 <div class="slider">
    <div class="slides">
	  
	    <!--radio buttons start-->
		<input type="radio" name="radio-btn" id="radio1">
		<input type="radio" name="radio-btn" id="radio2">
		<input type="radio" name="radio-btn" id="radio3">
		<input type="radio" name="radio-btn" id="radio4">
		<!--radio buttons end-->
		<!--slide images start-->
		<div class="slide first">
		    <img src="images/property1.jpg" alt="">
		</div>
		<div class="slide">
		    <img src="images/property2.jpeg" alt="">
		</div>
		<div class="slide">
		    <img src="images/property3.jpeg" alt="">
		</div>
		<div class="slide">
		    <img src="images/property4.jpg" alt="">
		</div>
		<!--slide images end-->
		<!--automatic navigation start-->
		<div class="navigation-auto">
		    <div class="auto-btn1"></div>
			<div class="auto-btn2"></div>
			<div class="auto-btn3"></div>
			<div class="auto-btn4"></div>
		</div>
		<!--automatic navigation end-->
	</div>
	<!--manual navigation start-->
	<div class="navigation-manual">
	    <label for="radio1" class="manual-btn"></label>
	    <label for="radio2" class="manual-btn"></label>
	    <label for="radio3" class="manual-btn"></label>
		<label for="radio4" class="manual-btn"></label>
    <!-- Upload button -->
        
	</div>

</div>
</div>
<div>
    <a href="upload.php" class="upload-button">Upload</a>
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
          <a href="Home.html"><li>Home</li></a>
          <a href="About.html"><li>About Us</li></a>
          <a href="FAQ.html"><li>FAQ</li></a>
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
<script src="navigation.js"></script>
<script src="home.js"></script>
</footer>
</body>
<style>
        /* CSS styling for the button */
        .upload-button {
             position: fixed;
            top: 70px;
            right: 40px;
            display: inline-block;
            padding: 10px 40px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    </style>
