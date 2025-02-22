<?php require_once 'view/layout/header.php';
require_once 'model/Comment.php';
$commentModel = new Comment();

?>
<!-- Breadcrumb -->
<section class="section-breadcrumb">
    <div class="cr-breadcrumb-image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product</h2>
                    <span> <a href="index.html">Home</a> - product</span>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<style>
    .cr-t-review-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
        font-size: 24px;
    }

    .cr-t-review-rating input {
        display: none;
    }

    .cr-t-review-rating label {
        cursor: pointer;
        color: #ccc;
        transition: color 0.3s;
    }

    .cr-t-review-rating label:hover,
    .cr-t-review-rating label:hover~label,
    .cr-t-review-rating input:checked~label {
        color: #FFD700;
    }
</style>
<!-- Product -->
<section class="section-product padding-t-100">
    <div class="container">
        <form id="addToCartForm" action="?act=cart" method="POST" enctype="multipart/form-data">
            <div class="row mb-minus-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="col-xxl-4 col-xl-5 col-md-6 col-12 mb-24">
                    <div class="vehicle-detail-banner banner-content clearfix">
                        <div class="banner-slider">
                            <div class="slider slider-for">
                                <div class="slider-banner-image">
                                    <div class="zoom-image-hover">
                                        <img src="admin/view/assets/images/products/<?php echo $productOne['image'] ?>" alt="product-tab-1" class="product-image" id="productImage">
                                        <input type="hidden" name="image" value="<?php echo $productOne['image'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-7 col-md-6 col-12 mb-24">
                    <div class="cr-size-and-weight-contain">
                        <h2 class="heading" id="productName" name="cart_name"><?php echo $productOne['product_name'] ?></h2>
                        <input type="hidden" name="cart_name" value="<?php echo $productOne['product_name'] ?>">
                        <p><?php echo $productOne['category_name'] ?></p>

                    </div>
                    <div class="cr-size-and-weight">


                        <div class="cr-product-price">
                            <span class="new-price" id="productPrice" name="price">
                                <?php echo number_format($productOne['price']) ?> VNĐ
                            </span>
                            <input type="hidden" name="price" value="<?php echo $productOne['price']; ?>">
                        </div>
                        <div class="cr-add-card">
                            <div class="cr-qty-main">
                                <input type="number" placeholder="." value="1" min="1" maxlength="20" name="quantity" class="quantity" required>
                                <button type="button" class="plus">+</button>
                                <button type="button" class="minus">-</button>
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $productOne['product_id']; ?>">
                            <div class="cr-add-button">
                                <button type="submit" name="add_to_cart" class="cr-button cr-shopping-bag">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
            <div class="col-12">
                <div class="cr-paking-delivery">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                type="button" role="tab" aria-controls="review"
                                aria-selected="false">Review</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="cr-tab-content">
                                <div class="cr-description">
                                    <p><?php echo $productOne['description'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="cr-tab-content">
                                <h4 class="heading">Đánh giá sản phẩm</h4>
                                <!-- Hiển thị danh sách comment -->
                                <?php if (!empty($comments)): ?>
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="post">
                                            <div class="content mt-30">
                                                <img src="assets/img/review/user-default.png" alt="review">
                                                <div class="details">
                                                    <span class="name"><?= htmlspecialchars($comment['username']) ?></span>
                                                    <span class="date"><?= date("d/m/Y", strtotime($comment['created_at'])) ?></span>
                                                </div>
                                            </div>
                                            <p><?= htmlspecialchars($comment['content']) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Chưa có đánh giá nào.</p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

</section>

<!-- Popular products -->
<section class="section-popular-products padding-tb-100" data-aos="fade-up" data-aos-duration="2000"
    data-aos-delay="400">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-30">
                    <div class="cr-banner">
                        <h2>Similar products</h2>
                    </div>
                    <div class="cr-banner-sub-title">
                        <p>Below are related products, please take a look. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="cr-popular-product">
                    <?php foreach ($similarProducts as $simiPro) { ?>
                        <div class="slick-slide">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="admin/view/assets/images/products/<?php echo $simiPro['image'] ?>" alt="product-1">
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="#"><?php echo $simiPro['category_name'] ?></a>
                                    </div>
                                    <a href="?act=shopSingle&product_id=<?= $simiPro['product_id'] ?>" class="title"><?php echo $simiPro['product_name'] ?></a>
                                    <p class="cr-price"><span class="new-price"><?= number_format($simiPro['price']) ?>VNĐ</span></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'view/layout/footer.php' ?>