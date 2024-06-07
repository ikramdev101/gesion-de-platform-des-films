<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

// Create a new PDO instance
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if all required fields are filled in
        if (isset($_POST['title'], $_POST['description'], $_POST['nombre_de_saisons'], $_POST['nombre_episodes'], $_POST['image_url'])) {
            // Retrieve form data
            $title = $_POST['title'];
            $description = $_POST['description'];
            $nombre_de_saisons = $_POST['nombre_de_saisons'];
            $nombre_episodes = $_POST['nombre_episodes'];
            $image_url = $_POST['image_url'];

            // Insert film into the database
            $sql = 'INSERT INTO movies (title, description, nombre_de_saisons, nombre_episodes, image_url) VALUES (?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$title, $description, $nombre_de_saisons, $nombre_episodes, $image_url])) {
                header('Location: main.php');
                exit();
            } else {
                echo 'Error inserting film.';
            }
        } else {
            echo 'All fields are required.';
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #141414;
            color: #fff;
        }
        .form-control {
            background-color: #222;
            color: #fff;
        }
        .btn-primary {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-primary:hover {
            background-color: #ff4529;
            border-color: #ff4529;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Film</h2>
        <form action="" method="POST">
            <div class="mb-2">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-2">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-2">
                <label for="nombre_de_saisons" class="form-label">Nombre de saisons:</label>
                <input type="number" class="form-control" id="nombre_de_saisons" name="nombre_de_saisons" required>
            </div>
            <div class="mb-2">
                <label for="nombre_episodes" class="form-label">Nombre d'épisodes:</label>
                <input type="number" class="form-control" id="nombre_episodes" name="nombre_episodes" required>
            </div>
            <div class="mb-2">
                <label for="image_url" class="form-label">Image URL:</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Film</button>
        </form>
    </div>
</body>
</html>
