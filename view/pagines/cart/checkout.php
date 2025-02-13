    <!-- Breadcrumb -->
    <?php require_once 'view/layout/header.php' ?>

    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Checkout</h2>
                            <span> <a href="index.php">Home</a> - Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section -->
    <section class="cr-checkout-section padding-tb-100">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="cr-checkout-rightside col-lg-4 col-md-12">
                    <div class="cr-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Summary</h3>
                            </div>
                            <?php
                            $totalAmount = 0; // Khởi tạo biến tổng giá
                            ?>

                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-summary">
                                    <?php foreach ($cart_items as $item): ?>
                                        <?php
                                        $totalAmount += $item['total_price'];                                // Cộng dồn tổng giá
                                        $quantity = ! empty($item['quantity']) ? (int) $item['quantity'] : 1; // Kiểm tra số lượng
                                        ?>
                                        <div class="cr-checkout-pro">
                                            <div class="col-sm-12 mb-6">
                                                <div class="cr-product-inner">
                                                    <div class="cr-pro-image-outer">
                                                        <div class="cr-pro-image">
                                                            <a href="#" class="image">
                                                                <img class="main-image" src="admin/view/assets/images/products/<?php echo ! empty($item['img']) ? htmlspecialchars($item['img']) : 'default.jpg' ?>"
                                                                    alt="<?php echo ! empty($item['cart_name']) ? htmlspecialchars($item['cart_name']) : 'Sản phẩm không có tên' ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="cr-pro-content cr-product-details">
                                                        <h5 class="cr-pro-title">
                                                            <a href="#"><?php echo ! empty($item['cart_name']) ? htmlspecialchars($item['cart_name']) : 'Sản phẩm không có tên' ?></a>
                                                        </h5>
                                                        <p class="cr-price">
                                                            <span class="new-price"><?php echo number_format($item['total_price']) ?> VNĐ</span>
                                                            <span class="cr-quantity"> x <?php echo $quantity ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Hiển thị tổng tiền -->
                                    <div class="cr-checkout-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right"><?php echo number_format($totalAmount) ?> VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                    <div class="cr-sidebar-wrap cr-checkout-pay-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Payment Method</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-pay">
                                    <div class="cr-pay-desc">Please select the preferred payment method to use on this
                                        order.</div>
                                    <form action="#" class="payment-options">
                                        <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay1" name="radio-group" checked>
                                                <label for="pay1">Cash On Delivery</label>
                                            </span>
                                        </span>
                                        <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay3" name="radio-group">
                                                <label for="pay3">Bank Transfer</label>
                                            </span>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                    <div class="cr-sidebar-wrap cr-check-pay-img-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Payment Method</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-check-pay-img-inner">
                                    <div class="cr-check-pay-img">
                                        <img src="view/assets/img/banner/payment.png" alt="payment">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                </div>
                <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- checkout content Start -->
                    <div class="cr-checkout-content">
                        <div class="cr-checkout-inner">
                            <?php
                            // Giả sử thông tin user đã đăng nhập được lưu trong session
                            $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
                            ?>
                            <div class="cr-checkout-wrap">
                                <div class="cr-checkout-block cr-check-bill">
                                    <h3 class="cr-checkout-title">Billing Details</h3>
                                    <div class="cr-bl-block-content">
                                        <div class="cr-check-bill-form mb-minus-24">
                                            <form action="#" method="post">
                                                <span class="cr-bill-wrap">
                                                    <label>User Name *</label>
                                                    <input type="text" name="username"
                                                        value="<?php echo htmlspecialchars($user['username'] ?? '') ?>"
                                                        placeholder="Enter your user name" readonly required>
                                                </span>
                                                <span class="cr-bill-wrap">
                                                    <label>Address</label>
                                                    <input type="text" name="address"
                                                        value="<?php echo htmlspecialchars($user['user_address'] ?? '') ?>"
                                                        placeholder="Address Line 1" readonly required>
                                                </span>
                                                <span class="cr-bill-wrap phone-container">
                                                    <label>Phone Number *</label>
                                                    <input type="text" name="phonenumber"
                                                        value="<?php echo htmlspecialchars($user['user_phone'] ?? '') ?>"
                                                        placeholder="Phone Number" readonly required>
                                                    <span class="cr-check-order-btn" style="">
                                                        <a class="cr-button mt-20" href="#">Edit address</a>
                                                    </span>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span class="cr-check-order-btn">
                                <a class="cr-button mt-30" href="#">Place Order</a>
                            </span>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <?php require_once 'view/layout/footer.php' ?>
    <!-- Checkout section End -->