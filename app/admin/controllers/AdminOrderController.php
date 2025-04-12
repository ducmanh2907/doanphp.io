<?php
require_once APP_PATH . '/config/database.php';
require_once(APP_PATH . '/admin/models/AdminCartModel.php');
require_once(APP_PATH . '/admin/models/AdminOrderModel.php');
$database = new Database(); // Khởi tạo đối tượng Database
$db = $database->getConnection(); // Lấy kết nối cơ sở dữ liệu
class AdminOrderController {
    private $db;
    private $orderModel;
    private $cartModel;

    public function __construct($db) {
        $this->orderModel = new AdminOrderModel($db);
        $this->cartModel = new AdminCartModel($db);
         $this->db = $db;
    }
 public function revenueByDay($date) {
        $revenue = $this->orderModel->getRevenueByDay($date);
        require_once(APP_PATH . '/admin/views/product/revenue.php');
    }

    // Hiển thị doanh thu theo tháng
    public function revenueByMonth($month, $year) {
        $revenue = $this->orderModel->getRevenueByMonth($month, $year);
        require_once(APP_PATH . '/admin/views/product/revenue.php');
    }
    // Xử lý đặt hàng
      public function checkout($userId) {
        // Kiểm tra giỏ hàng
        $cartModel = new AdminCartModel($this->db);
        $cartItems = $cartModel->getCartItems($userId);

       
        // Tiến hành xử lý đơn hàng (ví dụ: thêm đơn hàng vào cơ sở dữ liệu)
        try {
            $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
            // Giả sử bạn tính toán tổng số tiền từ giỏ hàng
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item['product_price'] * $item['quantity'];
            }
            $stmt->execute([$userId, $totalAmount]);

            // Sau khi đặt hàng thành công, có thể xóa giỏ hàng hoặc thực hiện các bước khác
            $cartModel->clearCart($userId);

            header("Location: /webbanhang/app/admin/views/order/confirm.php");
        exit();
        } catch (Exception $e) {
            die("Lỗi: " . $e->getMessage());
        }
    }
}

// Xử lý yêu cầu từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'checkout') {
   
    if (!isset($_SESSION['user_id'])) {
        die("Bạn cần đăng nhập để đặt hàng!");
    }

    $userId = $_SESSION['user_id'];
    $orderController = new OrderController($db);
    $orderController->checkout($userId);
}
?>
