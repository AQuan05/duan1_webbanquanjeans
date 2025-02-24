<?php require_once 'view/layout/header.php';
require_once "model/Comment.php"; // Đảm bảo đường dẫn đúng
$commentModel = new Comment(); // Nếu `$db` là biến kết nối PDO của bạn
?>
<div class="container mt-4">

    <!-- Tiêu đề -->
    <section class="text-center">
        <h2 class="order-header">Chi Tiết Đơn Hàng</h2>
    </section>

    <!-- Thông tin đơn hàng -->
    <section class="order-info my-4">
        <h4 class="text-primary">Thông tin đơn hàng</h4>
        <table class="table table-bordered">
            <tr>
                <th class="w-25">Order ID:</th>
                <td><?= $order['order_id'] ?></td>
            </tr>
            <tr>
                <th>User Name:</th>
                
                <td><?= $order['username'] ?></td>
            </tr>
            <tr>
                <th>Tổng tiền:</th>
                <td><?= number_format($order['total_price'], 0, ',', '.') ?> đ</td>
            </tr>
            <tr>
                <th>Trạng thái:</th>
                <td><span class="badge <?= getStatusBadge($order['status_id']) ?>"><?= $order['status_name'] ?></span></td>
            </tr>
            <tr>
                <th>Địa chỉ giao hàng:</th>
                <td><?= $order['user_address'] ?></td>
            </tr>
            <tr>
                <th>Số điện thoại:</th>
                <td><?= $order['Phone'] ?></td>
            </tr>
            <tr>
                <th>Phương thức thanh toán:</th>
                <td>
                    <?= strtolower($order['pttt']) == 'tructiep' ? 'Trực Tiếp' : strtoupper($order['pttt']); ?>
                </td>
            </tr>
            <tr>
                <th>Ngày đặt hàng:</th>
                <td><?= date("d/m/Y H:i", strtotime($order['created_at'])) ?></td>
            </tr>
        </table>
    </section>

    <!-- Danh sách sản phẩm -->
    <section class="product-list">
        <h4 class="text-success text-center">Danh sách sản phẩm</h4>
        <table class="table table-hover mt-3" border="1">
            <thead class="table-dark">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Image</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <?php if ($order['status_id'] == 4): // Kiểm tra trạng thái hoàn thành 
                    ?>
                        <th>Đánh giá</th>
                    <?php endif; ?>
                    <?php if ($order['status_id'] == 1 || $order['status_id'] == 2): // Kiểm tra trạng thái Chưa xác nhận hoặc Đã xác nhận 
                    ?>
                        <th class="text-center">Hủy đơn</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $totalQuantity = 0;

                if (!empty($orderItems)) :
                    foreach ($orderItems as $item):
                        $subtotal = $item['quantity'] * $item['price'];
                        $total += $subtotal;
                        $totalQuantity += $item['quantity'];
                ?>
                        <tr>
                            <td><?= $item['product_name'] ?></td>
                            <td><img src="admin/view/assets/images/products/<?= $item['image'] ?>" alt="" width="100px"></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                            <td><?= number_format($subtotal, 0, ',', '.') ?> đ</td>
                            <?php if ($order['status_id'] == 4): ?>
    <td>
        <?php
        $comment = $commentModel->getCommentsByProduct($item['product_id'], $order['order_id']);
        if ($comment):
        ?>
            <p><strong><?= htmlspecialchars($comment['username']) ?>:</strong> <?= htmlspecialchars($comment['content']) ?></p>
        <?php else: ?>
            <form action="index.php?act=addComment" method="POST">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?? '' ?>">
                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                <textarea name="content" placeholder="Nhập đánh giá..." required></textarea>
                <button type="submit" class="btn btn-primary btn-sm">Gửi</button>
            </form>
        <?php endif; ?>
    </td>
<?php endif; ?>

                            <?php if ($order['status_id'] == 1 || $order['status_id'] == 2): ?>
                                <td class="text-end">
                                    <!-- Form hủy đơn hàng -->
                                    <form action="?act=cancelOrder" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?')">
                                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?? '' ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" style="height: 40px;margin-top: 10px" name="cancel">Hủy đơn</button>
                                    </form>
                                </td>

                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Không có sản phẩm nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-end fw-bold">Tổng cộng:</td>
                    <td class="fw-bold"><?= number_format($totalQuantity, 0, ',', '.') ?> sản phẩm</td>
                    <td colspan="1" class="text-end fw-bold">Tổng tiền:</td>
                    <td class="fw-bold"><?= number_format($total, 0, ',', '.') ?> đ</td>
                    <?php if ($order['status_id'] == 4): ?>
                        <td>
                            <!-- Đánh giá nếu đơn hàng đã hoàn thành -->
                        </td>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>

        <script>
            function validateCancelForm() {
                var cancelReason = document.getElementById("cancel_reason").value;
                if (!cancelReason) {
                    alert("Vui lòng chọn lý do hủy.");
                    return false;
                }
                return true;
            }
        </script>

    </section>

</div>

<?php
// Hàm trả về màu sắc theo trạng thái đơn hàng
function getStatusBadge($status_id)
{
    switch ($status_id) {
        case 0:
            return "bg-danger"; // Đã hủy
        case 1:
            return "bg-secondary"; // Chưa xác nhận
        case 2:
            return "bg-primary"; // Đã xác nhận
        case 3:
            return "bg-warning"; // Đang giao hàng
        case 4:
            return "bg-success"; // Hoàn thành
        default:
            return "bg-dark";
    }
}
?>
<?php require_once 'view/layout/footer.php' ?>