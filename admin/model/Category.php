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
        $sql = "INSERT INTO `categories` VALUES (null'$name')";
        return $this->conn->query($sql);
    }
}