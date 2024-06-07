<?php

// Database configuration
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database
    $sql = 'CREATE DATABASE IF NOT EXISTS movie_db';
    $pdo->exec($sql);

    // Use the newly created database
    $pdo->exec('USE movie_db');

    // Create the table
    $sql = 'CREATE TABLE IF NOT EXISTS movies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        description TEXT NOT NULL,
        nombre_de_saisons INT,
        nombre_episodes INT,
        image_url VARCHAR(255) NOT NULL
    )';
    $pdo->exec($sql);

    // Insert sample data
    $sql = 'INSERT INTO movies (title, description, nombre_de_saisons, nombre_episodes, image_url) VALUES
        ("The Walking Dead", "Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d\'hommes et de femmes mené par l\'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde.", 10, 280, "https://www.tvtime.com/_next/image?url=https%3A%2F%2Fartworks.thetvdb.com%2Fbanners%2Fv4%2Fseries%2F153021%2Fposters%2F60fd8577d1a96.jpg&w=640&q=75"),
        ("The 100", "Après une apocalypse nucléaire, les 318 survivants se réfugient dans des stations spatiales et parviennent à y vivre et à se reproduire, atteignant le nombre de 4000 ; 97 ans plus tard, une centaine de jeunes délinquants redescendent sur Terre.", 7, 100, "https://i.pinimg.com/564x/a3/60/72/a360728a71d61a54d2ed6ab7570f113e.jpg")';
    $pdo->exec($sql);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
