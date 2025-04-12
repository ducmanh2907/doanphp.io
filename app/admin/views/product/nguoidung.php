
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
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 20px;
    }

    h1, h2 {
        color: #333;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        margin: 2px 0;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        color: black;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-success:hover,
    .btn-warning:hover,
    .btn-danger:hover {
        opacity: 0.9;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 40px;
        background-color: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 5px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        text-align: left;
        vertical-align: middle;
    }

    th {
        background-color: #343a40;
        color: white;
    }

    td img {
        object-fit: cover;
        border-radius: 5px;
    }

    form {
        margin: 0;
        display: inline-block;
    }

    form input[type="number"] {
        width: 60px;
        padding: 3px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form button {
        margin-left: 5px;
        padding: 5px 10px;
        background-color: #17a2b8;
        color: white;
        border: none;
        border-radius: 4px;
    }

    form button:hover {
        background-color: #138496;
        cursor: pointer;
    }

    .mb-2 {
        margin-bottom: 15px;
        display: inline-block;
    }
</style>

<h1>Danh sách sản phẩm</h1>
<a href="/webbanhang/app/admin/views/product/add.php" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<style>
   
</style>
<?php
// Nhóm sản phẩm theo danh mục
$groupedProducts = [];
foreach ($products as $product) {
    $groupedProducts[$product->category_name][] = $product;
}

?>

<?php foreach ($groupedProducts as $categoryName => $productList): ?>
    <h2><?php echo htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?></h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productList as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (!empty($product->image)): ?>
                            <img src="/webbanhang/public<?php echo htmlspecialchars($product->image); ?>" 
     alt="<?php echo htmlspecialchars($product->name); ?>" 
     width="100" height="100">

                        <?php else: ?>
                            <p>Không có ảnh</p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/webbanhang/app/admin/index.php?controller=adminproduct&action=show&id=<?php echo $product->id; ?>">
    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
</a>


                    </td>
                    <td><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>đ</td>
                    <td><?php echo htmlspecialchars($product->created_at, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="/webbanhang/app/admin/index.php?controller=adminproduct&action=edit&id=<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>

                        <form action="/webbanhang/app/admin/index.php?controller=adminproduct&action=delete" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
    <button type="submit" class="btn btn-danger">Xóa</button>
</form>

                       <form action="/webbanhang/app/admin/index.php?controller=admincart&action=add" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <input type="number" name="quantity" value="1" min="1" required>
                        <button type="submit">Thêm vào giỏ hàng</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

