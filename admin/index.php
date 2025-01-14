<?php
require_once '../commons/function.php';
require_once '../admin/view/layout/header.php';
include '../admin/view/layout/sidebar.php';
$act = $_GET['act']?? '';
match($act){
    '/'=> (new productController())->listProduct(),
};
include '../admin/view/pagines/product/listProduct.php';
include '../admin/view/layout/footer.php';
