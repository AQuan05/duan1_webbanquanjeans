<!-- ========================================================= 
    Item Name: Carrot - Multipurpose eCommerce HTML Template.
    Author: ashishmaraviya
    Version: 2.1
    Copyright 2024
 ============================================================-->
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v21/carrot-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Jan 2025 17:41:06 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ecommerce, market, shop, mart, cart, deal, multipurpose, marketplace">
    <meta name="description" content="Carrot - Multipurpose eCommerce HTML Template.">
    <meta name="author" content="ashishmaraviya">

    <title>Carrot - Multipurpose eCommerce HTML Template</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="view/assets/img/logo/favicon.png">
    <!-- Icon CSS -->
    <link rel="stylesheet" href="view/assets/css/vendor/materialdesignicons.min.css">
    <link rel="stylesheet" href="view/assets/css/vendor/remixicon.css">

    <!-- Vendor -->
    <link rel="stylesheet" href="view/assets/css/vendor/animate.css">
    <link rel="stylesheet" href="view/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="view/assets/css/vendor/aos.min.css">
    <link rel="stylesheet" href="view/assets/css/vendor/range-slider.css">
    <link rel="stylesheet" href="view/assets/css/vendor/swiper-bundle.min.css">
    <link rel="stylesheet" href="view/assets/css/vendor/jquery.slick.css">
    <link rel="stylesheet" href="view/assets/css/vendor/slick-theme.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="view/assets/css/style.css">
    
</head>

<body class="body-bg-6">

    <!-- Loader -->
    <div id="cr-overlay">
        <span class="loader"></span>
    </div>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-header">
                        <a href="?act=/" class="cr-logo">
                            <img style="width: 50px ; height: 45px" src="view/assets/img/logo/logo-bg.png" alt="logo" class="logo">
                        </a>
                        <form class="cr-search" method="POST" action="?act=shop">
                            <input class="search-input" type="text" placeholder="Search For items..." name="search">
                            <button type="submit" class="search-btn">
                                <i class="ri-search-line"></i>
                            </button>
                        </form>
                        <div class="cr-right-bar">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>
                                            <?php
                                            // Kiểm tra xem người dùng đã đăng nhập chưa
                                            if (isset($_SESSION['user'])) {
                                                // Nếu đã đăng nhập, hiển thị tên người dùng
                                                echo $_SESSION['user']['username'];
                                            } else {
                                                // Nếu chưa đăng nhập, hiển thị "Account"
                                                echo "Account";
                                            }
                                            ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <?php if (!isset($_SESSION['user'])): ?>
                                            <!-- Nếu chưa đăng nhập, hiển thị các mục đăng ký và đăng nhập -->
                                            <li>
                                                <a class="dropdown-item" href="?act=register">Register</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="?act=login">Login</a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a class="dropdown-item" href="?act=listOrder&user_id=<?= $_SESSION['user']['user_id'] ?>">Danh sách đơn hàng</a>
                                            </li>
                                            <li>
                                                <a href="?act=editprofile&user_id=<?= $_SESSION['user']['user_id'] ?>" class="dropdown-item">Cập nhật thông tin</a>
                                            </li>
                                            <!-- Nếu đã đăng nhập, hiển thị mục "Logout" -->
                                            <li>
                                                <a class="dropdown-item" href="?act=logout">Logout</a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </li>
                            </ul>

                            <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle" onclick="window.location.href='?act=viewcart'">
                                <i class="ri-shopping-cart-line"></i>
                                <span>Cart</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cr-fix" id="cr-main-menu-desk">
            <div class="container">
                <div class="cr-menu-list">
                    <div class="cr-category-icon-block">
                        <div class="cr-category-menu">
                            <div class="cr-category-toggle">
                                <i class="ri-menu-2-line"></i>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg">
                        <a href="javascript:void(0)" class="navbar-toggler shadow-none">
                            <i class="ri-menu-3-line"></i>
                        </a>
                        <div class="cr-header-buttons">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="register.html">Register</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="checkout.html">Checkout</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="login.html">Login</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle">
                                <i class="ri-shopping-cart-line"></i>
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">

                                    <a class="nav-link" href="?act=/">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="?act=shop">
                                        Shop
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)">
                                        Pages
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="?act=About">About Us</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="?act=Contact">Contact Us</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="?act=Faq">Faq</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="?act=Policy">Policy</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)">
                                        Blog
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="blog-left-sidebar.html">Left
                                                Sidebar</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="blog-right-sidebar.html">Right
                                                Sidebar</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="blog-detail-left-sidebar.html">Detail
                                                Left
                                                Sidebar</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="blog-detail-right-sidebar.html">Detail
                                                Right
                                                Sidebar</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="blog-detail-full-width.html">Detail
                                                Full
                                                Width</a>
                                        </li>
                                    </ul>
                                </li> -->

                            </ul>
                        </div>
                    </nav>
                    <div class="cr-calling">
                        <i class="ri-phone-line"></i>
                        <a href="javascript:void(0)">+123 ( 456 ) ( 7890 )</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="cr-sidebar-overlay"></div>
    <div id="cr_mobile_menu" class="cr-side-cart cr-mobile-menu">
        <div class="cr-menu-title">
            <span class="menu-title">My Menu</span>
            <button type="button" class="cr-close">×</button>
        </div>
        <div class="cr-menu-inner">
            <div class="cr-menu-content">
                <ul>
                    <li class="dropdown drop-list">

                        <a href="?act=index">Home</a>

                        <a href="?act=listProducts">Home</a>

                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">Category</a>
                        <ul class="sub-menu">
                            <li><a href="?act=ProductCategory">Shop Left sidebar</a></li>
                        </ul>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">product</a>
                        <ul class="sub-menu">
                            <li><a href="?act=ProductDetail">Product Detail</a></li>
                        </ul>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="?act=AboutUs">About Us</a></li>
                            <li><a href="?act=ContactUs">Contact Us</a></li>
                            <li><a href="?act=Faq">Faq</a></li>
                            <li><a href="?act=Policy">Policy</a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog-left-sidebar.html">Left Sidebar</a></li>
                            <li><a href="blog-right-sidebar.html">Right Sidebar</a></li>
                            <li><a href="blog-full-width.html">Full Width</a></li>
                            <li><a href="blog-detail-left-sidebar.html">Detail Left Sidebar</a></li>
                            <li><a href="blog-detail-right-sidebar.html">Detail Right Sidebar</a></li>
                            <li><a href="blog-detail-full-width.html">Detail Full Width</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)">Element</a>
                        <ul class="sub-menu">
                            <li><a href="elements-products.html">Products</a></li>
                            <li><a href="elements-typography.html">Typography</a></li>
                            <li><a href="elements-buttons.html">Buttons</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>