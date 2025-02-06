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
    public function cat_pro($id)
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
    public function VariantsByProductId($product_id)
    {
        $sql = "SELECT variants.size_id, variants.color_id, variants.price, size.size_name, color.color_name
                FROM variants
                JOIN size ON variants.size_id = size.size_id
                JOIN color ON variants.color_id = color.color_id
                WHERE variants.product_id = $product_id";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
