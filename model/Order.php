<?php
class Order
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function getOrdersByUserAndStatus($user_id, $status = "")
    {
        $sql = "SELECT o.order_id, o.total_price, o.status_id, o.user_id,u.username, s.status_name, o.created_at 
                FROM orders o 
                JOIN status s ON o.status_id = s.status_id 
                JOIN users u ON o.user_id = u.user_id
                WHERE o.user_id = :user_id";
    
        // Nếu có lọc theo trạng thái, thêm điều kiện vào SQL
        if ($status !== "") {
            $sql .= " AND o.status_id = :status";
        }
    
        $sql .= " ORDER BY o.order_id DESC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        if ($status !== "") {
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // 1️⃣ Lấy thông tin đơn hàng theo order_id
    public function getOrderById($order_id)
    {
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
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug kiểm tra dữ liệu

        return $order;
    }

    public function getOrderItemsByOrderId($order_id)
    {
        $sql = "SELECT  
                    p.product_id,  -- Thêm product_id để sử dụng khi đánh giá
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

    public function getAllOrders($status = null)
    {
        $sql = "SELECT orders.*, status.status_name 
                FROM orders 
                JOIN status ON orders.status_id = status.status_id";

        if ($status !== null && $status !== '') {
            $sql .= " WHERE orders.status_id = :status";
        }

        $stmt = $this->conn->prepare($sql);

        if ($status !== null && $status !== '') {
            $stmt->execute(['status' => $status]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll();
    }
    public function cancelOrder($order_id)
    {
        // Câu lệnh SQL để cập nhật trạng thái đơn hàng thành "Đã hủy" (status_id = 0), chỉ với điều kiện là đơn hàng thuộc về user_id cụ thể
        $query = "UPDATE orders SET status_id = 0 WHERE order_id = :order_id AND status_id IN (1, 2)";
        $stmt = $this->conn->prepare($query);
    
        // Gắn giá trị vào các tham số trong câu lệnh SQL
        $stmt->bindParam(':order_id', $order_id);
    
        // Thực thi câu lệnh
        return $stmt->execute();
    }
    
}
