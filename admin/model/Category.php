<?php

class Category
{
    public $conn;

    public function __construct()
    {
        $this->conn = DB();
    }

    function listCategoriesModel()
    {
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    function addCategoriesModel($category_name,$status)
    {
        $sql = "INSERT INTO categories (category_name, status) VALUES ('$category_name', '$status')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    function deleteCategoriesModel($category_id)
    {
        $sql = "DELETE FROM categories WHERE category_id = $category_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    } 
    function updateCategoriesModel($category_id, $category_name, $status){

        $sql = "UPDATE categories SET category_name = '$category_name' , status = '$status' WHERE category_id = $category_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    function findCategoryModel($category_id)
    {
        $sql = "SELECT * FROM categories WHERE category_id = $category_id";
        return $this->conn->query($sql)->fetch();
    }
}



