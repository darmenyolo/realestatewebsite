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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check if the user credentials are valid
    $sql = "SELECT * FROM register WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Authentication successful
        $user = mysqli_fetch_assoc($result);
        $userId = $user['uniqueId'];
        $username = $user['name'];

        // Store user's ID and name in session variables
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $username;
        // Redirect the user to a dashboard page or perform any other actions
        header('Location: Home.php');
        exit();
    } else {
        // Authentication failed
        $errorMessage = 'Invalid username or password.';
    }
}
?>

<!-- HTML login form with CSS styling -->
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
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

        .container .error-message {
            color: #f00;
            margin-top: 10px;
            text-align: center;
        }

        .register-button {
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
        .register-button:hover {
            background-col
    </style>
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <form method="post" action="">
            <label>Username:</label>
            <input type="text" name="username" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
        <button class="register-button" onclick="location.href='register.php'">Register</button>
        <?php
        // Display error message if login failed
        if (isset($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }
        ?>
    </div>
</body>
</html>
