<?php
class AdminCartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy danh sách sản phẩm trong giỏ hàng
    public function getCartItems($userId) {
    $stmt = $this->db->prepare("
        SELECT ci.id, ci.quantity, 
               p.id AS product_id, p.name AS product_name, 
               p.price AS product_price, p.image AS product_image
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.id
        JOIN users u ON ci.user_id = u.id
        WHERE ci.user_id = ?
    ");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Kiểm tra sản phẩm trong giỏ hàng
    public function getCartItem($userId, $productId) {
        $stmt = $this->db->prepare("SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$userId, $productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm hoặc cập nhật số lượng sản phẩm trong giỏ hàng
    public function addToCart($userId, $productId, $quantity) {
        $cartItem = $this->getCartItem($userId, $productId);

        if ($cartItem) {
            $stmt = $this->db->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?");
            return $stmt->execute([$quantity, $cartItem['id']]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
            return $stmt->execute([$userId, $productId, $quantity]);
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeCartItem($cartItemId) {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE id = ?");
        return $stmt->execute([$cartItemId]);
    }

    // Xóa toàn bộ giỏ hàng
    public function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE user_id = ?");
        return $stmt->execute([$userId]);
    }
}

