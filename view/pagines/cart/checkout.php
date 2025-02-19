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
            <form action="?act=payment" method="post">
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
                                            // $order_name = $item['order_name'] ?? 'Unknown Product'; // Gán giá trị mặc định nếu thiếu
                                            $totalAmount += $item['total_price'];                                // Cộng dồn tổng giá
                                            $quantity = ! empty($item['quantity']) ? (int) $item['quantity'] : 1; // Kiểm tra số lượng
                                            ?>
                                            <div class="cr-checkout-pro">
                                                <div class="col-sm-12 mb-6">
                                                    <div class="cr-product-inner">
                                                        <div class="cr-pro-image-outer">
                                                            <div class="cr-pro-image">
                                                                <a href="#" class="image">
                                                                    <img class="main-image" src="admin/view/assets/images/products/<?php echo ! empty($item['image']) ? htmlspecialchars($item['image']) : 'default.jpg' ?>"
                                                                        alt="<?php echo ! empty($item['product_name']) ? htmlspecialchars($item['product_name']) : 'Sản phẩm không có tên' ?>">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="cr-pro-content cr-product-details">
                                                            <h5 class="cr-pro-title">
                                                                <a href="#"><?php echo ! empty($item['product_name']) ? htmlspecialchars($item['product_name']) : 'Sản phẩm không có tên' ?></a>
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
                                        
                                            <span class="cr-pay-option">
                                                <span>
                                                    <input type="radio" id="pay1" name="pttt"  value="tt" checked>
                                                    <label for="pay1">tt</label>
                                                </span>
                                            </span>
                                            <span class="cr-pay-option">
                                                <span>
                                                    <input type="radio" id="pay3" name="pttt" value="vnpay">
                                                    <label for="pay3">vnpay</label>
                                                </span>
                                            </span>
                                      
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
                                            <div class="cr-check-bill-form">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <label class="form-label">User Name *</label>
                                                        <input type="text" name="username" class="form-control"
                                                            value="<?php echo htmlspecialchars($user['username'] ?? '') ?>"
                                                            placeholder="Enter your user name" required>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label class="form-label">Address *</label>
                                                        <input type="text" name="address" class="form-control"
                                                            value="<?php echo htmlspecialchars($user['user_address'] ?? '') ?>"
                                                            placeholder="Address Line 1" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Phone Number *</label>
                                                        <div class="input-group">
                                                            <input type="text" name="phonenumber" class="form-control"
                                                                value="<?php echo htmlspecialchars($user['user_phone'] ?? '') ?>"
                                                                placeholder="Phone Number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="cr-check-order-btn">
                                <button type="submit" class="cr-button mt-30" name="place_order">Place Order</button>
                                </span>
                            </div>
                        </div>
                        <!--cart content End -->
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php require_once 'view/layout/footer.php' ?>
    <!-- Checkout section End -->