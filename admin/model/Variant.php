<?php

class Variant {
    public $conn;

    public function __construct() {
        $this->conn = DB();
    }
    function listVariantsModel() {
        $sql = "SELECT * FROM product_variants JOIN products ON product_variants.product_id = products.product_id";
        return $this->conn->query($sql)->fetchAll();
    }

    function addVariantsModel($color, $size, $stock, $price, $product_id) {
        $sql = "INSERT INTO product_variants (color, size, stock, price, product_id) VALUES ('$color', '$size', '$stock', '$price', '$product_id')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
}