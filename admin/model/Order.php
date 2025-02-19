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
        $sql = "SELECT o.*, u.username AS user_name 
        FROM orders o 
        JOIN users u ON o.user_id = u.user_id 
        ORDER BY o.order_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }
}
