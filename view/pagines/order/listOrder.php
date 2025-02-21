<?php require_once 'view/layout/header.php' ?>

<section class="order-list container">
    <h2 class="text-center">Danh sách đơn hàng của người dùng</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)) : ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['order_id'] ?></td>
                            <td><?= $order['user_id'] ?></td>
                            <td class="text-right"><?= number_format($order['total_price'], 0, ',', '.') ?> đ</td>
                            <td>
                                <span class="badge <?= getStatusBadge($order['status_id']) ?>">
                                    <?= $order['status_name'] ?>
                                </span>
                            </td>
                            <td><?= $order['created_at'] ?></td>
                            <td>
                                <a href="?act=orderDetail&order_id=<?= $order['order_id'] ?>" class="btn btn-sm btn-success">Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
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