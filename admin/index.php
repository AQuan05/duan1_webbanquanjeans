<?php
require_once '../commons/function.php';
include '../admin/view/layout/header.php';
require_once '../admin/controller/categoryController.php';
require_once '../admin/model/Category.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'listProducts':
        include '../admin/view/pagines/product/listProducts.php'; // Đảm bảo đường dẫn đúng
        break;
    case 'listCategories':
        include '../admin/view/pagines/category/listCategories.php';
        break;
        
    default:
        include '../admin/view/pagines/home.php';
}

include '../admin/view/layout/footer.php';
?>