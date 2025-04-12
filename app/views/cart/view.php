<?php include(__DIR__ . "/../shares/header.php"); 

// Bao gồm kết nối CSDL và mô hình CartModel
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../../models/CartModel.php";

// Tạo đối tượng Database và kết nối
$database = new Database();
$conn = $database->getConnection();

// Giả sử bạn đã lấy thông tin người dùng từ session hoặc cookie
$userId = $_SESSION['user_id']; // Hoặc cách khác để lấy userId

// Khởi tạo mô hình Cart
$cartModel = new CartModel($conn);
$cartItems = $cartModel->getCartItems($userId); // Lấy danh sách sản phẩm trong giỏ hàng

?>
<style>
    


h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background-color: #007bff;
    color: white;
}

td img {
    max-width: 80px;
    height: auto;
    border-radius: 5px;
}

td a {
    text-decoration: none;
    color: #dc3545;
    font-weight: bold;
}

td a:hover {
    color: #c82333;
}

a.checkout-btn {
    display: inline-block;
    padding: 12px 20px;
    margin-top: 20px;
    background-color: #28a745;
    color: white;
    font-size: 16px;
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
}

a.checkout-btn:hover {
    background-color: #218838;
}

/* Responsive */
@media screen and (max-width: 768px) {
    .container {
        width: 95%;
    }

    table, th, td {
        font-size: 14px;
        padding: 8px;
    }
}

</style>
<h2>Giỏ hàng của bạn</h2>
<?php if (count($cartItems) > 0): ?>
    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($item['product_price'], 0, ',', '.'); ?>đ</td>
                <td><?php echo number_format($item['product_price'] * $item['quantity'], 0, ',', '.'); ?>đ</td>
                <td>
                    <a href="/webbanhang/index.php?controller=cart&action=remove&id=<?php echo $item['id']; ?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3 style="text-align: right; margin-top: 20px;">
    Tổng tiền: <?php echo number_format($totalPrice, 0, ',', '.'); ?>đ
</h3>
<form method="POST" action="/webbanhang/index.php?controller=Order&action=checkout">
    <button type="submit" class="btn btn-success">Đặt hàng</button>
</form>




<?php else: ?>
    <p>Giỏ hàng của bạn trống.</p>
<?php endif; ?>
