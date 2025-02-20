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
    SELECT products.*, categories.category_name 
    FROM products 
    JOIN categories ON products.category_id = categories.category_id 
    ORDER BY products.product_id DESC 
    LIMIT :limit");

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
