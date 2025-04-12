<?php
// Bao gồm file kết nối CSDL
require_once(__DIR__ . "/../../../config/database.php");

// Tạo đối tượng Database và lấy kết nối
$database = new Database();
$conn = $database->getConnection();

// Truy vấn dữ liệu
$query = "SELECT o.id, o.user_id, o.total_price, o.status, o.created_at, u.name AS user_name
                      FROM orders o
                      LEFT JOIN users u ON o.user_id = u.id";
            
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<h1>Danh sách đơn hàng</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Tổng giá trị</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo htmlspecialchars($order->id, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($order->user_name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo number_format($order->total_price, 2); ?> đ</td>
            <td><?php echo htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($order->created_at, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="/webbanhang/app/admin/index.php?controller=adminorder&action=show&id=<?php echo $order->id; ?>" class="btn btn-info">Xem chi tiết</a>
                <a href="/webbanhang/app/admin/index.php?controller=adminorder&action=update&id=<?php echo $order->id; ?>" class="btn btn-warning">Cập nhật</a>
                <a href="/webbanhang/app/admin/index.php?controller=adminorder&action=delete&id=<?php echo $order->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
