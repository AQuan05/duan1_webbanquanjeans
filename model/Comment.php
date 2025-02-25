<?php

class Comment
{
    public $conn;

    public function __construct()
    {
        $this->conn = DB();
    }

    // Kiểm tra đơn hàng có hoàn thành hay chưa
    public function isOrderCompleted($order_id, $user_id)
    {
        $query = "SELECT COUNT(*) 
                  FROM orders o 
                  JOIN users u ON o.user_id = u.user_id
                  WHERE o.order_id = ? AND o.user_id = ? AND o.status_id = 4";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$order_id, $user_id]);
        return $stmt->fetchColumn() > 0;
    }
    // Kiểm tra xem sản phẩm trong đơn hàng đã được đánh giá chưa
    public function hasCommented($user_id, $product_id) {
        $sql = "SELECT COUNT(*) FROM comments WHERE user_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $product_id]);
        return $stmt->fetchColumn() > 0;
    }
    // Thêm đánh giá
    public function addComment($order_id, $product_id, $user_id, $content)
    {
        if ($this->hasCommented($order_id, $product_id, $user_id)) {
            return false; // Không cho phép đánh giá lần thứ 2
        }
        $query = "INSERT INTO comments (order_id, product_id, user_id, content) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$order_id, $product_id, $user_id, $content]);
    }
    // Lấy đánh giá của một sản phẩm trong đơn hàng
    public function getCommentsByProduct($product_id, $order_id)
{
    $query = "SELECT c.content, u.username, c.created_at 
              FROM comments c 
              JOIN users u ON c.user_id = u.user_id 
              WHERE c.product_id = ? AND c.order_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$product_id, $order_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
