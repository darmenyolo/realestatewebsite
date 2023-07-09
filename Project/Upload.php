</head>
<body>
    <div class="container">
        <h2>Upload Property</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="property_name">Property Name:</label>
                <input type="text" name="property_name" required>
            </div>

            <div class="form-group">
                <label for="property_address">Property Address:</label>
                <input type="text" name="property_address" required>
            </div>

            <div class="form-group">
                <label for="owner_name">Owner Name:</label>
                <input type="text" name="owner_name" required>
            </div>


            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" name="contact" required>
            </div>

            <div class="form-group">
                <label>Property Type:</label>
                <input type="radio" name="property_type" value="landed" required> Landed
                <input type="radio" name="property_type" value="apartment" required> Apartment/Condominium
            </div>

            <div class="form-group">
                <label for="photos">Upload Photos:</label>
                <input type="file" name="photos[]" multiple required>
            </div>

            <div class="form-group">
                <input type="submit" value="Upload" class="btn-upload">
                <button type="button" onclick="location.href='home.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>





<?php
session_start();
$host = 'localhost';
$db = 'realestate';
$user = 'root';
$password = '';

$conn =  mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " .  mysqli_connect_error());
}


$uniqueId = uniqid('PROPERTY-');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $propertyName = $_POST['property_name'];
    $propertyAddress = $_POST['property_address'];
    $OwnerName = $_POST['owner_name'];
    $contact = $_POST['contact'];
    $propertyType = $_POST['property_type'];

    // Process uploaded photos
    $uploadedPhotos = $_FILES['photos'];
    $photoPaths = [];
    foreach ($uploadedPhotos['tmp_name'] as $index => $tmpName) {
        // Generate a unique filename for each photo
        $photoName = uniqid('photo_') . '.' . pathinfo($uploadedPhotos['name'][$index], PATHINFO_EXTENSION);
        $photoPath = 'uploads/' . $photoName;

        // Move the uploaded photo to the destination folder
        move_uploaded_file($tmpName, $photoPath);

        // Store the photo path
        $photoPaths[] = $photoPath;
    }

    // Store the property details and photo paths in the database
    $sql = "INSERT INTO property (unique_id, property_name, property_address,owner_name, contact, property_type, photo_paths) VALUES ('$uniqueId', '$propertyName', '$propertyAddress', '$OwnerName', '$contact', '$propertyType', '" . implode(',', $photoPaths) . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<p class="success-message">Property uploaded successfully!</p>';
            } else {
                echo '<p class="error-message">Property upload failed. Please try again.</p>';
            }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Property</title>
     <style>
        /* CSS styling for the form */
        body {
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group input[type="radio"] {
            margin-right: 5px;
        }

        .form-group .btn-upload {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .form-group .btn-upload:hover {
            background-color: #45a049;
        }

        .form-group .btn-cancel {
            background-color: #ccc;
            color: #333;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .form-group .btn-cancel:hover {
            background-color: #999;
        }

        .success-message {
            color: green;
           text-align: center;
        }

         .error-message {
            color: red;
            text-align: center;
        }
    </style>
