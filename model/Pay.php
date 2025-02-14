<?php
class Pay{
    public $conn;
    public function __construct(){
        $this->conn = DB();
    }
    public function createOrder($user_id, $total_price,$user_address,$Phone){
        $sql = "INSERT INTO orders (user_id, total_price, user_address, Phone) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $total_price, $user_address, $Phone]);
        return $this->conn->lastInsertId();
    }
    public function addOrderItems($order_id,$cart_items){
        $sql = "INSERT INTO order_items (order_id, order_name, quantity, price) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        foreach($cart_items as $item){
            $stmt->execute([$order_id, $item['order_name'], $item['quantity'], $item['price']]);
        }
    }
}