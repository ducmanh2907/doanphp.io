<?php

class AdminUserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Thêm người dùng vào database
    public function addUser($name, $email, $password, $phone, $address, $role = 'customer') {
    $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $password, $phone, $address, $role]);
}

    // Lấy thông tin user theo email
   public function getUserByEmail($email) {
    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Trả về thông tin người dùng nếu tìm thấy
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Lấy thông tin user theo ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật user
    public function updateUser($id, $name, $email) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $id]);
    }

    // Xóa user
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Lấy danh sách tất cả user
    // Lấy danh sách tất cả người dùng
public function getAllUsers() {
    $stmt = $this->db->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về một mảng chứa tất cả người dùng
}

}

?>
