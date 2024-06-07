<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if ID parameter is provided in the POST request
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare SQL statement to delete the user with the provided ID
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        // Redirect back to the user management page after deletion
        header('Location:main.php');
        exit();
    } else {
        echo "User ID not provided.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
