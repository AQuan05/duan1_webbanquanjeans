<?php
require_once '../admin/model/Category.php';

class categoryController
{
    public $Category;
    public function __construct()
    {
        $this->Category = new Category();
    }
    public function listCategory()
    {
        $listCategories = $this->Category->listCategory();
        require_once '../admin/view/pagines/category/listCategories.php';
    }
    // public function addCategory()
    // {
    //     if (isset($_POST['addCate']) && $_POST['addCate']) {
    //         $name = $_POST['name'];
    //         $description = $_POST['description'];
            
    //     }
    // }
}
