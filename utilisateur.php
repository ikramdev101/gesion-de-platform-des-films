<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

// Create a new PDO instance
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if search term is provided
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        // Fetch movies that match the search term
        $sql = "SELECT * FROM movies WHERE title LIKE :search";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Fetch all movies if no search term provided
        $sql = 'SELECT * FROM movies';
        $stmt = $pdo->query($sql);
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Global Nomads Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #141414;
            color: #fff;
        }
        .header {
            background-color: #141414;
            padding: 8px 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            height:60px;
        }
        .header h3 {
            color: #e50914;
        }
        .nav {
            display: flex;
            gap: 20px;
        }
        .nav a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            background: black;
            width: 100px;
            height: 30px;
            border-radius: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .nav a:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color:#e50914;
            cursor: pointer;
        }
        .carousel {
            height: 50vh; /* 50% of viewport height */
        }
        .carousel-item {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel-item img {
            height: auto;
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
        }
        .container {
            padding: 20px;
        }
        .section-title {
            font-size: 2em;
            margin-bottom: 20px;
            color: #e50914;
        }
        .cards-container {
            display: grid;
            grid-template-columns: repeat(4, minmax(200px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: #222;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 300px;
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .card-content {
            padding: 20px;
        }
        .card-content h2 {
            margin: 0 0 10px;
            font-size: 1.2em;
            color: #e50914;
        }
        .card-content a {
            text-decoration: none;
            color: #e50914;
            font-weight: bold;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
        }
        .search-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .search-input {
            padding: 10px;
            width: 300px;
            border-radius: 20px;
            border: 2px solid #e50914;
            background-color: #222;
            color: #fff;
            font-size: 16px;
            margin-right: 10px;
        }
        .search-button {
            background-color: #e50914;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #ff4529;
        }
        .btn{
            background-color: #ff4529;

        }
        .dropdown-item:hover{
            background-color: #ff4529; 
        }
    </style>
</head>
<body>
<div class="header">
        <h3>EKcours</h3>
        <div class="search-container">
            <form action="" method="GET">
                <input type="text" class="search-input" name="search" placeholder="Search by title">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
<div class="btn-group">
  <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Account</a></li>
    <li><a class="dropdown-item" href="favorit.php">Favorits</a></li>
    <li><a class="dropdown-item" href="#">watch later</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="login.php" >Log out</a></li>
  </ul>
</div>
    </div>

    <div class="container">
        <div class="section-title">Movies</div>
        <div class="cards-container">
            <?php foreach ($movies as $movie): ?>
                <div class="card">
                    <!-- Wrap the image inside an anchor tag -->
                    <a href="user.php?film_id=<?= $movie['id'] ?>">
                        <img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    </a>
                    <div class="card-content">
                        <h2><?= htmlspecialchars($movie['title']) ?></h2>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

 
   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
