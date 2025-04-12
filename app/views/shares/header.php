<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
        background: linear-gradient(90deg,rgb(7, 0, 2) 0%,rgb(91, 89, 86) 50%, rgb(35, 33, 31) 100%);
        padding: 15px 0;
        height: 120px;
    }

    .navbar-brand {
        font-size: 1.8rem;
        font-weight: bold;
        color: white !important;
    }

    .navbar-nav .nav-link {
        color: white !important;
        font-weight: 500;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }

    .btn-light.btn-sm {
        font-weight: 500;
        border-radius: 20px;
        padding: 6px 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
    }

    .btn-light.btn-sm:hover {
        background-color:rgb(194, 56, 10);
    }

    h5.text-white {
        margin: 0;
        font-size: 1rem;
        color:#d4af37 !important;
    }

    .container.mt-4 {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
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
