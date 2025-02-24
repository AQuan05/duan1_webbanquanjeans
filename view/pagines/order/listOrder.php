<?php require_once 'view/layout/header.php'; ?>

<section class="order-list container">
    <h2 class="text-center">Danh sách đơn hàng của người dùng</h2>

    <!-- Thanh điều hướng trạng thái đơn hàng -->
    <ul class="nav nav-pills justify-content-center mb-3">
        <?php 
        $statusTabs = [
            "" => "Tất cả",
            "0" => "Đã hủy",
            "1" => "Chưa xác nhận",
            "2" => "Đã xác nhận",
            "3" => "Đang giao hàng",
            "4" => "Giao hàng thành công"
        ];

        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
        $currentStatus = isset($_GET['status']) ? $_GET['status'] : ""; 

        // Kiểm tra nếu user_id không hợp lệ
        if ($user_id <= 0) {
            echo "<p class='text-danger text-center'>Vui lòng cung cấp user_id hợp lệ.</p>";
            exit();
        }
        ?>

        <?php foreach ($statusTabs as $key => $label): ?>
            <li class="nav-item">
                <a class="nav-link <?= ($currentStatus == (string)$key) ? 'active' : '' ?>" 
                   href="?act=listOrder&user_id=<?= $user_id ?>&status=<?= $key ?>">
                    <?= $label ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Hiển thị danh sách đơn hàng -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
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
                            <td><?= $order['username'] ?></td>
                            <td class="text-right"><?= number_format($order['total_price'], 0, ',', '.') ?> đ</td>
                            <td>
                                <span class="badge <?= getStatusBadge($order['status_id']) ?>">
                                    <?= $order['status_name'] ?>
                                </span>
                            </td>
                            <td><?= $order['created_at'] ?></td>
                            <td>
                                <a href="?act=orderDetail&user_id=<?= $user_id ?>&order_id=<?= $order['order_id'] ?>" class="btn btn-sm btn-success">Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php
// Hàm lấy class màu sắc theo trạng thái đơn hàng
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
            return "bg-success"; // Giao hàng thành công
        default:
            return "bg-dark";
    }
}
?>

<?php require_once 'view/layout/footer.php'; ?>
