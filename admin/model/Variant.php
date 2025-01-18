<?php

class Variant {
    public $conn;

    public function __construct() {
        $this->conn = DB();
    }
    function listVariantsModel() {
        $sql = "SELECT * FROM variants JOIN products ON variants.product_id = products.product_id";
        return $this->conn->query($sql)->fetchAll();
    }

    function addVariantsModel($color, $size, $product_id) {
        $sql = "INSERT INTO variants (color, size, product_id) VALUES ('$color', '$size', '$product_id')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
}