<?php
// Bao gồm file kết nối CSDL
require_once(__DIR__ . "/../../../config/database.php");

// Tạo đối tượng Database và lấy kết nối
$database = new Database();
$conn = $database->getConnection();

// Khởi tạo các biến nếu chưa có
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); // Mặc định là ngày hiện tại
$month = isset($_GET['month']) ? $_GET['month'] : date('n');  // Mặc định là tháng hiện tại
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');     // Mặc định là năm hiện tại

// Truy vấn doanh thu theo ngày
$stmt = $conn->prepare("SELECT SUM(o.total_price) AS total_revenue
                        FROM orders o
                        WHERE DATE(o.created_at) = ?");
$stmt->execute([$date]);
$revenueByDay = $stmt->fetch(PDO::FETCH_ASSOC);

// Truy vấn doanh thu theo tháng
$stmt = $conn->prepare("SELECT SUM(o.total_price) AS total_revenue
                        FROM orders o
                        WHERE MONTH(o.created_at) = ? AND YEAR(o.created_at) = ?");
$stmt->execute([$month, $year]);
$revenueByMonth = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h1>Quản lý Doanh thu</h1>

<!-- Form Doanh thu theo ngày -->
<form method="GET" action="/webbanhang/app/admin/index.php" class="form-inline">
    <!-- Hidden input để chỉ định controller -->
    <input type="hidden" name="controller" value="adminorder">
    <input type="hidden" name="action" value="revenueByDay">

    <label for="date">Chọn ngày:</label>
    <input type="date" name="date" id="date" 
           value="<?php echo htmlspecialchars($date ?? date('Y-m-d'), ENT_QUOTES, 'UTF-8'); ?>" 
           class="form-control" required>

    <button type="submit" class="btn btn-primary">Xem doanh thu theo ngày</button>
</form>

<?php if (isset($_GET['action']) && $_GET['action'] === 'revenueByDay'): ?>
    <h3>Tổng doanh thu ngày <?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?>:</h3>
    <p><strong><?php echo number_format($revenue, 2); ?> đ</strong></p>
<?php endif; ?>

<hr>

<!-- Form Doanh thu theo tháng -->
<form method="GET" action="/webbanhang/app/admin/index.php" class="form-inline">
    <!-- Hidden input để chỉ định controller -->
    <input type="hidden" name="controller" value="adminorder">
    <input type="hidden" name="action" value="revenueByMonth">

    <label for="month">Chọn tháng:</label>
    <select name="month" id="month" class="form-control">
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo (isset($month) && $i == $month) ? 'selected' : ''; ?>>
                Tháng <?php echo $i; ?>
            </option>
        <?php endfor; ?>
    </select>

    <label for="year">Chọn năm:</label>
    <select name="year" id="year" class="form-control">
        <?php for ($i = 2020; $i <= date('Y'); $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo (isset($year) && $i == $year) ? 'selected' : ''; ?>>
                <?php echo $i; ?>
            </option>
        <?php endfor; ?>
    </select>

    <button type="submit" class="btn btn-primary">Xem doanh thu theo tháng</button>
</form>

<?php if (isset($_GET['action']) && $_GET['action'] === 'revenueByMonth'): ?>
    <h3>Tổng doanh thu tháng <?php echo htmlspecialchars($month, ENT_QUOTES, 'UTF-8'); ?>/<?php echo htmlspecialchars($year, ENT_QUOTES, 'UTF-8'); ?>:</h3>
    <p><strong><?php echo number_format($revenue, 2); ?> đ</strong></p>
<?php endif; ?>
