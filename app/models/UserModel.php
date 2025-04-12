<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
public function getUserByEmail($email) {
    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Trả về thông tin người dùng nếu tìm thấy
    return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về mảng hoặc null
}

    public function registerUser($name, $email, $password, $phone, $address) {
    try {
        $sql = "INSERT INTO users (name, email, password, phone, address) VALUES (:name, :email, :password, :phone, :address)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);

        $result = $stmt->execute();

        if (!$result) {
            print_r($stmt->errorInfo()); // Hiển thị lỗi SQL nếu có
        }

        return $result;
    } catch (PDOException $e) {
        echo "Lỗi PDO: " . $e->getMessage();
        return false;
    }
}


    public function loginUser($email, $password) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debug
    if (!$user) {
        echo "Không tìm thấy người dùng với email: $email";
    } else {
        echo "Tìm thấy người dùng: " . print_r($user, true);
    }

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

}
?>
