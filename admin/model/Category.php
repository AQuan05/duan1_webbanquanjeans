<?php

class Category{
    public $conn;

    public function __construct(){
        $this->conn = DB();
    }

    function listCategories() {
        $sql = "SELECT * FROM categories";    
        return $this->conn->query($sql)->fetchAll();
    }
    function addCategory($name) {
        $sql = "INSERT INTO `categories`(`category_name`) VALUES ('$name')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function editCategory($name){
        $sql = "UPDATE `categories` SET `category_name`='$name' WHERE 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function deleteCategory($id){
        $sql = "DELETE FROM `categories` WHERE category_id = $id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
}