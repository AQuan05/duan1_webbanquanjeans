<?php

class Product
{
    public $conn;

    public function __construct()
    {
        $this->conn = DB();
    }
    public function getTop8Product($limit)
    {
        $stmt = $this->conn->prepare("
    SELECT pro.*, categories.category_name 
    FROM products pro
    JOIN categories ON pro.category_id = categories.category_id 
    WHERE categories.status = 'Active'
    ORDER BY pro.product_id DESC 
    LIMIT :limit");

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
