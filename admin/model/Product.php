<?php
class Product{
    public $conn;
    public function __construct(){
        $this->conn = DB();
    }
    function listProduct(){
        $sql = "SELECT * FROM products";
        return $this->conn->query($sql)->fetchAll();
    }
}