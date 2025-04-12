<?php
// Bao gồm file kết nối CSDL
require_once(__DIR__ . "/../../../config/database.php");

// Tạo đối tượng Database và lấy kết nối
$database = new Database();
$conn = $database->getConnection();

// Truy vấn dữ liệu
$query = "SELECT * FROM users";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #007bff;
            color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            margin-right: 8px;
        }

        td a:hover {
            text-decoration: underline;
        }

        .actions {
            white-space: nowrap;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="path_to_your_stylesheet.css">
</head>
<body>

<h1>Danh sách người dùng</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Vai trò</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->phone ?></td>
            <td><?= $user->address ?></td>
            <td><?= $user->role ?></td>
            <td><?= $user->created_at ?></td>
            <td>
                <a href="/admin/user/edit/<?= $user->id ?>">Sửa</a> |
                <a href="/admin/user/delete/<?= $user->id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
