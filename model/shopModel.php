<?php

class shopModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    function allProducts()
    {
        $sql = "SELECT 
    p.*, 
    v.*,
    c.category_name
FROM 
    products p
JOIN 
    variants v ON p.product_id = v.product_id
JOIN
    categories c ON p.category_id = c.category_id   
ORDER BY 
    p.product_id DESC;";
        return $this->conn->query($sql)->fetchAll();
    }
    function getProductByIdModel($product_id)
    {
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
    function cat_pro($id)
    {
        $sql = "SELECT 
    p.*, 
    v.*, 
    c.color_name, 
    s.size_name,
    cat.category_name  -- Thêm cột category_name từ bảng category
FROM 
    products p
JOIN 
    variants v ON p.product_id = v.product_id
JOIN 
    color c ON v.color_id = c.color_id 
JOIN 
    size s ON v.size_id = s.size_id
JOIN
    categories cat ON p.category_id = cat.category_id  -- Kết nối với bảng category
WHERE p.category_id = $id
ORDER BY p.product_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }
    function allCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    function searchProduct($key)
    {
        $sql = "SELECT * FROM products WHERE product_name LIKE '%" . $key . "%'";
        return $this->conn->query($sql)->fetchAll();
    }
}
