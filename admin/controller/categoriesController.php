<?php
require_once '../admin/model/Category.php';

class categoriesController
{
    public $categories;
    public function __construct()
    {
        $this->categories = new Category();
    }
    public function listCategoriesController()
    {
        $Categories = $this->categories->listCategoriesModel();
        require_once '../admin/view/pagines/category/listCategories.php';
    }
    function addCategoriesController()
    {
        require_once '../admin/view/pagines/category/addCategories.php';
        if (isset($_POST['addCate'])) {
            $name = $_POST['name_cate'];
            if($this->categories->addCategoriesModel($name)){
                echo '<script>alert("Thêm thành công")</script>';
                header("Location:admin/index.php?act=listCategories");
                
            } else {
                echo '<script>alert("Thêm thất bại")</script>';
            }
        }
    }
}    
