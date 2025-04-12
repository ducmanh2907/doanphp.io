<?php
require_once APP_PATH . '/config/database.php';
require_once(APP_PATH . '/admin/models/AdminCategoryModel.php');
require_once(APP_PATH . '/admin/models/AdminProductModel.php');

class AdminProductController
{
    private $adminproductModel;
    private $db;
    public function searchProducts($keyword)
{
    $sql = "SELECT * FROM products WHERE name LIKE :keyword";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['keyword' => "%$keyword%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->adminproductModel = new AdminProductModel($this->db);
    }

    public function index()
    {
        $products = $this->adminproductModel->getProducts();
        include 'app/admin/views/product/nguoidung.php';
    }
   
    public function show($id)
    {
        $product = $this->adminproductModel->getProductById($id);
        if ($product) {
            include APP_PATH . '/admin/views/product/show.php';

        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add()
{
    $categories = (new AdminCategoryModel($this->db))->getCategories();
    include APP_PATH . '/app/admin/views/product/add.php';
}

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;

            $imagePath = null;
            if (!empty($_FILES['image']['name'])) {
             $target_dir = dirname(__DIR__, 3) . "/public/uploads/";


                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }

                $fileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                if (in_array($fileType, $allowedTypes) && $_FILES['image']['size'] <= 5000000) {
                    $fileName = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $fileType;
                    $target_file = $target_dir . $fileName;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        $imagePath = '/uploads/' . $fileName;
                    }
                }
            }

            $result = $this->adminproductModel->addProduct($name, $description, $price, $category_id, $imagePath);

            if ($result) {
                header('Location: /webbanhang/app/admin/views/product/nguoidung.php');
                exit();
            }
        }
    }


    public function edit($id)
    {
        $product = $this->adminproductModel->getProductById($id);
        $categories = (new AdminCategoryModel($this->db))->getCategories();

        if ($product) {
            include __DIR__ . '/../views/product/edit.php';

        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            // Xử lý upload ảnh mới (nếu có)
            $image = $_POST['old_image']; // Giữ ảnh cũ nếu không cập nhật
            if (!empty($_FILES['image']['name'])) {
                $target_dir = __DIR__ . "/uploads/";

                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $target_file;
            }

            $edit = $this->adminproductModel->updateProduct($id, $name, $description, $price, $category_id, $image);

            if ($edit) {
                header('Location: /webbanhang/app/admin/views/product/nguoidung.php');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    public function delete()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        if ($this->adminproductModel->deleteProduct($id)) {
            header('Location: /webbanhang/app/admin/views/product/nguoidung.php');
            exit();
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    } else {
        echo "Hành động xóa chỉ được phép sử dụng phương thức POST.";
    }
}

}
