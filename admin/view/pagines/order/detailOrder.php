<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Detail Order</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listOrders">List of Orders</a></li>
                                <li class="breadcrumb-item active">Detail Order</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Order Information -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Information</h5>
                            <form action="?act=updateOrderStatus" method="POST">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Order ID:</strong> <?= $orderDetails[0]['order_id'] ?></li>
                                    <li class="list-group-item"><strong>Customer Name:</strong> <?= $orderDetails[0]['username'] ?></li>
                                    <li class="list-group-item"><strong>Phone:</strong> <?= $orderDetails[0]['phone'] ?></li>
                                    <li class="list-group-item"><strong>Address:</strong> <?= $orderDetails[0]['user_address'] ?></li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong>
                                        <select name="status_id" class="form-select">
                                            <?php
                                            // Lấy danh sách trạng thái từ DB
                                            foreach ($statuses as $status) {
                                                // Chỉ hiển thị trạng thái hiện tại hoặc cao hơn
                                                if ($status['status_id'] >= $orderDetails[0]['status_id']) {
                                            ?>
                                                    <option value="<?= $status['status_id'] ?>"
                                                        <?= ($status['status_id'] == $orderDetails[0]['status_id']) ? 'selected' : '' ?>>
                                                        <?= $status['status_name'] ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </li>

                                    <li class="list-group-item"><strong>Date Created:</strong> <?= $orderDetails[0]['created_at'] ?></li>
                                </ul>

                                <!-- Hidden field to pass order_id -->
                                <input type="hidden" name="order_id" value="<?= $orderDetails[0]['order_id'] ?>">

                                <button type="submit" name="updateOrder" class="btn btn-success" style="margin-left: 1170px;margin-top: 10px">
                                    <i class="ri-add-line align-bottom me-1"></i> Update Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Order Information -->
            <!-- Order Items -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Details</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $grandTotal = 0;
                                        foreach ($orderDetails as $item) :
                                            $total = $item['quantity'] * $item['price'];
                                            $grandTotal += $total;
                                        ?>
                                            <tr>
                                                <td><?= $item['product_name'] ?></td>
                                                <td><img src="../admin/view/assets/images/products/<?= $item['image'] ?>" alt="Product Image" style="width: 50px;"></td>
                                                <td><?= $item['quantity'] ?></td>
                                                <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                                                <td><?= number_format($total, 0, ',', '.') ?> VND</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <th colspan="4" class="text-end">GRAND TOTAL:</th>
                                            <th><?= number_format($grandTotal, 0, ',', '.') ?> VND</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Order Items -->
        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->