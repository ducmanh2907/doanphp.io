<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController
{
    private $productModel;
    private $db;
    

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }
   
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }
  public function add()
    {
        $categories = (new CategoryModel($this->db))->getCategories();
        include 'app/views/product/add.php';
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
             $target_dir = __DIR__ . "/../../public/uploads/";

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

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $imagePath);

            if ($result) {
                header('Location: /webbanhang/Product');
                exit();
            }
        }
    }


    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/admin/views/product/edit.php';
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

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

            if ($edit) {
                header('Location: /webbanhang/Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }
    
}
