<?php
require_once '../commons/function.php';
//model
require_once '../admin/model/Category.php';
require_once '../admin/controller/productController.php';
//controller
require_once '../admin/controller/categoriesController.php';
require_once '../admin/controller/productController.php';
include '../admin/view/layout/header.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'listCategories':
        $categoriesController = new categoriesController();
        $categoriesController->listCategories();
        break;
    case 'addCategories':
        $categoriesController = new categoriesController();
        $categoriesController->addCategory();
        break;
    case 'deleteCategories':
        $categoriesController = new categoriesController();
        $categoriesController->deleteCategory($_GET['id']);
        break;
    // case 'editCategories':
    //     $categoriesController = new categoriesController(); 
    //     $categoriesController->editCategory();
    //     break;
    case 'listProducts':
        $productController = new productController();
        $productController->listProduct();
        break;
}

include '../admin/view/layout/footer.php';
?>