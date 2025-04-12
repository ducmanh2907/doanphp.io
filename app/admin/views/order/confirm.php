<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
        }

        h1 {
            color: #10b981;
            margin-bottom: 20px;
            font-size: 28px;
        }

        p {
            font-size: 16px;
            color: #374151;
            margin-bottom: 30px;
        }

        a {
            text-decoration: none;
            background-color: #3b82f6;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Đặt hàng thành công!</h1>
        <p>Giỏ hàng của bạn đã được đặt thành công.<br>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
        <a href="/webbanhang/app/admin/index.php?controller=adminproduct&action=index">Tiếp tục mua sắm</a>
    </div>
</body>
</html>
