<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user_id'];
        $filmId = $_POST['film_id'];

        // Fetch the movie details from the movies table
        $sql = "SELECT * FROM movies WHERE id = :film_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['film_id' => $filmId]);
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($movie) {
            // Insert the movie details into the favorites table
            $sql = "INSERT INTO favoritss (user_id, movie_id, image_url, title, description, nombre_de_saisons, nombre_episodes)
                    VALUES (:user_id, :movie_id, :image_url, :title, :description, :nombre_de_saisons, :nombre_episodes)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'user_id' => $userId,
                'movie_id' => $movie['id'],
                'image_url' => $movie['image_url'],
                'title' => $movie['title'],
                'description' => $movie['description'],
                'nombre_de_saisons' => $movie['nombre_de_saisons'],
                'nombre_episodes' => $movie['nombre_episodes']
            ]);

            // Redirection après ajout aux favoris
            exit();
        } else {
            echo "Movie not found.";
        }
    }

    // Récupérer les films favoris de l'utilisateur connecté
    $userId = $_SESSION['user_id'];
    $sql = "SELECT * FROM favoritss WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $favoriteMovies = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films Favoris</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class='bg-dark'>
    <div class="container">
        <h2 class="text-center mt-3 text-white">Films Favoris</h2>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Saisons</th>
                        <th>Épisodes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($favoriteMovies) > 0): ?>
                        <?php foreach ($favoriteMovies as $movie): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" style="max-width: 100px;"></td>
                                <td><?= htmlspecialchars($movie['title']) ?></td>
                                <td><?= htmlspecialchars($movie['description']) ?></td>
                                <td><?= htmlspecialchars($movie['nombre_de_saisons']) ?></td>
                                <td><?= htmlspecialchars($movie['nombre_episodes']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Aucun film favori trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
