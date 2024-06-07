<?php
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $sql = 'DELETE FROM movies WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    $sql = 'SELECT * FROM movies';
    $stmt = $pdo->query($sql);
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #141414;
            color: #fff;
        }
        .table {
            background-color: #222;
            color: #fff;
        }
        .table th,
        .table td {
            border-color: #303030;
        }
        .btn-danger {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-danger:hover {
            background-color: #ff4529;
            border-color: #ff4529;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Movie List</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Nombre de saisons</th>
                    <th>Nombre d'épisodes</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr>
                        <td><?= htmlspecialchars($movie['title']) ?></td>
                        <td><?= htmlspecialchars($movie['description']) ?></td>
                        <td><?= htmlspecialchars($movie['nombre_de_saisons']) ?></td>
                        <td><?= htmlspecialchars($movie['nombre_episodes']) ?></td>
                        <td><img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" style="max-width: 100px;"></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="delete" value="<?= $movie['id'] ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
