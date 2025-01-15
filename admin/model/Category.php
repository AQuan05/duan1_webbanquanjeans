<?php
class Category {
    public $conn;

    function __construct() {
        $this->conn = DB();
    }

    function listCategory() {
        $sql = "SELECT * FROM categories";    
        return $this->conn->query($sql)->fetchAll();
    }
    
}
