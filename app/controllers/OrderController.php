<?php
require_once(__DIR__ . '/../config/database.php'); // Load kết nối database
require_once(__DIR__ . '/../models/OrderModel.php');
require_once(__DIR__ . '/../models/CartModel.php');
$database = new Database(); // Khởi tạo đối tượng Database
$db = $database->getConnection(); // Lấy kết nối cơ sở dữ liệu
$stmt = $db->prepare("SELECT * FROM orders ORDER BY created_at DESC");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
class OrderController {
    private $db;
    private $orderModel;
    private $cartModel;

    public function __construct($db) {
        $this->orderModel = new OrderModel($db);
        $this->cartModel = new CartModel($db);
         $this->db = $db;
    }

    // Xử lý đặt hàng
     public function checkout($userId) {
    $cartItems = $this->cartModel->getCartItems($userId);
    $totalAmount = 0;

    foreach ($cartItems as $item) {
        $totalAmount += $item['product_price'] * $item['quantity'];
    }

    try {
        // Tạo đơn hàng trong CSDL
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->execute([$userId, $totalAmount]);
        $orderId = $this->db->lastInsertId();

        // Cấu hình VNPay
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/webbanhang/app/views/order/confirm.php";
        $vnp_TmnCode = "E97XI4CA"; // Mã website
        $vnp_HashSecret = "OH88WA3H7RWB2XZE6O0H6K9BXF2CUYP3"; // Chuỗi bí mật

        $vnp_TxnRef = $orderId . "_" . time(); // Mã giao dịch
        $vnp_OrderInfo = "Thanh toan don hang #" . $orderId;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $totalAmount * 100; // Nhân 100
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        // Mảng dữ liệu gửi đi
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_ExpireDate" => $vnp_ExpireDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl, // U viết hoa!!!
 // CHỈNH ĐÚNG tên tham số
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_BankCode" => $vnp_BankCode
        );

        // Tạo hash
        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Gắn hash vào dữ liệu
        $inputData['vnp_SecureHashType'] = 'SHA512';
        $inputData['vnp_SecureHash'] = $vnp_SecureHash;

        // Tạo URL thanh toán
        $vnp_Url .= "?" . http_build_query($inputData);

        // Điều hướng tới VNPay
        header('Location: ' . $vnp_Url);
        exit();

    } catch (Exception $e) {
        die("Lỗi đặt hàng: " . $e->getMessage());
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
