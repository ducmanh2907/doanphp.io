<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/UserModel.php');
class CartController {
    private $cartModel;
    private $userModel;

    public function __construct($db) {
        $this->cartModel = new CartModel($db);
        $this->userModel = new UserModel($db); // Giả sử bạn có UserModel để lấy thông tin người dùng
    }

    // Hiển thị giỏ hàng
    public function index($userId) {
        $cartItems = $this->cartModel->getCartItems($userId);
        // Giả sử bạn sẽ hiển thị giỏ hàng thông qua view, chẳng hạn bằng cách truyền dữ liệu vào một template
         $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item['product_price'] * $item['quantity'];
    }
       require_once APP_PATH . '/views/cart/view.php';

    }

    // Thêm sản phẩm vào giỏ hàng
    public function add($userId) {
        if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            if ($this->cartModel->addToCart($userId, $productId, $quantity)) {
                // Sau khi thêm sản phẩm thành công, chuyển hướng đến trang giỏ hàng
                header("Location: /webbanhang/index.php?controller=cart&action=index&user_id={$userId}");
                exit();
            } else {
                // Thêm sản phẩm thất bại
                echo "Lỗi khi thêm sản phẩm vào giỏ hàng!";
            }
        } else {
            echo "Dữ liệu không hợp lệ!";
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($userId, $cartItemId) {
        if ($this->cartModel->removeCartItem($cartItemId)) {
            // Sau khi xóa thành công, chuyển hướng lại giỏ hàng
            header("Location: /webbanhang/index.php?controller=cart&action=index&user_id={$userId}");
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm khỏi giỏ hàng!";
        }
    }

    // Xóa toàn bộ giỏ hàng
    public function clear($userId) {
        if ($this->cartModel->clearCart($userId)) {
            // Sau khi xóa toàn bộ giỏ hàng, chuyển hướng về trang giỏ hàng trống
            header("Location: /webbanhang/index.php?controller=cart&action=index&user_id={$userId}");
            exit();
        } else {
            echo "Lỗi khi xóa toàn bộ giỏ hàng!";
        }
    }
}
?>
