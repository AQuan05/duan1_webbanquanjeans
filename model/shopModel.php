<?php

class shopModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function allProducts()
    {
        $sql = "SELECT
    p.*,
    c.category_name
FROM
    products p
JOIN
    categories c ON p.category_id = c.category_id
ORDER BY
    p.product_id DESC;";
        return $this->conn->query($sql)->fetchAll();
    }
    public function getProductByIdModel($product_id)
    {
        $sql = "SELECT
                p.*,
                c.category_name  -- Select category_name
            FROM
                products p
            JOIN
    categories c ON p.category_id = c.category_id
            WHERE
                p.product_id = $product_id";
        return $this->conn->query($sql)->fetch();
    }
    public function cat_pro($id)
    {
        $sql = "SELECT
                p.*,
                cat.category_name  -- Select category_name
            FROM
                products p
            JOIN
                categories cat ON p.category_id = cat.category_id  -- Join with categories table
            WHERE p.category_id = $id
            ORDER BY p.product_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }
    public function allCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    public function searchProduct($key)
    {
        $sql = "SELECT * FROM products WHERE product_name LIKE '%" . $key . "%'";
        return $this->conn->query($sql)->fetchAll();
    }
    public function getProductById($product_id)
    {
        if (!$product_id) return false; // Nếu product_id rỗng, trả về false để tránh lỗi SQL
        
        $sql  = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     
}
