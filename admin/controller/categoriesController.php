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
    public function addCategory()
    {
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $this->categories->addCategory($name);
            header('Location:?act=listCategories');
            exit();
        } else {
            include '../admin/view/pagines/category/addCategories.php';
        }
    }
    public function deleteCategory($id)
    {
        if ($this->categories->deleteCategory($id)) {
            echo "<script>alert('Xóa thành công!'); window.location.href = 'index.php?act=listCategories';</script>";
        } else {
            echo "<script>alert('Xóa thất bại!'); window.location.href = 'index.php?act=listCategories';</script>";
        }
        exit();
    }
}
