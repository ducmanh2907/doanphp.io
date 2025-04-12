<?php include(__DIR__ . "/../shares/header.php"); ?>

<?php
// Bao gồm file kết nối CSDL
require_once __DIR__ . "/../../config/Database.php";

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
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
       
    }
    .page-title {
        text-align: center;
        font-size: 36px;
        margin: 20px 0 30px;
        color:rgb(11, 37, 237);
        text-shadow: 5px 10px 4px rgba(232, 11, 11, 0.3);
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    .category-title {
        font-size: 24px;
        margin: 30px 0 15px 0;
        color: #333;
        
        padding-bottom: 10px;
    }
    
    .products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .product-card {
        width: calc(25% - 20px);
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .product-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    
    .product-info {
        padding: 15px;
    }
    
    .product-name {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .product-price {
        font-size: 16px;
        color: #d9534f;
        font-weight: bold;
    }
    
    @media (max-width: 1024px) {
        .product-card {
            width: calc(33.33% - 20px);
        }
    }
    
    @media (max-width: 768px) {
        .product-card {
            width: calc(50% - 20px);
        }
    }
    
    @media (max-width: 480px) {
        .product-card {
            width: 100%;
        }
    }
</style>

<style></style>
<?php
// Nhóm sản phẩm theo danh mục
$groupedProducts = [];
foreach ($products as $product) {
    $groupedProducts[$product->category_name][] = $product;
}
?>

<?php foreach ($groupedProducts as $categoryName => $productList): ?>
   <h2 class="category-title"><?php echo htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?></h2>
    
    <div class="products-container">
        <?php foreach ($productList as $product): ?>
            <div class="product-card">
                <?php if (!empty($product->image)): ?>
                    <img src="/webbanhang/public/<?php echo htmlspecialchars($product->image); ?>" 
                         alt="<?php echo htmlspecialchars($product->name); ?>" 
                         class="product-image">
                <?php else: ?>
                    <div class="product-image" style="background: #eee; display: flex; align-items: center; justify-content: center;">
                        <p>Không có ảnh</p>
                    </div>
                <?php endif; ?>
               
                <div class="product-info">
                     <div>
                    <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                </div>
                    
                    <div>
                        <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    </div>
                    <div class="product-price">
                        <?php echo number_format(htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'), 0, ',', '.'); ?>đ
                    </div>
                    <div>
                        <form action="/webbanhang/index.php?controller=cart&action=add" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <input type="number" name="quantity" value="1" min="1" required>
                        <button type="submit">Thêm vào giỏ hàng</button>
                    </form>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<?php include(__DIR__ . "/../shares/footer.php"); ?>

