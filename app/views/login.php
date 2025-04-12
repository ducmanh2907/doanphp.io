<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/UserModel.php'; 
// Hiển thị thông báo nếu đăng ký thành công
$successMessage = isset($_GET['success']) ? "Đăng ký thành công! Vui lòng đăng nhập." : "";
$errorMessage = isset($error) ? $error : "";

// Đảm bảo bao gồm các tệp kết nối cơ sở dữ liệu và mô hình

require_once __DIR__ . '/../admin/models/AdminUserModel.php'; 

// Khởi tạo kết nối cơ sở dữ liệu
$database = new Database(); // Khởi tạo đối tượng Database
$db = $database->getConnection(); // Lấy kết nối cơ sở dữ liệu

// Khởi tạo mô hình AdminUserModel với kết nối cơ sở dữ liệu
$userModel = new AdminUserModel($db);

// Tiếp tục với logic đăng nhập
if (isset($_POST['email']) && isset($_POST['password'])) {
    $user = $userModel->getUserByEmail($_POST['email']); // Lấy thông tin người dùng qua email

    // Kiểm tra thông tin đăng nhập
    if ($user && password_verify($_POST['password'], $user['password'])) {
        session_start(); // Khởi tạo phiên làm việc

        $_SESSION['user_id'] = $user['id']; // Lưu user_id vào session
        $_SESSION['role'] = $user['role']; // Lưu role vào session
  // Lưu thông tin người dùng vào session
       
        $_SESSION['user'] = $user;  // Lưu toàn bộ thông tin người dùng vào session
        // Chuyển hướng người dùng theo vai trò
        if ($user['role'] === 'admin') {
            header("Location: /app/admin/views/admin.php"); // Nếu là admin, chuyển đến trang quản trị
        } else {
            header("Location: /home"); // Nếu là user thường, chuyển đến trang home
        }
        exit(); // Đảm bảo không có code nào chạy tiếp sau khi chuyển hướng
    } else {
        echo "Sai email hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Web Bán Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 400px;">
            <h3 class="text-center mb-3">Đăng nhập</h3>

            <!-- Thông báo -->
            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success"><?= $successMessage ?></div>
            <?php endif; ?>
            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger"><?= $errorMessage ?></div>
            <?php endif; ?>

            <form method="post" action="/webbanhang/app/controllers/AuthController.php?action=login">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                <div class="text-center mt-3">
                    Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
