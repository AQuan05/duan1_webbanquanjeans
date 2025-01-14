<?php
class Product{
    public $conn;
    public function __construct(){
        $this->conn = DB();
    }
    function listProduct(){
        $sql = "SELECT * FROM product";
        return $this->conn->query($sql)->fetchAll();
    }
}