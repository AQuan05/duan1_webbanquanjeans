<?php

class Variant {
    public $conn;

    public function __construct() {
        $this->conn = DB();
    }
    function listVariantsModel() {
        $sql = "SELECT * FROM variants JOIN products ON variants.product_id = products.product_id order by variants.variant_id desc";
        return $this->conn->query($sql)->fetchAll();
    }

    function addVariantsModel($color, $size, $product_id) {
        $sql = "INSERT INTO variants (color, size, product_id) VALUES ('$color', '$size', '$product_id')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function GetAllProducts(){
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql)->fetchAll();
    }
    function deleteVariantsModel($variant_id) {
        $sql = "DELETE FROM variants WHERE variant_id = $variant_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function findVariantsModel($variant_id) {
        $sql = "SELECT * FROM variants WHERE variant_id = $variant_id";
        return $this->conn->query($sql)->fetch();
    }
    function updateVariantsModel($variant_id, $color, $size, $product_id) {
        $sql = "UPDATE variants SET color = '$color', size = '$size', product_id = '$product_id' WHERE variant_id = $variant_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
}