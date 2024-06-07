

<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if film ID parameter is provided
    if (isset($_GET['film_id'])) {
        $film_id = $_GET['film_id'];

        // Fetch film details from the database
        $sql = "SELECT * FROM movies WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$film_id]);
        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$film) {
            echo "Film not found.";
            exit();
        }
    } else {
        echo "Film ID not provided.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $film['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        body {
            background-color: #111;
            color: #fff;
        }
        .container {
            padding: 20px;
        }
        .table {
            background-color: #222;
        }
        .table thead th {
            color: #fff;
            background-color: #e50914;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .movie-img {
            width: 150px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Your header content -->
    <div class="container">
        <?php if (isset($film)) : ?>
            <h2 class="text-center"><?= $film['title'] ?></h2>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-dark">
                    <tbody>
                        <tr>
                            <th>Image</th>
                            <td><img src="<?= $film['image_url'] ?>" alt="<?= $film['title'] ?>" class="movie-img"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= $film['description'] ?></td>
                        </tr>
                        <tr>
                            <th>Number of Seasons</th>
                            <td><?= $film['nombre_de_saisons'] ?></td>
                        </tr>
                        <tr>
                            <th>Number of Episodes</th>
                            <td><?= $film['nombre_episodes'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Add to favorites button with star icon -->
            <div class="text-center">
    <form action="favorit.php" method="POST">
        <input type="hidden" name="film_id" value="<?= htmlspecialchars($_GET['film_id']) ?>">
        <button type="submit" class="btn btn-warning"><i class="fas fa-star"></i> Add to Favorites</button>
    </form>
</div>
        <?php else : ?>
            <div class="container">
                <p>Film details not found.</p>
            </div>
        <?php endif; ?>
    </div>
 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>