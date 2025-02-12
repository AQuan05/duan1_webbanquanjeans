<?php
// require_once 'commons/function.php';

class Account
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
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
    public function loginModel($username, $password)
    {
        // Truy vấn để kiểm tra người dùng trong cơ sở dữ liệu (chỉ kiểm tra theo username)
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Lưu thông tin người dùng vào session
            $_SESSION['user'] = $user;  // Kiểm tra xem dữ liệu có lưu vào session chưa
            header('Location: ?act=/'); // Chuyển hướng đến trang dashboard
            exit();
        } else {
            // Lỗi đăng nhập
            $_SESSION['error'] = "Invalid username or password.";
            header('Location: ?act=login'); // Quay lại trang login
            exit();
        }
    }
    public function updatePasswordModel($email, $newPassword)
    {
        // Sử dụng truy vấn chuẩn để tránh SQL Injection
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':email', $email);

        return $stmt->execute(); // Trả về true nếu thành công, false nếu thất bại
    }
}
