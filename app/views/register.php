<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Web Bán Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 400px;">
            <h3 class="text-center mb-3">Đăng ký</h3>

            <!-- Hiển thị lỗi nếu có -->
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="post" action="/webbanhang/app/controllers/AuthController.php?action=register">
                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                <div class="text-center mt-3">
                    Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
