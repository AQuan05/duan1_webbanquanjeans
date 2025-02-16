<?php
class Pay {
    public $conn;
    
    public function __construct() {
        $this->conn = DB();
    }
    
    public function createOrderWithItems($user_id, $total_price, $user_address, $phone, $pttt,$cart_items) {
        try {
            $this->conn->beginTransaction();
            $sql = "INSERT INTO `orders` (user_id, total_price, user_address, Phone,pttt) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id, $total_price, $user_address, $phone,$pttt]);
            $order_id = $this->conn->lastInsertId();

            if (!empty($cart_items)) {
                $sql = "INSERT INTO `order_items` (order_id, order_name, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                foreach ($cart_items as $item) {
                    $order_name = $item['cart_name'] ?? 'Unknown Product';
                    $quantity = $item['quantity'] ?? 1;
                    $price = $item['price'] ?? 0;
                    $stmt->execute([$order_id, $order_name, $quantity, $price]);
                }
            }
            $this->conn->commit();
            return $order_id;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }
    
    public function deleteCart($id_cart) {
        $sql = "DELETE FROM `cart_items` WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id_cart]);
    }
}