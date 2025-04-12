<?php
// Bao gồm file kết nối CSDL
require_once(__DIR__ . "/../../../config/database.php");



// Tạo đối tượng Database và lấy kết nối
$database = new Database();
$conn = $database->getConnection();

// Truy vấn dữ liệu
try {
    $query = "SELECT p.id, p.name, p.description, p.price, p.image, p.created_at, c.name as category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>
<style>
    /* Reset lại một số mặc định của trình duyệt */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Thiết lập font chữ và màu nền cho toàn bộ trang */
body {
    font-family: 'Arial', sans-serif;
    background-color:rgb(251, 249, 249);
    color: #333;
    padding: 20px;
}

/* Container cho toàn bộ nội dung */
.card {
     background-color:rgb(124, 110, 110);
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

/* Tiêu đề sản phẩm */
.card-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #2c3e50;
}

/* Mô tả sản phẩm */
.card-body p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 10px;
}

/* Định dạng hình ảnh sản phẩm */
.card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Định dạng giá sản phẩm */
.card p strong {
    color: #e74c3c;
    font-size: 18px;
}

/* Các nút hành động */
.card a {
    display: inline-block;
    margin-right: 10px;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    transition: background-color 0.3s ease;
}

.card a:hover {
    background-color: #2980b9;
    color: #fff;
}

/* Các nút hành động sửa, xóa */
.btn-warning {
    background-color: #f39c12;
    color: white;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
}

.btn-secondary {
    background-color: #95a5a6;
    color: white;
}

.btn-success {
    background-color: #27ae60;
    color: white;
}

.card a:hover {
    background-color: #34495e;
}

/* Định dạng cho đoạn văn không có ảnh */
.card p.no-image {
    font-style: italic;
    color: #7f8c8d;
}

/* Tạo khoảng cách giữa các đoạn văn */
.card-body p {
    margin-bottom: 15px;
}

</style>
<h1>Chi tiết sản phẩm</h1>

<?php if ($product): ?>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?></p>
            <p><strong>Giá:</strong> <?php echo number_format($product->price, 2); ?> đ</p>
            
            <td>
     <?php if (!empty($product->image)): ?>
<img src="/webbanhang/public/<?= htmlspecialchars($product->image) ?>" 
     alt="<?= htmlspecialchars($product->name) ?>" 
     width="150" height="150">

            <?php else: ?>
                <p>Không có ảnh</p>
            <?php endif; ?>
</td>

            <p><strong>Ngày tạo:</strong> <?php echo $product->created_at; ?></p>

          <form action="/webbanhang/app/admin/index.php?controller=admincart&action=add" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <input type="number" name="quantity" value="1" min="1" required>
                        <button type="submit">Thêm vào giỏ hàng</button>
                    </form>
            <a href="/webbanhang/Product/list" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
<?php else: ?>
    <p class="text-danger">Sản phẩm không tồn tại.</p>
<?php endif; ?>
