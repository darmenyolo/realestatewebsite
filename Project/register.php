<?php
$host = 'localhost';
$db = 'realestate';
$user = 'root';
$password = '';

$conn =  mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " .  mysqli_connect_error());
}
// Function to generate a unique ID
function generateUniqueId() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $uniqueId = 'USER-';
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $uniqueId .= $characters[$index];
    }
    return $uniqueId;
}

// Process registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and perform necessary validation
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    // ... perform other validations ...

    // Generate unique ID
    $uniqueId = generateUniqueId();

    // Save the unique ID and user details to the database
    $sql = "INSERT INTO register(uniqueId, name, contact, username, password) VALUES ('$uniqueId', '$name', '$contact', '$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Display the unique ID to the user
        echo "Registration successful. Your unique ID is: $uniqueId";
    } else {
        // Display an error message if the database query fails
        echo "Registration failed. Please try again.";
    }
}
?>

<!-- HTML registration form with unique CSS styling -->
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 50px auto;
            max-width: 400px;
            padding: 20px;
        }

        .container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .container label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .container input[type="text"],
        .container input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 8px;
            width: 100%;
        }

        .container input[type="submit"] {
            background-color: #4caf50;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px;
            width: 100%;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container p {
            text-align: center;
            margin-top: 20px;
        }

        .login-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form method="post" action="">
            <label>Name:</label>
            <input type="text" name="name" required><br><br>

            <label>Contact:</label>
            <input type="text" name="contact" required><br><br>

            <label>Username:</label>
            <input type="text" name="username" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Register">
        </form>
        <button class="login-button" onclick="location.href='login.php'">Proceed to Login</button>
        <?php
        // Display registration success or failure message
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo '<p>';
            if ($result) {
                echo 'Registration successful. Your unique ID is: ' . $uniqueId;
            } else {
                echo 'Registration failed. Please try again.';
            }
            echo '</p>';
        }
        ?>
    </div>
</body>
</html>