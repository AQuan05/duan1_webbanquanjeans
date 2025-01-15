<?php

class Category{
    public $conn;

    public function __construct(){
        $this->conn = DB();
    }
    function listCategories(){
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
}