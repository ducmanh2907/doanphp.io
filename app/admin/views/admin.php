<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải là admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /webbanhang/app/views/login.php");
    exit();
}

// Kiểm tra nếu thông tin người dùng chưa được lưu trong session
if (!isset($_SESSION['user'])) {
    header("Location: /webbanhang/app/views/login.php");
    exit();
}

// Lấy thông tin người dùng từ session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Fashion Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="webbanhang/app/admin/views/js/script.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #FF416C, #FF4B2B);
            color: white;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
            font-weight: 500;
            cursor: pointer;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Fashion Admin</h4>
        <h3 class="mb-4">Chào mừng, <?php echo htmlspecialchars($user['name']); ?>!</h3>
        <a class="menu-item" data-page="dashboard.php">Dashboard</a>
        <a class="menu-item" data-page="nguoidung.php">Quản lý sản phẩm</a>
        <a class="menu-item" data-page="list.php">Quản lý người dùng</a>
        <a class="menu-item" data-page="index.php">Quản lý đơn hàng</a>
        <a class="menu-item" data-page="revenue.php">Doanh thu</a>
    </div>

    <div class="content">
        <div id="main-content">
            <h2 class="mb-4">Dashboard</h2>
            <p>Chọn một mục từ menu để xem nội dung.</p>
            <img src="https://www.giltmagazine.it/wp-content/uploads/2025/03/Paris-Fashion-Week-720x480.jpg" >
            
        </div>
    </div>
</body>
</html>
<script>$(document).ready(function () {
    $(".menu-item").click(function () {
        var page = $(this).data("page");

        // Load nội dung vào #main-content
        $("#main-content").load("/webbanhang/app/admin/views/product/" + page);
    });
});
</script>