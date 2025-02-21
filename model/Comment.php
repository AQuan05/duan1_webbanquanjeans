<?php

class Comment {
    public $conn;

    public function __construct() {
        $this->conn = DB();
    }

    // Kiểm tra đơn hàng có hoàn thành hay chưa
    public function isOrderCompleted($order_id, $user_id) {
        $query = "SELECT COUNT(*) FROM orders WHERE order_id = ? AND user_id = ? AND status_id = 4";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$order_id, $user_id]);
        return $stmt->fetchColumn() > 0;
    }

    // Kiểm tra xem sản phẩm trong đơn hàng đã được đánh giá chưa
    public function hasCommented($order_id, $product_id, $user_id) {
        $query = "SELECT COUNT(*) FROM comments WHERE order_id = ? AND product_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$order_id, $product_id, $user_id]);
        return $stmt->fetchColumn() > 0;
    }

    // Thêm đánh giá
    public function addComment($order_id, $product_id, $user_id, $content, $rating) {
        if ($this->hasCommented($order_id, $product_id, $user_id)) {
            return false; // Không cho phép đánh giá lần thứ 2
        }
        $query = "INSERT INTO comments (order_id, product_id, user_id, content, rating) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$order_id, $product_id, $user_id, $content, $rating]);
    }

    // Lấy đánh giá của một sản phẩm trong đơn hàng
    public function getCommentByProduct($order_id, $product_id) {
        $query = "SELECT content, rating FROM comments WHERE order_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$order_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
