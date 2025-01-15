<?php
ob_start();
ob_start();
require_once '../commons/function.php';
//model
include '../admin/view/layout/header.php';
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
}

include '../admin/view/layout/footer.php';
ob_end_flush();
ob_end_flush();
?>