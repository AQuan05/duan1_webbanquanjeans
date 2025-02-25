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
        // Lấy trạng thái hiện tại của đơn hàng
        $sql = "SELECT status_id FROM orders WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        $current_status = $stmt->fetchColumn();

        // Kiểm tra trạng thái mới chỉ tăng đúng 1 nấc
        if ($status_id == $current_status + 1) {
            $sql = "UPDATE orders SET status_id = :status_id, updated_at = NOW() WHERE order_id = :order_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            echo "Không thể cập nhật: Trạng thái không hợp lệ!";
            return false;
        }
    }
    public function getOrderStatus($order_id)
    {
        $sql = "SELECT status_id FROM orders WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['status_id'] : null;
    }
    public function sumOrdersStatusSuccess()
    {
        $sql = "SELECT SUM(total_price) as total FROM orders WHERE status_id = 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Trả về tổng giá hoặc 0 nếu không có kết quả
    }
    public function orderToady()
    {
        $sql = "SELECT COUNT(*) as total FROM orders WHERE DATE(created_at) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0;
    }


    public function getRevenueByDate() {
        $query = "SELECT DATE(created_at) as order_date, SUM(total_price) as total_revenue 
                  FROM orders 
                  GROUP BY DATE(created_at) 
                  ORDER BY order_date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dates = [];
        $revenues = [];
        foreach ($result as $row) {
            $dates[] = $row['order_date'];
            $revenues[] = (float)$row['total_revenue']; // Ép kiểu để tránh lỗi JS sau này
        }
        return ['dates' => $dates, 'revenues' => $revenues];
    }
    public function getOrderStatusRatio() {
        $query = "SELECT 
                    SUM(CASE WHEN status_id = 0 THEN 1 ELSE 0 END) as canceled,
                    SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as successful
                  FROM orders";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return [
            'canceled' => (int)($result['canceled'] ?? 0),
            'successful' => (int)($result['successful'] ?? 0)
        ];
    }
}
