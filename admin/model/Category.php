<?php

class Category{
    public $conn;

    public function __construct(){
        $this->conn = DB();
    }

    function listCategoriesModel(){
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    function addCategoriesModel($category_name){
        $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }



    function listCategories() {
        $sql = "SELECT * FROM categories";    
        return $this->conn->query($sql)->fetchAll();
    }
    function addCategory($name) {
        $sql = "INSERT INTO `categories` VALUES (null'$name')";
        return $this->conn->query($sql);
    }

}