<?php
require_once '../admin/model/Category.php';

class categoriesController
{
    public $categories;
    public function __construct()
    {
        $this->categories = new Category();
    }
    public function listCategories()
    {
        $Categories = $this->categories->listCategories();
        require_once '../admin/view/pagines/category/listCategories.php';
    }
    function addCategory() {
        if(isset($_POST['add']) && ($_POST['add'])) {
            $name = $_POST['name'];
            $this->categories->addCategory($name);
        }
        require_once '../admin/view/pagines/category/listCategories.php';
    }
}
