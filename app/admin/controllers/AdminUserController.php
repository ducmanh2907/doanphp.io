<?php
require_once('app/config/database.php');
require_once('app/admin/models/AdminUserModel.php');

class AdminUserController {
    private $AdminuserModel;

    public function __construct($db) {
        // Khởi tạo đối tượng UserModel với đối tượng kết nối cơ sở dữ liệu $db
        $this->AdminuserModel = new AdminUserModel($db);
    }

    // Hiển thị danh sách người dùng
    public function index() {
        $users = $this->AdminuserModel->getAllUsers(); // Lấy tất cả người dùng từ cơ sở dữ liệu
        require_once APP_PATH . 'app/admin/views/user/list.php'; // Hiển thị danh sách người dùng
    }

    // Hiển thị form thêm người dùng
    public function add() {
        require_once APP_PATH . '/admin/views/user/add.php'; // Hiển thị form thêm người dùng
    }

    // Xử lý thêm người dùng
   public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy thông tin người dùng từ form
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        $phone = $_POST['phone'] ?? ''; // Thêm thông tin số điện thoại
        $address = $_POST['address'] ?? ''; // Thêm thông tin địa chỉ
        $role = $_POST['role'] ?? 'customer'; // Mặc định role là 'customer'

        // Kiểm tra nếu người dùng đã tồn tại
        $existingUser = $this->AdminuserModel->getUserByEmail($email);
        if ($existingUser) {
            echo "Email này đã tồn tại!";
            return;
        }

        // Thêm người dùng mới
        if ($this->AdminuserModel->addUser($name, $email, $password, $phone, $address, $role)) {
            header('Location: /admin/user/index');
            exit();
        } else {
            echo "Thêm người dùng thất bại!";
        }
    }
}


    // Hiển thị form sửa thông tin người dùng
    public function edit($id) {
        $user = $this->AdminuserModel->getUserById($id); // Lấy thông tin người dùng theo ID
        require_once APP_PATH . '/admin/views/user/edit.php'; // Hiển thị form sửa thông tin
    }

    // Xử lý cập nhật thông tin người dùng
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin người dùng từ form
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';

            // Kiểm tra nếu email đã được sử dụng bởi người khác
            $existingUser = $this->AdminuserModel->getUserByEmail($email);
            if ($existingUser && $existingUser['id'] != $id) {
                echo "Email này đã tồn tại!";
                return;
            }

            // Cập nhật người dùng
            if ($this->AdminuserModel->updateUser($id, $name, $email)) {
                header('Location: /admin/user/index');
                exit();
            } else {
                echo "Cập nhật người dùng thất bại!";
            }
        }
    }

    // Xóa người dùng
    public function delete($id) {
        // Xác nhận trước khi xóa
        if ($this->AdminuserModel->deleteUser($id)) {
            header('Location: /admin/user/index');
            exit();
        } else {
            echo "Xóa người dùng thất bại!";
        }
    }
}
?>
