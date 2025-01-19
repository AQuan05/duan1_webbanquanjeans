<?php

class Size {
    public $conn;

    public function __construct(){
        $this->conn = DB();
    }
    public function listSizeModel(){
        $sql = "SELECT * FROM size";
        return $this->conn->query($sql)->fetchAll();
    }
    public function addSizeModel($size_name){
        $sql = "INSERT INTO size (size_name) VALUES ('$size_name')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    public function findSizeModelById($size_id){
        $sql = "SELECT * FROM size WHERE size_id = $size_id";
        return $this->conn->query($sql)->fetch();
    }
}