    <?php require_once 'view/layout/header.php' ?>

    <!-- Hero slider -->
    <section class="section-hero padding-b-100 next">
        <div class="cr-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="cr-hero-banner cr-banner-image-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-left-side-contain slider-animation">
                                        <h5><span>100%</span> Organic Fruits</h5>
                                        <h1>Explore fresh & juicy fruits.</h1>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                                            beatae consequuntur.</p>
                                        <div class="cr-last-buttons">
                                            <a href="shop-left-sidebar.html" class="cr-button">
                                                shop now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cr-hero-banner cr-banner-image-one">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-left-side-contain slider-animation">
                                        <h5><span>100%</span> Organic Vegetables</h5>
                                        <h1>The best way to stuff your wallet.</h1>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                                            beatae consequuntur.</p>
                                        <div class="cr-last-buttons">
                                            <a href="shop-left-sidebar.html" class="cr-button">
                                                shop now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Popular product -->
    <section class="section-popular-product-shape padding-b-100">
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>Top products</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-content row mb-minus-24" id="MixItUpDA2FB7">
                <div class="col-xl-3 col-lg-4 col-12 mb-24">
                    <div class="row mb-minus-24 sticky">
                        <div class="col-lg-12 col-sm-6 col-6 cr-product-box banner-480 mb-24">
                            <div class="cr-ice-cubes">
                                <img src="view/assets/img/product/product-banner.jpg" alt="product banner">
                                <div class="cr-ice-cubes-contain">
                                    <h4 class="title">Juicy </h4>
                                    <h5 class="sub-title">Fruits</h5>
                                    <span>100% Natural</span>
                                    <a href="shop-left-sidebar.html" class="cr-button">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-12 mb-24">
                    <div class="row mb-minus-24">
                        <?php foreach ($top8Products as $product) { ?>
                            <div class="mix vegetable col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            <input type="hidden" value="<?= $product['product_id'] ?>">
                                            <img src="view/assets/img/product/<?= $product['image'] ?>" alt="product">
                                        </div>
                                        <a class="cr-shopping-bag" href="javascript:void(0)">
                                            <i class="ri-shopping-bag-line"></i>
                                        </a>
                                    </div>
                                    <div class="cr-product-details">
                                        <div class="cr-brand">
                                            <a href="#"><?= $product['category_name'] ?></a>
                                        </div>
                                        <a href="?act=shopSingle&product_id=<?= $product['product_id'] ?>" class="title"><?= $product['product_name'] ?></a>
                                        <p class="cr-price"><span class="new-price"><?= number_format($product['price']) ?>VNĐ</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product banner -->
    <section class="section-product-banner padding-b-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-banner-slider swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image">
                                    <img src="view/assets/img/product-banner/1.jpg" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Healthy <br> Bakery Products</h5>
                                        <p><span class="percent">30%</span> Off <span class="text">on first order</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="shop-left-sidebar.html" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image">
                                    <img src="view/assets/img/product-banner/2.jpg" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Fresh <br>Snacks & Sweets</h5>
                                        <p><span class="percent">20%</span> Off <span class="text">on first order</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="shop-left-sidebar.html" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-aos="fade-up" data-aos-duration="2000">
                                <div class="cr-product-banner-image">
                                    <img src="view/assets/img/product-banner/3.jpg" alt="product-banner">
                                    <div class="cr-product-banner-contain">
                                        <h5>Fresh & healthy <br> Organic Fruits</h5>
                                        <p><span class="percent">35%</span> Off <span class="text">on first order</span>
                                        </p>
                                        <div class="cr-product-banner-buttons">
                                            <a href="shop-left-sidebar.html" class="cr-button">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'view/layout/footer.php' ?>