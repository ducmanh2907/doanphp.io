<?php
require_once 'app/config/database.php';
require_once 'app/controllers/CartController.php';

// Kết nối CSDL
$database = new Database();
$db = $database->getConnection();

$cartController = new CartController($db);

// Lấy tham số từ URL
$action = $_GET['action'] ?? '';
$user_id = 1;  // Giả sử user_id là 1 (thay đổi nếu có đăng nhập)

switch ($action) {
    case 'add':
        $product_id = $_GET['product_id'] ?? 0;
        $quantity = $_GET['quantity'] ?? 1;
        $cartController->addToCart($user_id, $product_id, $quantity);
        break;
    case 'checkout':
        $cartController->checkout($user_id);
        break;
    default:
        $cartController->viewCart($user_id);
        break;
}
?>
