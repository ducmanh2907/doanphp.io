<?php
// Định nghĩa hằng số đường dẫn
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

// Bắt đầu session để lấy user_id
session_start();

// Autoload các class từ thư mục app
spl_autoload_register(function ($class_name) {
    $directories = [APP_PATH . '/controllers', APP_PATH . '/models', APP_PATH . '/services'];

    foreach ($directories as $dir) {
        $file = $dir . '/' . str_replace('\\', '/', $class_name) . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    die("Không tìm thấy file: " . $class_name);
});

// Khởi tạo kết nối cơ sở dữ liệu
require_once APP_PATH . '/config/database.php';
$database = new Database();
$db = $database->getConnection();

// Lấy user_id từ session (giả sử đã đăng nhập)
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Kiểm tra controller và action từ URL
$controller_name = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'ProductController';
$action_name = isset($_GET['action']) ? $_GET['action'] : 'index';


// Kiểm tra file controller có tồn tại không
$controller_path = APP_PATH . "/controllers/{$controller_name}.php";
if (!file_exists($controller_path)) {
    header("HTTP/1.0 404 Not Found");
    die("404 Not Found - Không tìm thấy controller: $controller_name");
}

// Gọi controller
require_once $controller_path;
if (!class_exists($controller_name)) {
    header("HTTP/1.0 404 Not Found");
    die("404 Not Found - Controller không tồn tại: $controller_name");
}

// Khởi tạo controller
$controller = new $controller_name($db);

// Kiểm tra phương thức action có tồn tại trong controller không
if (!method_exists($controller, $action_name)) {
    header("HTTP/1.0 404 Not Found");
    die("404 Not Found - Action không tồn tại: $action_name");
}

// Xử lý các action yêu cầu phương thức POST
$post_actions = ['add', 'remove', 'clear', 'checkout'];
if (in_array($action_name, $post_actions) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.0 405 Method Not Allowed");
    die("Lỗi: Hành động '$action_name' chỉ được phép sử dụng phương thức POST.");
}

// Thực thi action với tham số userId nếu có
if ($action_name === 'remove' && isset($_GET['id'])) {
    $controller->$action_name($userId, $_GET['id']);
} else {
    $controller->$action_name($userId);
}
?>
