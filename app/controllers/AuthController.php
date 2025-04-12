<?php


require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/UserModel.php');

$database = new Database(); // Khởi tạo đối tượng Database
$db = $database->getConnection(); // Lấy kết nối cơ sở dữ liệu

// Khởi tạo mô hình AdminUserModel với kết nối cơ sở dữ liệu
$userModel = new UserModel($db);

// Tiếp tục với logic đăng nhập
if (isset($_POST['email']) && isset($_POST['password'])) {
    $user = $userModel->getUserByEmail($_POST['email']); // Lấy thông tin người dùng qua email

    // Kiểm tra thông tin đăng nhập
    if ($user && password_verify($_POST['password'], $user['password'])) {
        session_start(); // Khởi tạo phiên làm việc

     
  // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user'] = $user;  // Lưu toàn bộ thông tin người dùng vào session
        // Chuyển hướng người dùng theo vai trò
        if ($user['role'] === 'admin') {
            header("Location: /webbanhang/app/admin/views/admin.php"); // Nếu là admin, chuyển đến trang quản trị
        } else {
            header("Location: /webbanhang/app/views/trangchu.php"); // Nếu là user thường, chuyển đến trang home
        }
        exit(); // Đảm bảo không có code nào chạy tiếp sau khi chuyển hướng
    } else {
        echo "Sai email hoặc mật khẩu!";
    }
}
class AuthController {
    private $userModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->userModel = new UserModel($db);
    }

    // ✅ Xử lý đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            $result = $this->userModel->registerUser($name, $email, $password, $phone, $address);

            if ($result === true) {
                header("Location: /webbanhang/app/views/login.php?success=1");
                exit();
            } else {
                $_SESSION['error'] = $result;
                header("Location: /webbanhang/app/views/register.php");
                exit();
            }
        }
    }

    // ✅ Xử lý đăng nhập
   public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Lấy người dùng từ cơ sở dữ liệu
        $user = $this->userModel->getUserByEmail($email); // Lấy thông tin người dùng qua email

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            session_start(); // Khởi tạo phiên làm việc

            // Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng người dùng theo vai trò
            if ($user['role'] === 'admin') {
                header("Location: /webbanhang/app/admin/views/admin.php");
            } else {
                header("Location: /webbanhang/app/views/trangchu.php");
            }
            exit(); // Dừng thực thi tiếp
        } else {
            $_SESSION['error'] = "Email hoặc mật khẩu không đúng!";
            header("Location: /webbanhang/app/views/login.php");
            exit(); // Dừng thực thi tiếp
        }
    }
}


    // ✅ Xử lý đăng xuất
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /webbanhang/app/views/login.php");
        exit();
    }
}

// ✅ Bắt `action` từ URL
$authController = new AuthController();

if (isset($_GET['action']) && method_exists($authController, $_GET['action'])) {
    $authController->{$_GET['action']}();
}
?>
