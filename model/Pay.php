<?php
class Pay {
    public $conn;
    
    public function __construct() {
        $this->conn = DB();
    }
    
    public function createOrderWithItems($user_id, $total_price, $user_address, $phone, $cart_items) {
        try {
            $this->conn->beginTransaction();
            
            // Tạo đơn hàng
            $sql = "INSERT INTO `orders` (user_id, total_price, user_address, Phone) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id, $total_price, $user_address, $phone]);
            $order_id = $this->conn->lastInsertId();
            
            // Kiểm tra nếu giỏ hàng trống
            if (!empty($cart_items)) {
                $sql = "INSERT INTO `order_items` (order_id, order_name, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                foreach ($cart_items as $item) {
                    $order_name = $item['cart_name'] ?? 'Unknown Product'; // Gán giá trị mặc định nếu thiếu
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
    
    // public function deleteCart($id_cart) {
    //     $sql = "DELETE FROM `carts` WHERE cart_id = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([$id_cart]);
    // }
}