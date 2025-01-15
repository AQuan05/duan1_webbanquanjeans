<?php
class Product
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    function listProductModel()
    {
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql)->fetchAll();
    }
    function addProductModel($product_name, $image, $category_id, $description)
    {
        $sql = "INSERT INTO products (product_name, image, category_id, description) VALUES ('$product_name', '$image', '$category_id', '$description')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function getProductsWithCategoryNames()
    {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
        // Chuẩn bị và thực thi truy vấn
        // $stmt = $conn->prepare($sql);
        // $stmt->execute();

        // Trả về kết quả dưới dạng mảng
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function deleteProductModel($product_id)
    {
        $sql = "DELETE FROM `products` WHERE `product_id` = $product_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
}


// $sql = "SELECT products.product_id, 
// products.product_name, 
// products.image, 
// products.description AS product_description,
// products.status AS product_status,
// categories.category_name
// FROM 
// products products
// INNER JOIN 
// categories categories
// ON 
// products.category_id = categories.category_id;";