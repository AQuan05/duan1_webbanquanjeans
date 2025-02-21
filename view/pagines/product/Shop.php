<?php require_once 'view/layout/header.php' ?>
<!-- Shop -->
<section class="section-shop padding-tb-100">
    <div class="container">
        <div class="row d-none">
            <div class="col-lg-12">
                <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-banner">
                        <h2>Categories</h2>
                    </div>
                    <div class="cr-banner-sub-title">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore lacus vel facilisis. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                <div class="cr-shop-sideview">
                    <div class="cr-shop-categories">
                        <h4 class="cr-shop-sub-title">Category</h4>
                        <select id="category-select" class="form-select">
                            <option value="?act=shop">All Categories</option>
                            <?php foreach ($categories as $value): ?>
                                <option value="?act=shopCategory&category_id=<?= $value['category_id'] ?>"
                                    <?php if (isset($_GET['category_id']) && $_GET['category_id'] == $value['category_id']): ?>
                                    selected
                                    <?php endif; ?>>
                                    <?= $value['category_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <script>
                            const selectElement = document.getElementById('category-select');

                            selectElement.addEventListener('change', function() {
                                const selectedValue = this.value;
                                // Lưu giá trị đã chọn vào localStorage
                                localStorage.setItem('selectedCategory', selectedValue);

                                // Chuyển hướng người dùng đến trang tương ứng (tùy chọn)
                                window.location.href = selectedValue;
                            });

                            // Kiểm tra xem có giá trị đã lưu trong localStorage không
                            const savedValue = localStorage.getItem('selectedCategory');
                            if (savedValue) {
                                // Nếu có, thiết lập giá trị cho dropdown
                                selectElement.value = savedValue;

                                // Và chuyển hướng nếu bạn muốn (bỏ comment nếu cần)
                                // window.location.href = savedValue; 
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="row">
                </div>
                <div class="row col-100 mb-minus-24">
                    <?php ?>
                    <?php foreach ($products as $key => $pro) { ?>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img style="width: 100%; height: 200px;" src="admin/view/assets/images/products/<?= $pro['image'] ?>" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                            role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="#"><?= $pro['category_name'] ?></a>
                                    </div>
                                    <a href="?act=shopSingle&product_id=<?= $pro['product_id'] ?>" class="title"><?= $pro['product_name'] ?></a>

                                    <p class="cr-price"><span class="new-price"><?= number_format($pro['price']) ?> VNĐ</span></p>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>

                </div>
                <nav aria-label="..." class="cr-pagination">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<?php require_once 'view/layout/footer.php' ?>