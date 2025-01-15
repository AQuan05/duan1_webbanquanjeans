<?php
require_once '../commons/function.php';
include '../admin/view/layout/header.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'listProducts':
        include '../admin/view/pagines/product/listProducts.php'; // Đảm bảo đường dẫn đúng
        break;
    case 'addProducts':
        include '../admin/view/pagines/product/addProducts.php';
        break;
    case 'editProducts':
        include '../admin/view/pagines/product/editProducts.php';
        break;
    case 'listCategories':
        include '../admin/view/pagines/category/listCategories.php';
        break;
    case 'addCategories':
        include '../admin/view/pagines/category/addCategories.php';
        break;
    case 'editCategories':
        include '../admin/view/pagines/category/editCategories.php';
        break;
    case 'listVariants':
        include '../admin/view/pagines/variants product/listVariants.php';
        break; 
    case 'addVariants':
        include '../admin/view/pagines/variants product/addVariants.php';
        break;
    case 'editVariants':
        include '../admin/view/pagines/variants product/editVariants.php';
        break;
    default:
        include '../admin/view/pagines/home.php';
}

include '../admin/view/layout/footer.php';
?>