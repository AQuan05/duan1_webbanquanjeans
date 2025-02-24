<?php
class Product
{
    public $conn;
    public function __construct()
    {
        $this->conn = DB();
    }
    public function listProductModel()
    {
        $sql = "SELECT * FROM products JOIN categories ON products.category_id = categories.category_id ORDER BY products.product_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }
    public function addProductModel($product_name, $image, $category_id, $description, $price)
    {
        $sql = "INSERT INTO products (product_name, image, category_id, description, price) 
            VALUES (:product_name, :image, :category_id, :description, :price)";
        $stmt = $this->conn->prepare($sql);

        // Bind các giá trị vào placeholder
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        return $stmt->execute();
    }

    public function getProductsWithCategoryNames()
    {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    public function deleteProductModel($product_id)
    {
        try {
            // Xóa dữ liệu trong bảng products
            $sqlProducts = "DELETE FROM `products` WHERE `product_id` = :product_id";
            $stmtProducts = $this->conn->prepare($sqlProducts);
            $stmtProducts->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            return $stmtProducts->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateProductModel($product_id, $product_name, $image, $category_id, $description, $price)
    {
        $sql = "UPDATE `products` SET `product_name` = '$product_name', `image` = '$image', `category_id` = '$category_id', `description` = '$description',`price` = '$price' WHERE `product_id` = $product_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    public function findProductModel($product_id)
    {
        $sql = "SELECT * FROM `products` WHERE `product_id` = $product_id";
        return $this->conn->query($sql)->fetch();
    }
    public function getLastInsertedId()
    {
        return $this->conn->LastInsertId();
    }
    public function getVariantProductId()
    {
        // $sql = "SELECT * FROM variant WHERE "
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