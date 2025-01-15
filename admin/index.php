<?php
ob_start();
require_once '../commons/function.php';
//model
include '../admin/view/layout/header.php';
require_once '../admin/model/Category.php';
//controller
require_once '../admin/controller/categoriesController.php';


$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'listCategories':
        $categoriesController = new categoriesController();
        $categoriesController->listCategoriesController();
        break;
    case 'addCategories':
        $categoriesController = new categoriesController();
        $categoriesController->addCategoriesController();
        break;
    case 'deleteCategories':
        $categoriesController = new categoriesController();
        $categoriesController->deleteCategoriesController($_GET['category_id']);
        break;
}

include '../admin/view/layout/footer.php';
ob_end_flush();
?>