<?php
ob_start();
require_once '../commons/function.php';
//model
require_once '../admin/model/Category.php';
require_once '../admin/model/Product.php';
require_once '../admin/model/Variant.php';
//controller
require_once '../admin/controller/categoriesController.php';
require_once '../admin/controller/productController.php';
require_once '../admin/controller/variantsController.php';
include '../admin/view/layout/header.php';

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
    case 'updateCategories':
        $categoriesController = new categoriesController();
        $categoriesController->updateCategoriesController($_GET['category_id']);

        break;
    case 'listProducts':
        $productsController = new productController();
        $productsController->listProductsController();
        break;
    case 'addProducts':
        $productsController = new productController();
        $productsController->addProductsController();
        break;
    case 'deleteProduct':
        $productsController = new productController();
        $productsController->deleteProductController($_GET['id']);
        break;
    case 'editProduct':
        $productsController = new productController();
        $productsController->updateProductController($_GET['id']);
        break;
    case 'listVariants':
        $variantsController = new variantsController();
        $variantsController->listVariantsController();
        break;
    case 'addVariants':
        $variantsController = new variantsController();
        $variantsController->addVariantsController();
        break;
}

include '../admin/view/layout/footer.php';
ob_end_flush();
