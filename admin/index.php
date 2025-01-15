<?php
require_once '../commons/function.php';
//model
require_once '../admin/model/Category.php';
//controller
require_once '../admin/controller/categoriesController.php';
include '../admin/view/layout/header.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    // case 'listCategories':
    //     $categoryController = new Category();
    //     $categoryController->listCategories();
    //     break;
    case 'listCategories':
        include '../admin/view/pagines/category/listCategories.php';
        break;
        
    default:
        include '../admin/view/pagines/home.php';
}

include '../admin/view/layout/footer.php';
?>