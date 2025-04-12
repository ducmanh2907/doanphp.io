<?php
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/..');

session_start();

spl_autoload_register(function ($class_name) {
    $directories = [APP_PATH . '/controllers', APP_PATH . '/models', APP_PATH . '/services'];
    foreach ($directories as $dir) {
        $file = $dir . '/' . str_replace('\\', '/', $class_name) . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

require_once APP_PATH . '/config/database.php';

$controller_param = $_GET['controller'] ?? 'adminproduct';
$action_name = $_GET['action'] ?? 'index';

// Format tên controller: adminproduct => AdminProductController
$controller_parts = preg_split('/[_-]/', $controller_param);
$controller_class = '';
foreach ($controller_parts as $part) {
    $controller_class .= ucfirst(strtolower($part));
}
$controller_name = $controller_class . 'Controller';

// Đường dẫn đến file controller
$controller_path = APP_PATH . "/admin/controllers/{$controller_name}.php";
if (!file_exists($controller_path)) {
    header("HTTP/1.0 404 Not Found");
    die("404 Not Found - Không tìm thấy controller: $controller_name");
}

require_once $controller_path;

if (!class_exists($controller_name)) {
    header("HTTP/1.0 404 Not Found");
    die("404 Not Found - Controller không tồn tại: $controller_name");
}

// ✅ Khởi tạo controller (không truyền $db vào constructor nữa)
$controller = new $controller_name();

// ✅ Xử lý POST-only methods
$post_actions = ['save', 'update', 'delete'];
if (in_array($action_name, $post_actions) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.0 405 Method Not Allowed");
    die("Lỗi: Hành động '$action_name' chỉ được phép dùng phương thức POST.");
}

// ✅ Gọi action tương ứng
if (isset($_GET['id']) && in_array($action_name, ['show', 'edit', 'delete'])) {
    $controller->$action_name($_GET['id']);
} elseif (isset($_GET['date']) && $action_name === 'revenueByDay') {
    $controller->$action_name($_GET['date']);
} elseif (isset($_GET['month'], $_GET['year']) && $action_name === 'revenueByMonth') {
    $controller->$action_name($_GET['month'], $_GET['year']);
} else {
    // Với action không cần tham số (như index, save)
    $controller->$action_name();
}
