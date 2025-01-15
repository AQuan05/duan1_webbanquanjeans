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
        $categoriesController = new categoriesController();
        $categoriesController->listCategories();
        break;
        

}

include '../admin/view/layout/footer.php';
?>