<?php
// require_once 'commons/function.php';

class Account
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function getUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserById($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addAccountModel($username, $email, $password)
    {
        try {
            // Bắt đầu transaction để đảm bảo tính nhất quán
            $this->conn->beginTransaction();

            // Chèn tài khoản vào bảng users
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $password
            ]);

            // Lấy user_id vừa tạo
            $userId = $this->conn->lastInsertId();

            // Tạo giỏ hàng mới cho user
            $cartSql = "INSERT INTO carts (user_id) VALUES (:user_id)";
            $cartStmt = $this->conn->prepare($cartSql);
            $cartStmt->execute([':user_id' => $userId]);

            // Xác nhận transaction
            $this->conn->commit();

            return $userId;
        } catch (Exception $e) {
            // Nếu có lỗi, rollback transaction
            $this->conn->rollBack();
            return false;
        }
    }
    public function checkUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu username đã tồn tại
    }

    // Kiểm tra email đã tồn tại hay chưa
    public function checkEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu email đã tồn tại
    }
    public function getCartByUserId($user_id)
    {
        try {
            // Truy vấn giỏ hàng của người dùng từ cơ sở dữ liệu
            $stmt = $this->conn->prepare("SELECT * FROM carts WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Trả về giỏ hàng của người dùng nếu có
        } catch (PDOException $e) {
            // Xử lý lỗi cơ sở dữ liệu
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function createCart($user_id)
    {
        try {
            // Tạo mới giỏ hàng cho người dùng
            $stmt = $this->conn->prepare("INSERT INTO carts (user_id) VALUES (:user_id)");
            $stmt->bindParam(':user_id', $user_id);
            return $stmt->execute();  // Trả về true nếu thành công, false nếu lỗi
        } catch (PDOException $e) {
            // Xử lý lỗi cơ sở dữ liệu
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function loginModel($email, $password)
    {
        // Truy vấn để kiểm tra người dùng trong cơ sở dữ liệu và lấy thông tin vai trò
        $stmt = $this->conn->prepare(
            "SELECT users.*, roles.role_name, roles.role_id 
        FROM users 
        INNER JOIN roles ON users.role_id = roles.role_id 
        WHERE users.email = :email AND users.password = :password"
        );
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : false;
    }
    public function updatePasswordModel($email, $newPassword)
    {
        // Sử dụng truy vấn chuẩn để tránh SQL Injection
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':email', $email);

        return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại
    }
    public function updateUser($id, $username, $email, $password, $status = null, $address = null, $phone = null) {
        $sql = "UPDATE users SET username = :username, password = :password,email = :email, status = :status, user_address = :address, user_phone = :phone";
        $params = [
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':status' => $status,
            ':address' => $address,
            ':phone' => $phone,
            ':id' => $id
        ];

        if ($password) {
            $sql .= ", password = :password";
            //  
        }

        $sql .= " WHERE user_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
}
