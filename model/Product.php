<?php

class Product {
    public $conn;
    public function __construct() {
        $this->conn = DB();
    }
    function getProductModel() {
        $sql = "SELECT * FROM products JOIN variants ON products.product_id = variants.product_id";
        return $this->conn->query($sql)->fetchAll();
    }
    function getProductByIdModel($product_id) {
        $sql = "SELECT 
                    p.*, 
                    v.*, 
                    c.color_name, 
                    s.size_name
                FROM 
                    products p
                JOIN 
                    variants v ON p.product_id = v.product_id
                JOIN 
                    color c ON v.color_id = c.color_id 
                JOIN 
                    size s ON v.size_id = s.size_id
                WHERE 
                    p.product_id = $product_id"; 
        return $this->conn->query($sql)->fetch();
    }
    function getProductsByCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = $category_id";
        return $this->conn->query($sql)->fetchAll();
    }
    
}