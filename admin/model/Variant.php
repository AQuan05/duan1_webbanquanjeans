<?php

class Variant
{
    public $conn;

    public function __construct()
    {
        $this->conn = DB();
    }
    function listVariantsModel()
    {
        $sql = "SELECT 
    variants.*, 
    products.product_name, 
    color.color_name, 
    size.size_name
FROM 
    variants
JOIN 
    products ON variants.product_id = products.product_id
JOIN 
    color ON variants.color_id = color.color_id
JOIN 
    size ON variants.size_id = size.size_id
ORDER BY 
    variants.variant_id DESC;
";
        return $this->conn->query($sql)->fetchAll();
    }

    public function addProductvariantsModel($product_id, $color_id, $size_id, $price)
    {
        $sql = "INSERT INTO `variants` (product_id, color_id, size_id, price) VALUES ($product_id, $color_id, $size_id, $price)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function GetAllProducts()
    {
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql)->fetchAll();
    }
    function deleteVariantsModel($variant_id)
    {
        $sql = "DELETE FROM variants WHERE variant_id = $variant_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function findVariantsModel($variant_id)
    {
        $sql = "SELECT * FROM variants WHERE variant_id = $variant_id";
        return $this->conn->query($sql)->fetch();
    }
    function updateVariantsModel($variant_id, $color, $size, $product_id, $price)
    {
        $sql = "UPDATE variants SET color = '$color', size = '$size', price = $price,product_id = '$product_id' WHERE variant_id = $variant_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    public function getVariantsByProductId($product_id)
    {
        $sql = "SELECT variants.size_id, variants.color_id, variants.price, size.size_name, color.color_name 
                FROM variants 
                JOIN size ON variants.size_id = size.size_id 
                JOIN color ON variants.color_id = color.color_id 
                WHERE variants.product_id = $product_id";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateProductVariantModel($variant_id, $size_id, $color_id, $price)
    {
        // Cập nhật thông tin biến thể trong cơ sở dữ liệu
        $sql = "UPDATE `variants` 
            SET `size_id` = $size_id, `color_id` = $color_id, `price` = $price 
            WHERE `variant_id` = $variant_id";
        $stmt = $this->conn->prepare($sql);
        // Thực thi và trả về kết quả
        return $stmt->execute();
    }
}
