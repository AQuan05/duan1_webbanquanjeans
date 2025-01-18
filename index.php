<?php
require_once 'commons/function.php';
include 'view/layout/header.php';
if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];
    switch ($act) {
        case 'viewcart':
            include 'view/pagines/cart/viewcart.php';
            break;
        case 'checkout':
            include 'view/pagines/cart/checkout.php';
            break;
        case 'register':
            include 'view/pagines/acc/register.php';
            break;
        case 'login':
            include 'view/pagines/acc/login.php';
            break;
        case 'ProductCategory':
            include 'view/pagines/product/ProductCategory.php';
            break;
        case 'ProductDetail':
            include 'view/pagines/product/ProductDetail.php';
            break;
        case 'About':
            include 'view/pagines/pages/About.php';
            break;
        case 'Contact':
            include 'view/pagines/pages/Contact.php';
            break;
        case 'Policy':
            include 'view/pagines/pages/Policy.php';
            break;
        case 'Faq':
            include 'view/pagines/pages/Faq.php';
            break;
    }
} else {
    include 'view/pagines/home.php';
}
include 'view/layout/footer.php';
