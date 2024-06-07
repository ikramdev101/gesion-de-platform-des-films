<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Space</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #fff;
            display :flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;

        }
        .container {
            max-width: 800px;
            margin: auto;
            margin-top:200px;
            padding: 20px;
            background-color: #000;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display :flex;
            justify-content:space-between;
        }
        .action {
            cursor: pointer;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #222;
            border-radius: 10px;
            transition: background-color 0.3s;
            display :flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        .action:hover {
            background-color: #333;
        }
        .section-title {
            margin-bottom: 20px;
            color: #e50914;
        }
        .action-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .action-text {
            font-size: 18px;
        }
        .btn-danger {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-danger:hover {
            background-color: #ff4529;
            border-color: #ff4529;
        }
       
        .header {
            background-color: #141414;
            padding: 8px 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content:right;
            align-items: center;
            height:60px;
            width: 100%;
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
       

        <!-- View Users Section -->
        <div class="action" onclick="location.href='afiicherU.php';">
            <i class="fas fa-users action-icon"></i>
            <p class="action-text">View Users</p>
        </div>

        <!-- Add/Delete Film Section -->
        <div class="action" onclick="location.href='ajoutF.php';">
            <i class="fas fa-film action-icon"></i>
            <p class="action-text">Add Film</p>
        </div>

        <!-- View List of Films Section -->
        <div class="action" onclick="location.href='afiicher.php';">
            <i class="fas fa-list action-icon"></i>
            <p class="action-text">View List of Films</p>
        </div>
        <div class="action" onclick="location.href='afiicher.php';">
            <i class="fas fa-list action-icon"></i>
            <p class="action-text">Delet Films</p>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
