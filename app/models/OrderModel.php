<?php
class OrderModel {
    private $db;

    public function __construct($db) {
        if (!$db instanceof PDO) {
            die("Lỗi: Kết nối database không hợp lệ.");
        }
        $this->db = $db;
    }

    // Tạo đơn hàng mới
    public function createOrder($userId, $totalAmount, $orderItems) {
        try {
            $this->db->beginTransaction();

            // Thêm đơn hàng vào bảng orders
            $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price, status, created_at) VALUES (?, ?, 'pending', NOW())");
            $stmt->execute([$userId, $totalAmount]);
            $orderId = $this->db->lastInsertId();

            // Thêm từng sản phẩm vào bảng order_items
            foreach ($orderItems as $item) {
                $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->execute([$orderId, $item['product_id'], $item['quantity'], $item['product_price']]);
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // Lấy thông tin đơn hàng
    public function getOrderDetails($orderId) {
        $stmt = $this->db->prepare("
            SELECT o.id, o.total_amount, o.status, o.created_at,
                   oi.product_id, p.name AS product_name, oi.quantity, oi.price
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN products p ON oi.product_id = p.id
            WHERE o.id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus($orderId, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $orderId]);
    }
}
?>
