<?php

class shopModel{
    public $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    function allProducts(){
    $sql = "SELECT * FROM products order by product_id DESC";
    return $this->conn->query($sql)->fetchAll();
    }
    function cat_pro($id){
        $sql = "SELECT * FROM products WHERE category_id = $id order by product_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }
    function allCategories(){
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    function searchProduct($key){
        $sql = "SELECT * FROM products WHERE product_name LIKE '%".$key."%'";
        return $this->conn->query($sql)->fetchAll();
    }
}