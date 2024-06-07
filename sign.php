
<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Validate form data
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit();
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert data into the users table
        $sql = 'INSERT INTO utilisateur (name, email, password) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);

        // Execute the SQL statement
        if ($stmt->execute([$name, $email, $hashedPassword])) {
            // Registration successful
            // Redirect to another page after successful registration
            header("Location: login.php");
            exit();
        } else {
            // Registration failed
            echo "Registration failed. Please try again.";
        }
    }
} catch (PDOException $e) {
    // Database connection or query error
    echo "Error: " . $e->getMessage();
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #fff;
        }
        .container {
            max-width: 400px;
            margin: auto;
            margin-top: 10px;
            padding: 20px;
            background-color: #000;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: white;
        }
        .form-control {
            background-color: white;
            color: black;
            border: 1px solid #e50914;
        }
        .btn-primary {
            background-color: #e50914;
            border-color: #e50914;
            width: 100%;
            border-radius: 5px;
            color: white;
        }
        .btn-primary:hover {
            background-color: #ff4529;
            border-color: #ff4529;
        }
        .social-login {
            text-align: center;
            margin-top: 20px;
        }
        .social-login button {
            margin-top: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
        .social-login .google {
            background-color: #db4437;
            border: 1px solid #db4437;
            color: #fff;
        }
        .social-login .facebook {
            background-color: #3b5998;
            border: 1px solid #3b5998;
            color: #fff;
        }
        .already-account {
            text-align: center;
            margin-top: 20px;
        }
        .already-account a {
            color: #e50914;
            text-decoration: none;
        }
    </style>
</head>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
        <div class="social-login">
        <button class="btn google"><i class="fab fa-google"></i></button>
            <button class="btn facebook"><i class="fab fa-facebook-f"></i></button>
        </div>
        <div class="already-account">
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </div>
    </div>
</body>
</html>
