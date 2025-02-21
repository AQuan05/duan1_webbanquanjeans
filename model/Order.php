<?php
class Order
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function getOrderByUserId($user_id)
    {
        $sql = "SELECT o.order_id, o.user_id, o.total_price, o.status_id, s.status_name, o.created_at 
        FROM orders o 
        JOIN status s ON o.status_id = s.status_id 
        JOIN users u ON o.user_id = u.user_id
        WHERE o.user_id = :user_id
        ORDER BY o.order_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
       // 1️⃣ Lấy thông tin đơn hàng theo order_id
       public function getOrderById($order_id) {
        $sql = "SELECT 
                    o.order_id, 
                    o.user_id, 
                    o.total_price, 
                    o.status_id, 
                    s.status_name, 
                    o.created_at, 
                    o.user_address, 
                    o.Phone, 
                    o.pttt,
                    u.username
                FROM orders o
                JOIN users u ON o.user_id = u.user_id
                JOIN status s ON o.status_id = s.status_id
                WHERE o.order_id = :order_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getOrderItemsByOrderId($order_id) {
        $sql = "SELECT  
                    p.image,
                    p.product_name, 
                    oi.quantity, 
                    oi.price
                FROM order_items oi
                JOIN products p ON oi.product_id = p.product_id
                WHERE oi.order_id = :order_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
