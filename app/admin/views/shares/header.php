<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /webbanhang/app/views/login.php");
    exit();
}
$user = $_SESSION['user']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: blue;
            text-transform: uppercase;
        }
        .nav-link {
            color: white !important;
            font-size: 1.1rem;
            margin-right: 15px;
            transition: transform 0.3s;
        }
        .nav-link:hover {
            transform: scale(1.1);
            color: #f8f9fa !important;
        }
        .btn-shop {
            background: white;
            color: #ff6b6b;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-shop:hover {
            background: #ff6b6b;
            color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand" href="#">Fashion Store</a>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/app/views/trangchu.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/app/views/collections.php">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Chào mừng + Icon User -->
        <div class="d-flex align-items-center">
            <h5 class="me-3 text-white">Chào mừng, <?php echo htmlspecialchars($user['name']); ?>!</h5>
            <a href="/webbanhang/app/controllers/AuthController.php?action=logout" class="btn btn-light btn-sm">Đăng xuất</a>
        </div>
    </div>
</nav>



    
    <div class="container mt-4">
