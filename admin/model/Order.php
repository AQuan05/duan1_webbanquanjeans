<?php

class Order
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB();
    }
    public function getOrdersWithUsernames()
    {
        $sql = "SELECT o.*, u.username AS user_name, s.status_name 
        FROM orders o
        JOIN users u ON o.user_id = u.user_id
        JOIN status s ON o.status_id = s.status_id
        ORDER BY o.order_id DESC;
        ";
        return $this->conn->query($sql)->fetchAll();
    }
    public function getOrderDetails($order_id)
    {
        $sql = "SELECT 
                o.order_id, 
                o.total_price, 
                o.order_reason, 
                o.user_address, 
                o.phone, 
                o.pttt, 
                o.created_at, 
                o.updated_at, 
                p.image,
                u.username, 
                s.status_name,
                o.status_id, 
                oi.product_name, 
                oi.quantity, 
                oi.price
            FROM orders o
            JOIN users u ON o.user_id = u.user_id
            JOIN status s ON o.status_id = s.status_id
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            WHERE o.order_id = $order_id";
        return $this->conn->query($sql)->fetchAll();
    }
    public function getAllStatuses()
    {
        $sql = "SELECT * FROM status";
        return $this->conn->query($sql)->fetchAll();
    }
    public function updateOrderStatus($order_id, $status_id)
    {
        $sql = "UPDATE orders SET status_id = :status_id, updated_at = NOW() WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        return $stmt->execute();
    }    
    public function getOrderById($order_id)
    {
        $sql = "SELECT * FROM orders WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
