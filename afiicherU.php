<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=movie_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Fetch users from the database
   $sql = 'SELECT * FROM utilisateur';
   $stmt = $pdo->query($sql);
   $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
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
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #fff;
        }
        .container {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            background-color: #000;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            color: #fff;
        }
        .table thead th {
            color: #e50914;
            border-top: none;
            border-bottom: 2px solid #e50914;
        }
        .table tbody td {
            border-top: none;
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
    <div class="container">
        <h2 class="text-center mb-4">User Management</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <form action="delet.php" method="POST">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
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
