<?php
class Database {
    private $host = "localhost";
    private $port = "3307"; // Thêm port
    private $db_name = "lucyper";
    private $username = "root";
    private $password = "";
    
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");

            // Kiểm tra kết nối thành công
                
        
        } catch (PDOException $exception) {
            // Nếu có lỗi, in thông báo lỗi
            echo "Lỗi kết nối: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
