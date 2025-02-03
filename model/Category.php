<?php

class Category{
    public function __construct() {
        $this->conn = DB();
    }
    function getCategory() {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    
}