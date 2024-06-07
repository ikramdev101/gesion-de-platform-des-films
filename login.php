<?php
session_start();

// Include the database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the hashed password associated with the provided email
    $sql = "SELECT id, password, name FROM utilisateur WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $storedHashedPassword = $row['password'];

        // Compare the entered password with the hashed password from the database
        if (password_verify($password, $storedHashedPassword)) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id']; // Add this line to store user_id in the session

            if ($email === 'admin@gmail.com') {
                header('Location: admin.php');
                exit();
            } else {
                header('Location: utilisateur.php');
                exit();
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JM


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 400px;
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
            background-color: #333;
            color: #fff;
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
<body>
    <div class="container">
      
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </form>
        <div class="social-login">
            <button class="btn google"><i class="fab fa-google"></i></button>
            <button class="btn facebook"><i class="fab fa-facebook-f"></i></button>
        </div>
        <div class="already-account">
            <p>New? <a href="sign.php">Sign up</a></p>
            <!-- <p><a href="forgot_password.php">Forgot Password?</a></p> -->
        </div>
    </div>
</body>
</html>
